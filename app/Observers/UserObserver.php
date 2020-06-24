<?php

namespace App\Observers;

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
        User::sendWelcomeEmail($user);
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
