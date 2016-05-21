<?php

use Cuadrantes\Entities\Weekday;
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
        $weekdays = ['MON' => 'Lunes', 'TUE' => 'Martes', 'WED' => 'Miércoles', 'THU' => 'Jueves', 'FRI' => 'Viernes', 'SAT' => 'Sábado', 'SUN' => 'Domingo'];

        foreach ($weekdays as $code => $name) {
            $weekday = new Weekday(compact($code, $name));
            $weekday->timestamps = false;
            $weekday->save();
        }
    }
}