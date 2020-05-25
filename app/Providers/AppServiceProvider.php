<?php

namespace App\Providers;

use App\Observers\StatusObserver;
use App\Status;
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
    }
}
