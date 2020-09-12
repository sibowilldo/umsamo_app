<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Comment;
use App\EventDate;
use App\Family;
use App\Repositories\AppointmentRepository;
use App\Repositories\FamilyAppointmentRepository;
use App\Repositories\UserRepository;
use App\User;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response as HTTPResponse;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $page_title = "Appointments";

        $appointment_types = Appointment::types();
        $user = User::with(['families', 'families.appointments'])->findOrFail(Auth::id());
        $appointmentables = [];
        array_push($appointmentables, $user->id);
        array_push($appointmentables, $user->families->pluck('id')->toArray());
        $appointments = Appointment::whereIn('appointmentable_id', $appointmentables )->get();

        $statuses = $appointments->pluck('status')->unique();

        return response()->view('backend.appointment.index', compact('user','appointments', 'appointment_types',  'statuses', 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        Gate::authorize('create', Appointment::class);

        $request->merge(['with_family' => $request->has('with_family')]);

        DB::transaction(function() use ($request){

            $event_date = EventDate::findOrFail($request->event_date);
            $confirmed_appointments = $event_date->appointments()->whereIn('status_id', [Appointment::STATUS_CONFIRMED, Appointment::STATUS_RESCHEDULED]);

            abort_if( $confirmed_appointments->count() >= $event_date->limit, 403, $event_date->date_time->format('M d, Y') . " has no available spots for consultation appointments. Please select another date for Consultations." );

            $user = $request->has('id_number')
                ? UserRepository::NEW_USER($request->only('address', 'cell_number', 'city','date_of_birth', 'email', 'first_name', 'gender', 'id_number', 'last_name', 'postal_code', 'province'))
                : User::findOrFail(Auth::id());

            if($request->has('family_members')){
                $family_members = $request->family_members;
                array_push($family_members, $user->uuid);
                $family = Family::findOrFail($request->family);
                $appointment = AppointmentRepository::NEW_APPOINTMENT($family, $event_date, $request, 'fam');
                FamilyAppointmentRepository::NEW_FAMILY_APPOINTMENT($family, $appointment, $family_members, $request);
            }else{
                if($request->with_family){
                    $family_members = [];
                    array_push($family_members, $user->uuid);
                    $family = $user->families()->firstOrCreate(['name' => $request->family_name]);
                    $family->users()->updateExistingPivot($user->id, ['is_head' => true, 'joined_at' => Carbon::now()]);
                    $appointment =  AppointmentRepository::NEW_APPOINTMENT($family, $event_date, $request, 'fam');
                    FamilyAppointmentRepository::NEW_FAMILY_APPOINTMENT($family, $appointment,$family_members, $request);
                }else{
                    AppointmentRepository::NEW_APPOINTMENT($user, $event_date, $request);
                }
            }
        });

        return response()->json(['url' => route('dashboard'),
            'title' => 'Appointment was made successfully',
            'message' => 'A reminder will be sent when the appointment date is near. Please keep contact details update to date'],
            HTTPResponse::HTTP_ACCEPTED);
    }

    /**
     * Display the specified resource.
     *
     * @param Appointment $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        Gate::authorize('view', $appointment);
        $appointment_types = Appointment::types();
        $page_title = "View Appointment";
        $comments = Comment::where('appointment_id', $appointment->id)->with(['status', 'user'])->get();

        return response()->view('backend.appointment.show', compact('appointment_types','appointment', 'comments', 'page_title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Appointment $appointment
     * @return void
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Appointment $appointment
     * @return void
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Set the resource status to CANCEL,
     * Notify the user
     * Notify the administrators
     *
     * @param Appointment $appointment
     * @return \Illuminate\Http\JsonResponse
     */
    public function cancel(Appointment $appointment)
    {
        Gate::authorize('update', $appointment);

        $appointment->update(['status_id' => Appointment::STATUS_CANCELLED]);
        if($appointment->event_date->status_id === EventDate::STATUS_FULL){
            $appointment->event_date->update(['status_id' => EventDate::STATUS_ACTIVE]);
        }
        return response()->json([
            "message"=> 'Your appointment was cancelled successfully',
            "url" => route('appointments.index')
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        //
    }

}
