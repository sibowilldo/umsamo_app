<?php

namespace App\Console\Commands;

use App\Appointment;
use App\Mail\SendPatientsList;
use App\Notifications\Slack\SystemNotifications;
use App\Repositories\AppointmentRepository;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PDF;

class SendPatientList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'patient:send {list=preliminary} {--date= : Date Format Y-m-d}';

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
     * @throws \Exception
     */
    public function handle()
    {
        $list_type = $this->argument('list');
        $custom_date = $list_type === 'preliminary'? Carbon::tomorrow(): Carbon::today();

        if($this->option('date')){
            try {
                $custom_date = new Carbon($this->option('date'));
            }catch (\Exception $e){
            }
        }
        $appointment_statuses = [Appointment::STATUS_CONFIRMED];
        $appointments = AppointmentRepository::CUSTOM_DATE_APPOINTMENTS($custom_date->format('Y-m-d'),$appointment_statuses);

        $total = count($appointments);

        if($total > 0){
            $administrators = User::role(Collect([User::ADMIN_ROLE, User::SUPER_ADMIN_ROLE]))->get();

            $statuses = $appointments->pluck('status')->unique();
            $date = $custom_date->format('Y-m-d');
            $page_title = "Patients {$list_type} list";

            $pdf = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])->loadView('pdf.appointment.today', compact('appointments', 'statuses', 'date', 'total', 'page_title'));

            $file_name = Str::slug($page_title . '-'.$custom_date->format('Ymdhis'));
            Storage::put("downloads/appointments/{$file_name}.pdf", $pdf->output(), 'public');
            $attachment = asset("downloads/appointments/{$file_name}.pdf");
            foreach ($administrators->pluck('email') as $administrator){
                Mail::to($administrator)->send(new SendPatientsList($attachment, $list_type === 'actual'));
            }

            Notification::route('slack', 'https://hooks.slack.com/services/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')
                ->notify(new SystemNotifications($this->argument('list') . ' appointments list sent to: ' . implode(', ', $administrators->pluck('email')->toArray())));
            return 1;
        }else{
            Notification::route('slack', 'https://hooks.slack.com/services/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')
                ->notify(new SystemNotifications('No Appointments for this date: ' . $custom_date->format('Y-m-d')));
            return 0;
        }

    }
}
