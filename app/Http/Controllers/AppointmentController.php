<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Comment;
use App\Event;
use App\EventDate;
use App\Status;
use Auth;
use DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HTTPResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

        $appointments = Appointment::where('user_id', Auth::id())->with(['status'=> function($query){
            $query->where('model_type', 'App\Appointment')->select('id', 'title', 'model_type', 'color');
        },'event_date','event_date.event','event_date.event.status'])->select('uuid', 'event_date_id', 'status_id','type', 'created_at')->get();

        $statuses = Status::whereIn('id', $appointments->pluck('status_id'))->select('id', 'title', 'color')->get();
        $events = Event::whereIn('id', $appointments->pluck('event_date.event.id'))->select('title')->get();

        return view('backend.appointments.index', compact('appointments', 'appointment_types', 'events', 'statuses', 'page_title'));
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
        $event_date = EventDate::findOrFail($request->event_date);
        $status = Status::where(['model_type' => 'App\Appointment', 'title' => 'pending'])->select('id')->first();

        DB::transaction(function() use ($request, $event_date, $status){
            $appointment = Appointment::create([
                'user_id' => Auth::id(),
                'event_date_id' => $event_date->id,
                'region_id' => $event_date->event->regions()->first()->id,
                'status_id' => $status->id,
                'type' => $request->appointment_type,
            ]);
            if($request->appointment_type == 'Consulting'){
                $event_date->update(['limit' => $event_date->limit - 1]);
            }
        });

        if($event_date->limit < 1){
            $status = Status::firstOrCreate(['title'=> 'Full', 'model_type' => 'App\EventDate'], ['description' => 'Assigned to an Event Date that no longer has available spaces.']);
            $event_date->update(['status_id' => $status->id]);
        }

        return response()->json(['url' => route('dashboard'), 'message' => "We will be in touch to confirm your appointment."], HTTPResponse::HTTP_ACCEPTED);
    }

    /**
     * Display the specified resource.
     *
     * @param Appointment $appointment
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Appointment $appointment)
    {
        $comments = Comment::where('appointment_id', $appointment->id)->with(['status'])->get();

        return view('backend.appointments.show', compact('appointment', 'comments'));
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

        $appointment->update([
            'status_id' => self::APPOINTMENT_CANCELLED_STATUS
        ]);

        if(strcasecmp($appointment->type, 'Consulting') == 0){
            $appointment->event_date()->update([
                'limit' => $appointment->event_date->limit+=1
            ]);
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
