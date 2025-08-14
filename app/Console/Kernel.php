<?php

namespace App\Console;

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
        
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('send:profile-emails')->everyMinute();
        $schedule->command('reminders:follow-up')->everyMinute();
        // $schedule->command('reminders:follow-up')->everyMinute();
        $schedule->command('send:reminder-profile-emails')->everyMinute();
        $schedule->command('subscription:check-end-date')->everyMinute();
        $schedule->command('reminders:send')->everyMinute();
        $schedule->command('sms:send')->everyMinute();
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
