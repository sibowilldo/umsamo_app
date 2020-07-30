<?php


namespace App\CronJobs;


use App\Appointment;
use App\EventDate;
use App\Notifications\AppointmentReminder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ProcessUpcomingAppointmentReminders
{
    public function __invoke()
    {
        $details= [];

        $event_date = EventDate::where('date_time', '=', Carbon::today()->addDays(2)->format('Y-m-d'))
            ->with(['appointments' => function($q){
                $q->where('status_id', Appointment::STATUS_CONFIRMED);
            }])
            ->first();
        $details['date_time'] = $event_date->date_time->format('M d, Y');
        $appointments = $event_date->appointments;
        foreach ($appointments as $appointment){
            $details['reference'] = $appointment->reference;
            $details['url'] = route('appointments.show', $appointment->uuid);
            switch ($appointment->appointmentable_type){
                case Appointment::MORPH_TYPE_USER :
                    $appointment->appointmentable->notify(new AppointmentReminder($details));
                    Log::info('Individual 2 Days Reminder: ['. $appointment->appointmentable->uuid . '] ' . $appointment->appointmentable->email);
                    break;
                case Appointment::MORPH_TYPE_FAMILY :
                    foreach ($appointment->appointmentable->familyAppointments as $familyAppointment){
                        $familyAppointment->user->notify(new AppointmentReminder($details));
                        Log::info('Family 2 Days Reminder: ['. $familyAppointment->user->uuid . '] ' . $familyAppointment->user->email);
                    }
                    break;
            }
        }
    }
}
