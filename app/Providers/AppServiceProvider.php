<?php

namespace App\Providers;

use App\Appointment;
use App\EventDate;
use App\Observers\AppointmentObserver;
use App\Observers\EventDateObserver;
use App\Observers\ProfileObserver;
use App\Observers\StatusObserver;
use App\Observers\UserObserver;
use App\Profile;
use App\Status;
use App\User;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Appointment::observe(AppointmentObserver::class);
        EventDate::observe(EventDateObserver::class);
        Status::observe(StatusObserver::class);
        Profile::observe(ProfileObserver::class);
        User::observe(UserObserver::class);
    }
}
