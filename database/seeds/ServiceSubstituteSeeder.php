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
                         [1, 1, 10], [1, 1, 24], [1, 1, 49], [1, 1, 40],
                         // Grupo 2 (Servicios 5 y 6)
                         [1, 2, 9], [1, 2, 16],
                         // Grupo 3 (Servicios 7 - 12)
                         /*[1, 3, 4, 40],[1, 3, 5, 40],[1, 3, 6, 40],
	                     // Grupo 4 (Servicios 13 - 20)
	                     [1, 4, 7, null],[1, 4, 8, null],[1, 4, 9, null],[1, 4, 10, null],
	                     // Grupo 5 (Servicio 21)
	                     [1, 5, null, null],
	                     // Grupo 6 (Servicios 22 - 24)
	                     [1, 6, 11, null],
	                     // Grupo 7 (Servicio 25)
	                     [1, 7, 43, null],
	                     // Grupo 8 (Servicios 26 - 29)
	                     [1, 8, 12, null],[1, 8, 13, null],
	                     // Grupo 9 (Servicios 30, 31)
	                     [1, 9, 14, null],
	                     // Grupo 10 (Servicios 32, 33)
	                     [1, 10, 15, null],
	                     // Grupo 11 (Servicios 34, 35)
	                     [1, 11, 16, null],
	                     // Grupo 12 (Servicios 36 - 47)
	                     [1, 12, 17, null],[1, 12, 18, null],[1, 12, 19, null],[1, 12, 20, null], [1, 12, 21, null],[1, 12, 22, null],
	                     // Grupo 13 (Servicio 48)
	                     [1, 13, null, null],
	                     // Grupo 14 (Servicios 49, 50)
	                     [1, 14, 23, 42],
						 // Sábados
	                     // Grupo 1 (Servicios 1 y 2)
	                     [2, 1, 2, 35],
	                     // Grupo 2 (Servicio 3)
	                     [2, 2, 39, null],
	                     // Grupo 3 (servicio 4)
	                     [2, 3, 43, null],
	                     // Grupo 4 (servicio 5-9)
	                     [2, 4, 10, null],[2, 4, 7, null],[2, 4, 8, null],[2, 4, null, null],
	                     // Grupo 5 (Servicio 10 y 11)
	                     [2, 5, 39, null],[2, 5, null, null],
	                     // Grupo 6 (Servicio 12 y 13)
	                     [2, 6, null, null],
	                     // Grupo 7 (Servicio 14-21)
	                     [2, 7, null, null],
	                     // Grupo 8 (Servicio 22 y 23)
	                     [2, 8, 42, null], [2, 8, 22, null],*/
                      ];
        foreach ($conditions as $condition) {
            $serviceCondition = new ServiceCondition([ServiceConditionContract::PERIOD_ID => $condition[0], ServiceConditionContract::SERVICE_GROUP => $condition[1],
                                    ServiceConditionContract::DRIVER_ID => $condition[2]]);
            $serviceCondition->save();
        }
    }
}
