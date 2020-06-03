<?php

namespace App\Providers;

use App\Observers\StatusObserver;
use App\Observers\UserObserver;
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
        Status::observe(StatusObserver::class);
        User::observe(UserObserver::class);
    }
}
