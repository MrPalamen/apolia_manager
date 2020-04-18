<?php

namespace App\Console;

use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

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
        $schedule->call(function () {
            $data = [
                'cp' => rand (50*10, 400*10) / 10,
                'lp' => rand (30*10, 87*10) / 10,
                'cp_c' => rand (50*10, 400*10) / 10
            ];

            DB::table('radios')->where('id', 1)->update(array(
                'cp' => $data['cp'],
                'lp' => $data['lp'],
                'cp_c' => $data['cp_c'],
                'name_user' => 'BOT',
                'updated_at' => Carbon::now('Europe/Paris')->format('Y-m-d H:i:s')
            ));
        })->cron('0 2,8,14,20 * * *');
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
