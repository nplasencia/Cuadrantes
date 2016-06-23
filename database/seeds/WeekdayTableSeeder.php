<?php

use Illuminate\Database\Seeder;

use Cuadrantes\Entities\Weekday;
use Cuadrantes\Commons\WeekdayContract;

class WeekdayTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $weekdays = ['MON' => 'Lunes', 'TUE' => 'Martes', 'WED' => 'Miércoles', 'THU' => 'Jueves', 'FRI' => 'Viernes', 'SAT' => 'Sábado', 'SUN' => 'Domingo'];

        foreach ($weekdays as $code => $name) {
            $weekday = new Weekday([WeekdayContract::CODE => $code, WeekdayContract::VALUE => $name]);
            $weekday->save();
        }
    }
}