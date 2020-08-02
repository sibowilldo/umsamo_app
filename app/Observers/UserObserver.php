<?php

namespace App\Observers;


use App\Appointment;
use App\Notifications\ConfirmCellNumber;
use App\User;
use Illuminate\Support\Facades\Cache;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(User $user)
    {
        Cache::put("user.{$user->id}", $user, 120);
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        Cache::put("user.{$user->id}", $user, 120);
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        Cache::forget("user.{$user->id}");

        $user->profile()->delete();
        $user->appointments()->update(['status_id'=> Appointment::STATUS_DELETED]);
        $user->appointments()->delete();

    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        Cache::put("user.{$user->id}", $user, 120);

        $user->profile()->restore();
        $user->appointments()->update(['status_id'=> Appointment::STATUS_ACTIVE]);
        $user->appointments()->restore();
    }

    public function retrieved(User $user)
    {
        Cache::add("user.{$user->id}", $user, 120);
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        Cache::forget("user.{$user->id}");
    }
}
