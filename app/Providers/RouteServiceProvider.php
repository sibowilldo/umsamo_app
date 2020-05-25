<?php

namespace App\Providers;

use App\Attachment;
use App\Event;
use App\Invoice;
use App\Appointment;
use App\User;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
        Route::bind('user', function ($user) {
            return User::whereUuid($user)->firstOrFail();
        });
        Route::bind('appointment', function ($appointment) {
            return Appointment::whereUuid($appointment)->firstOrFail();
        });
        Route::bind('invoice', function ($invoice) {
            return Invoice::whereUuid($invoice)->firstOrFail();
        });
        Route::bind('event', function ($event) {
            return Event::whereUuid($event)->firstOrFail();
        });
        Route::bind('attachment', function ($attachment) {
            return Attachment::whereUuid($attachment)->firstOrFail();

        });
    }
    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
