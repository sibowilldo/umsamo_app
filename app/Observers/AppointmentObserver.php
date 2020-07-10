<?php

namespace App\Observers;

use App\Appointment;
use App\Notifications\AppointmentCreated;
use App\Repositories\AppointmentRepository;
use App\Repositories\EventDateRepository;
use Illuminate\Support\Facades\Auth;

class AppointmentObserver
{
    /**
     * Handle the appointment "created" event.
     *
     * @param  \App\Appointment  $appointment
     * @return void
     */
    public function created(Appointment $appointment)
    {
        EventDateRepository::UPDATE_LIMIT($appointment->event_date, $appointment);
        if($appointment->appointmentable_type == 'App\User'){
            $appointment->appointmentable->notify(new AppointmentCreated($appointment));
        }
    }

    /**
     * Handle the appointment "updated" event.
     *
     * @param  \App\Appointment  $appointment
     * @return void
     */
    public function updated(Appointment $appointment)
    {
        EventDateRepository::UPDATE_LIMIT($appointment->event_date, $appointment);
    }

    /**
     * Handle the appointment "deleted" event.
     *
     * @param  \App\Appointment  $appointment
     * @return void
     */
    public function deleted(Appointment $appointment)
    {
        EventDateRepository::UPDATE_LIMIT($appointment->event_date, $appointment);
    }

    /**
     * Handle the appointment "restored" event.
     *
     * @param  \App\Appointment  $appointment
     * @return void
     */
    public function restored(Appointment $appointment)
    {
        //
    }

    /**
     * Handle the appointment "force deleted" event.
     *
     * @param  \App\Appointment  $appointment
     * @return void
     */
    public function forceDeleted(Appointment $appointment)
    {
        //
    }
}
