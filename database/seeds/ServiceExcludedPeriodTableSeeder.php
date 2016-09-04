<?php

use Illuminate\Database\Seeder;
use Cuadrantes\Entities\ServiceExcludedPeriod;
use Cuadrantes\Commons\ServiceExcludedPeriodContract;

class ServiceExcludedPeriodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $periods = [['SCHOOL', 'Época Escolar', '0000-07-01', '0000-08-31']];

        foreach ($periods as $period) {
            $excludedPeriod = new ServiceExcludedPeriod;
	        $excludedPeriod->code      = $period[0];
	        $excludedPeriod->value     = $period[1];
	        $excludedPeriod->date_from = $period[2];
	        $excludedPeriod->date_to   = $period[3];
            $excludedPeriod->save();
        }
    }
}
