<?php

namespace App\Observers;

use App\Profile;
use App\User;

class ProfileObserver
{
    /**
     * Handle the profile "created" event.
     *
     * @param  \App\Profile  $profile
     * @return void
     */
    public function created(Profile $profile)
    {
        User::sendWelcomeEmail($profile);
    }

    /**
     * Handle the profile "updated" event.
     *
     * @param  \App\Profile  $profile
     * @return void
     */
    public function updated(Profile $profile)
    {
        //
    }

    /**
     * Handle the profile "deleted" event.
     *
     * @param  \App\Profile  $profile
     * @return void
     */
    public function deleted(Profile $profile)
    {
        //
    }

    /**
     * Handle the profile "restored" event.
     *
     * @param  \App\Profile  $profile
     * @return void
     */
    public function restored(Profile $profile)
    {
        //
    }

    /**
     * Handle the profile "force deleted" event.
     *
     * @param  \App\Profile  $profile
     * @return void
     */
    public function forceDeleted(Profile $profile)
    {
        //
    }
}
