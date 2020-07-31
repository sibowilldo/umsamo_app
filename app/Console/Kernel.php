<?php

namespace App\Console;

use App\Appointment;
use App\CronJobs\ProcessPatientList;
use App\CronJobs\ProcessUpcomingAppointmentReminders;
use App\Notifications\AppointmentReminder;
use App\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

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

//        $schedule->command('patient:send')->everyMinute();

//        $schedule->call((new ProcessPatientList())->process())->dailyAt('5:30');
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
