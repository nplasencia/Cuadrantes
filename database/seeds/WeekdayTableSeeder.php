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
            'value' => 'Lunes'
        ]);
        DB::table('weekdays')->insert([
            'code'  => 'TUE',
            'value' => 'Martes'
        ]);
        DB::table('weekdays')->insert([
            'code'  => 'WED',
            'value' => 'Miércoles'
        ]);
        DB::table('weekdays')->insert([
            'code'  => 'THU',
            'value' => 'Jueves'
        ]);
        DB::table('weekdays')->insert([
            'code'  => 'FRI',
            'value' => 'Viernes'
        ]);
        DB::table('weekdays')->insert([
            'code'  => 'SAT',
            'value' => 'Sábado'
        ]);
        DB::table('weekdays')->insert([
            'code'  => 'SUN',
            'value' => 'Domingo'
        ]);
    }
}
