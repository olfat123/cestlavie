<?php

namespace App\Console;

use App\Jobs\SendWeeklyMessage;
use App\Jobs\SendWeeklyVerse;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $this->weekly($schedule);
        $schedule->job(new SendWeeklyMessage())->everyMinute();
        // $schedule->command('inspire')->hourly();
    }

    protected function weekly($schedule)
    {
        $schedule->job(new SendWeeklyMessage())->hourly();
        $schedule->job(new SendWeeklyVerse())->hourly();
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
