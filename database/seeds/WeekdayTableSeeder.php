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
        $weekdays = [[1, 'MON', 'Lunes'], [1, 'TUE', 'Martes'], [1, 'WED', 'Miércoles'], [1, 'THU', 'Jueves'], [1, 'FRI', 'Viernes'],
                     [2, 'SAT', 'Sábado'], [3, 'SUN', 'Domingo']
                    ];

        foreach ($weekdays as $values) {
            $weekday = new Weekday([WeekdayContract::PERIOD_ID => $values[0], WeekdayContract::CODE => $values[1], WeekdayContract::VALUE => $values[2]]);
            $weekday->save();
        }
    }
}