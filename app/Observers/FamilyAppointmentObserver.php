<?php

namespace App\Observers;

use App\FamilyAppointment;
use Illuminate\Support\Facades\Log;

class FamilyAppointmentObserver
{
    /**
     * Handle the family appointment "created" event.
     *
     * @param  \App\FamilyAppointment  $familyAppointment
     * @return void
     */
    public function created(FamilyAppointment $familyAppointment)
    {
        Log::info('Notifying '. $familyAppointment->user->profile->fullname. ' about a new family appointment');
    }

    /**
     * Handle the family appointment "updated" event.
     *
     * @param  \App\FamilyAppointment  $familyAppointment
     * @return void
     */
    public function updated(FamilyAppointment $familyAppointment)
    {
        //
    }

    /**
     * Handle the family appointment "deleted" event.
     *
     * @param  \App\FamilyAppointment  $familyAppointment
     * @return void
     */
    public function deleted(FamilyAppointment $familyAppointment)
    {
        //
    }

    /**
     * Handle the family appointment "restored" event.
     *
     * @param  \App\FamilyAppointment  $familyAppointment
     * @return void
     */
    public function restored(FamilyAppointment $familyAppointment)
    {
        //
    }

    /**
     * Handle the family appointment "force deleted" event.
     *
     * @param  \App\FamilyAppointment  $familyAppointment
     * @return void
     */
    public function forceDeleted(FamilyAppointment $familyAppointment)
    {
        //
    }
}
