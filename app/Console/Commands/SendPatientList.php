<?php

namespace App\Console\Commands;

use App\Appointment;
use App\Mail\SendPatientsList;
use App\Repositories\AppointmentRepository;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use PDF;

class SendPatientList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'patient:send {list=preliminary}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends a list of patients to administrators and kingpins';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $list_type = $this->argument('list');
        $administrators = User::role(Collect([User::ADMIN_ROLE, User::SUPER_ADMIN_ROLE]))->get();

        $custom_date = Carbon::today()->format('Y-m-d');
        $appointment_statuses = [Appointment::STATUS_CONFIRMED];
        $appointments = AppointmentRepository::CUSTOM_DATE_APPOINTMENTS($custom_date,$appointment_statuses);

        $total = count($appointments);

        $statuses = $appointments->pluck('status')->unique();
        $date = today()->format('Y-m-d');
        $page_title = "Patients {$list_type} list";

        $pdf = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])->loadView('pdf.appointment.today', compact('appointments', 'statuses', 'date', 'total', 'page_title'));

        Storage::put('downloads/appointments/'.$page_title.'.pdf', $pdf->output(), 'public');
        $attachment = asset('downloads/appointments/'.$page_title.'.pdf');
        foreach ($administrators->pluck('email') as $administrator){
            Log::info('Sending List to: '.$administrator);
            Mail::to($administrator)->send(new SendPatientsList($attachment));
        }

        Log::notice($this->argument('list'));

        return 1;
    }
}
