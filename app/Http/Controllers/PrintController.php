<?php

namespace App\Http\Controllers;

use App\Appointment;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Response;

class PrintController extends Controller
{
    public function appointmentsTodayPdf()
    {

        $appointments = Appointment::with(['status:id,title,color', 'familyAppointments', 'familyAppointments.user', 'familyAppointments.status:id,title,color'])
            ->get()
            ->where('event_date.date_time', '=', Carbon::today()->format('Y-m-d H:i:s'));

        $total = count($appointments);

        $statuses =$appointments->pluck('status')->unique();

        $page_title = 'Patients List';
        $date = Carbon::today()->format('Y-m-d');



        $pdf = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])->loadView('pdf.appointment.today', compact('appointments', 'statuses', 'date', 'total', 'page_title'));
        return $pdf->stream();

        return response()->view('pdf.appointment.today', compact('appointments', 'statuses', 'date', 'total', 'page_title'));
    }
}
