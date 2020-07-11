<?php

namespace App\Http\Controllers\Administrator;

use App\Appointment;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;
use DB;

class AppointmentController extends Controller
{
    public $appointment_types;
    public function __construct()
    {
        $this->middleware(['role:kingpin|administrator']);
        $this->appointment_types = Appointment::types();
    }

    public function today()
    {
        $appointment_types = $this->appointment_types;
         $page_title = "Today's Appointments";
         $page_description = "Showing only Today's Appointments " . Carbon::today()->format('M d, Y');
         $appointments = Appointment::with(['status:id,title,color', 'familyAppointments', 'familyAppointments.user', 'familyAppointments.status:id,title,color'])
                         ->get()
                         ->where('event_date.date_time', '=', Carbon::today()->format('Y-m-d H:i:s'));

         $appointment_groups = $appointments->pluck('appointmentable_type')->unique();
         $statuses = $appointments->pluck('status')->unique();
         return response()->view('backend.appointment.today', compact('appointment_types','appointments','statuses', 'appointment_groups', 'page_description', 'page_title'));
    }

    public function upcoming()
    {
        $appointment_types = $this->appointment_types;
        $page_title = "Upcoming Appointments";
        $page_description = "Showing only upcoming Appointments";
        $appointments = Appointment::with(['status:id,title,color', 'familyAppointments', 'familyAppointments.user', 'familyAppointments.status:id,title,color'])
            ->get()
            ->where('event_date.date_time', '>', Carbon::today()->format('Y-m-d H:i:s'));

        $appointment_groups = $appointments->pluck('appointmentable_type')->unique();
        $statuses = $appointments->pluck('status')->unique();
        return response()->view('backend.appointment.upcoming', compact('appointment_types','appointments','statuses', 'appointment_groups', 'page_description', 'page_title'));
    }

    public function historical()
    {
        $appointment_types = $this->appointment_types;
        $page_title = "Historical Appointments";
        $page_description = "Showing only past Appointments";
        $appointments = Appointment::with(['status:id,title,color', 'familyAppointments', 'familyAppointments.user', 'familyAppointments.status:id,title,color'])
            ->get()
            ->where('event_date.date_time', '<', Carbon::today()->format('Y-m-d H:i:s'));

        $appointment_groups = $appointments->pluck('appointmentable_type')->unique();
        $statuses = $appointments->pluck('status')->unique();
        return response()->view('backend.appointment.historical', compact('appointment_types','appointments','statuses', 'appointment_groups', 'page_description', 'page_title'));
    }
}
