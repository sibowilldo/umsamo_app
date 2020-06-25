<?php

namespace App\Observers;

use App\Appointment;
use App\Repositories\AppointmentRepository;
use App\Repositories\EventDateRepository;

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
