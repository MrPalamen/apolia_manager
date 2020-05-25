<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SendCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
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
    }
}
