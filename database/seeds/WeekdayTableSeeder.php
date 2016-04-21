<?php

use Illuminate\Database\Seeder;

class WeekdayTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('weekdays')->insert([
            'code'  => 'MON',
            'value' => '1'
        ]);
        DB::table('weekdays')->insert([
            'code'  => 'TUE',
            'value' => '2'
        ]);
        DB::table('weekdays')->insert([
            'code'  => 'WED',
            'value' => '3'
        ]);
        DB::table('weekdays')->insert([
            'code'  => 'THU',
            'value' => '4'
        ]);
        DB::table('weekdays')->insert([
            'code'  => 'FRI',
            'value' => '5'
        ]);
        DB::table('weekdays')->insert([
            'code'  => 'SAT',
            'value' => '6'
        ]);
        DB::table('weekdays')->insert([
            'code'  => 'SUN',
            'value' => '7'
        ]);
    }
}
