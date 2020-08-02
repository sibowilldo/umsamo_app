<?php

namespace App\Console;

use App\Appointment;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('backup:run')->daily()->at('1:00');
        $schedule->command('backup:monitor')->weeklyOn(5);

        //[Example] appointment:reminder 2020-07-31 --status=13
        //[description]"sends reminders to patients"
        $schedule->command("appointment:reminder ". today()->addDays(2)->format('Y-m-d')." --status=".Appointment::STATUS_CONFIRMED)->dailyAt('5:30');

        //[description] "Sends a preliminary list, that is subject to change"
        $schedule->command('patient:send')->dailyAt('17:00');
        //[description] "Sends an actual list."
        $schedule->command('patient:send actual')->dailyAt('0:05');

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
