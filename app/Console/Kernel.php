<?php

namespace App\Console;

use App\User;
use DateTime;
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
        $schedule->call(function() { 
            $users = User::all();
            foreach ($users as $user) {
                if($user->user_verify==null){                    
                    $created = $user->created_at;
                    $created = new DateTime($created);
                    $current = new DateTime();
                    $interval = $current->diff($created);
                    $days = $interval->format("%a");
                    if($days>10){
                        $user->delete();
                        $user->history()->forceDelete();
                    }
                }
            }
        })->everyMinute();
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
