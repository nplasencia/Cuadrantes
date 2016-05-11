<?php

use Illuminate\Database\Seeder;
use Cuadrantes\Entities\Period;

class PeriodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $periods = ['WORK' => 'Laborales', 'SATURDAY' => 'Sábados', 'SUNDAY' => 'domingos/festivos'];

        foreach ($periods as $code => $name) {
            $period = new Period();
            $period->code       = $code;
            $period->value      = $name;
            $period->timestamps = false;
            $period->save();
        }
    }
}
