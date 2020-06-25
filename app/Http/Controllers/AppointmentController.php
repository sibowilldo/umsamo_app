<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Comment;
use App\EventDate;
use App\Repositories\AppointmentRepository;
use App\Repositories\EventDateRepository;
use App\Repositories\UserRepository;
use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HTTPResponse;

class AppointmentController extends Controller
{
    const APPOINTMENT_CANCELLED_STATUS = 12;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = "Appointments";

        $appointment_types = Appointment::$types;

        $user = Auth::user();
        $appointments = AppointmentRepository::GET_APPOINTMENTS( $user,
            ['status','event_date','event_date.event','event_date.event.status'],
            ['uuid', 'event_date_id', 'status_id','type', 'created_at']);

        $statuses = $appointments->pluck('status')->unique();
        $events = $appointments->pluck('event_date.event')->unique();

        return response()->view('backend.appointment.index', compact('appointments', 'appointment_types', 'events', 'statuses', 'page_title'));
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
        $request->merge(['with_family' => $request->has('with_family')]);

        DB::transaction(function() use ($request){

            $user = $request->has('id_number')
                ? UserRepository::NEW_USER($request->only('address', 'cell_number', 'city','date_of_birth',
                    'email', 'first_name', 'gender', 'id_number', 'last_name', 'postal_code', 'province'))
                : User::findOrFail(Auth::id());

            $event_date = EventDate::findOrFail($request->event_date);

            if($request->with_family){
                $family = $user->families()->firstOrCreate(['name'=>$request->family_name]);
                $family->users()->updateExistingPivot($user->id, ['is_head' => true]);
            }
            AppointmentRepository::NEW_APPOINTMENT($user, $event_date, $request);
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
        $page_title = "View Appointment";
        $comments = Comment::where('appointment_id', $appointment->id)->with(['status'])->get();

        return response()->view('backend.appointment.show', compact('appointment', 'comments', 'page_title'));
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

        $appointment->update(['status_id' => self::APPOINTMENT_CANCELLED_STATUS ]);

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
