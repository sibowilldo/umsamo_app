<?php

namespace App\Http\Controllers\Administrator;

use App\Appointment;
use App\DataTables\AppointmentsDataTable;
use App\EventDate;
use App\Http\Controllers\Controller;
use App\Status;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public $appointment_types;
    public function __construct()
    {
        $this->middleware(['role:kingpin|administrator']);
        $this->appointment_types = Appointment::types();
    }


    /**
     * @param AppointmentsDataTable $dataTable
     * @return mixed
     */
    public function index(AppointmentsDataTable $dataTable)
    {

        $page_title = "Appointments";
        $statuses = Status::where('model_type', 'App\Appointment')->select(['title', 'id'])->get();

        return $dataTable->render('backend.admin.appointment.index', compact('page_title', 'statuses'));
    }


    /**
     * Updates the status of the resource
     *
     * @param Request $request
     * @param Appointment $appointment
     * @return \Illuminate\Http\JsonResponse
     */
    public function status(Request $request, Appointment $appointment)
    {
        if($request->status_id === $appointment->status_id){
            return response()->json(['message' => 'Nothing updated!'], 201);
        }
        $appointment->update(['status_id' => $request->status_id]);
        if($appointment->status_id === Appointment::STATUS_CANCELLED && $appointment->event_date->status_id === EventDate::STATUS_FULL){
            $appointment->event_date->update(['status_id' => EventDate::STATUS_ACTIVE]);
        }

        return response()->json(['title' => 'Status Updated!', 'message' => 'Appointment updated successfully'], 201);
    }
}
