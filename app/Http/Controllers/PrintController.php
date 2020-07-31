<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\CronJobs\ProcessPatientList;
use App\EventDate;
use App\Repositories\AppointmentRepository;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Response;

class PrintController extends Controller
{
    public function appointmentsTodayPdf()
    {

        $date = today()->format('Y-m-d');

        $appointments = AppointmentRepository::CUSTOM_DATE_APPOINTMENTS($date,[Appointment::STATUS_CONFIRMED]);

        $total = count($appointments);
        $statuses =$appointments->pluck('status')->unique();
        $page_title = 'Patients List - '. $date;

        $pdf = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])->loadView('pdf.appointment.today', compact('appointments', 'statuses', 'date', 'total', 'page_title'));

        return $pdf->stream();

        return response()->view('pdf.appointment.today', compact('appointments', 'statuses', 'date', 'total', 'page_title'));
    }
}
