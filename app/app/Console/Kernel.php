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
        'App\Console\Commands\cronNotificacao',
        \Webklex\IMAP\Commands\ImapIdleCommand::class,
        \App\Console\Commands\checarImap::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        ///php artisan schedule:run
        // $schedule->command('inspire')->hourly();

        //Executa a tarefa todos os dias as 01:00
        $schedule->command('cronnotificacao:cron')->dailyAt('01:00')->timezone('America/Buenos_Aires');
        $schedule->command('checar_imap')->everyFiveMinutes()->timezone('America/Buenos_Aires');
        //$schedule->command('cronnotificacao:cron')->weekly()->fridays()->at('08:45')->timezone('America/Buenos_Aires');



        /*
        $schedule->call(function () {
            \Log::info('Testing scheduler: ' . date("d/m/Y h:i:sa"));
        })->everyMinute()->timezone('America/Buenos_Aires');
        */

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
