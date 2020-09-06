<?php

namespace App\Console\Commands;

use App\Appointment;
use App\Notifications\AppointmentReminder;
use App\Notifications\Slack\SystemNotifications;
use App\Repositories\AppointmentRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class UpcomingAppointmentReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'appointment:reminder {date : Date Format Y-m-d} {--status=*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notifications to users who have upcoming Appointments';

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
     * @return void
     */
    public function handle()
    {
        $details= [];
        $statuses = $this->option('status')?[$this->option('status')]:[Appointment::STATUS_CONFIRMED];

        $custom_date = $this->argument('date');
        $appointments = AppointmentRepository::CUSTOM_DATE_APPOINTMENTS($custom_date, $statuses);

        $details['date_time'] = $custom_date;
        $recipients = [];
        foreach ($appointments as $appointment){
            $details['reference'] = $appointment->reference;
            $details['url'] = route('appointments.show', $appointment->uuid);
            switch ($appointment->appointmentable_type){
                case Appointment::MORPH_TYPE_USER :
                    $appointment->appointmentable->notify(new AppointmentReminder($details));
                    array_push($recipients, $appointment->appointmentable->email);
                    break;
                case Appointment::MORPH_TYPE_FAMILY :
                    foreach ($appointment->appointmentable->familyAppointments as $familyAppointment){
                        $familyAppointment->user->notify(new AppointmentReminder($details));
                        array_push($recipients, $familyAppointment->user->email);
                    }
                    break;
            }
        }
        Notification::route('slack', 'https://hooks.slack.com/services/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')
            ->notify(new SystemNotifications( sprintf("Sent reminders to %s recipients : %s", count($recipients), implode(', ', $recipients)  )));
    }
}
