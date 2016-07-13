<?php

use Cuadrantes\Commons\ServiceConditionContract;
use Cuadrantes\Entities\ServiceCondition;

use Illuminate\Database\Seeder;

class ServiceConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $conditions = [
                         // Grupo 1 (Servicios: 1, 2, 3 y 4)
                         [1, 1, 1, 35], [1, 1, 2, 35],
                         // Grupo 2 (Servicios 5 y 6)
                         [1, 2, 3, 38],
                         // Grupo 3 (Servicios 7 - 12)
                         [1, 3, 4, 39],[1, 3, 5, 39],[1, 3, 6, 39],
                      ];
        foreach ($conditions as $condition) {
            $serviceCondition = new ServiceCondition([ServiceConditionContract::PERIOD_ID => $condition[0], ServiceConditionContract::SERVICE_GROUP => $condition[1],
                                    ServiceConditionContract::PAIR_ID => $condition[2], ServiceConditionContract::SUBSTITUTE_ID => $condition[3]]);
            $serviceCondition->save();
        }
    }
}
