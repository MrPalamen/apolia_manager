<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RadioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('radios')->insert([
            'name' => 'radio',
            'cp' => 000.0,
            'lp' => 000.0,
            'cp_c' => 000.0,
            'name_user' => 'MrPalamen',
        ]);
    }
}
