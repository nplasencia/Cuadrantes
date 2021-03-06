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
                         [1, 3, 43],[1, 3, 30],[1, 3, 17],[1, 3, 3],[1, 3, 12],[1, 3, 25],
	                     // Grupo 4 (Servicios 13 - 22)
	                     [1, 4, 39],[1, 4, 41],[1, 4, 47],[1, 4, 18],[1, 4, 14],[1, 4, 46],[1, 4, 52],[1, 4, 8],[1, 4, 21],[1, 4, 54],
	                     // Grupo 5 (Servicios 23 - 25)
	                     [1, 5, 6],[1, 5, 2],[1, 5, 5],
	                     // Grupo 6 (Servicio 26)
	                     // Cualquier conductor
	                     // Grupo 7 (Servicios 27 - 30)
	                     [1, 7, 36],[1, 7, 38],[1, 7, 37],[1, 7, 4],
	                     // Grupo 8 (Servicios 31, 32)
	                     [1, 8, 44],[1, 8, 28],
	                     // Grupo 9 (Servicios 33, 34)
	                     [1, 9, 48],[1, 9, 1],
	                     // Grupo 10 (Servicios 35, 36)
	                     [1, 10, 11],[1, 10, 45],
	                     // Grupo 11 (Servicios 37 - 48)
	                     [1, 11, 58],[1, 11, 59],[1, 11, 20],[1, 11, 22],[1, 11, 29],[1, 11, 7],[1, 11, 32],[1, 11, 27],[1, 11, 31],[1, 11, 15],[1, 11, 19],[1, 11, 13],
	                     // Grupo 12 (Servicio 49)
	                     // Cualquier conductor
	                     // Grupo 13 (Servicios 50, 51)
	                     [1, 13, 55],[1, 13, 35],
	                     // Grupo 14
	                     [1, 14, 19],[1, 14, 5],[1, 14, 33],[1, 14, 34],
	                     // Resto auxiliares
	                     [1, 16, 23],
	                     [1, 17, 60],

						 // Sábados
	                     // Grupo 1 (Servicios 1 y 2)
	                     [2, 1, 49],[2, 1, 40],
	                     // Grupo 2 (Servicio 3)
	                     [2, 2, 65],
	                     // Grupo 3 (servicio 4)
	                     [2, 3, 28],
	                     // Grupo 4 (servicio 5-9)
	                     [2, 4, 46],[2, 4, 52],[2, 4, 41],[2, 4, 39],
	                     // Grupo 5 (Servicio 10 y 11)
	                     [2, 5, 26],
	                     // Grupo 6-7 (Servicio 12-21)
	                     // Cualquier conductor
	                     // Grupo 8 (Servicios 22 y 23)
	                     [2, 8, 79],[2, 8, 55],
	                     // Grupo 9 (Servicios 24-27)
	                     [2, 9, 76],[2, 9, 4],[2, 9, 37],
						 // Grupo 13 (Servicio auxiliar 35) Juana Moreno
	                     [2, 13, 23],
	                     // Grupo 14 (Servicio auxiliar 36) Delia Durán
	                     [2, 14, 60],

	                     // Domingos
	                     // Grupo 1 (Servicios 1 y 2)
	                     [3, 1, 68], [3, 1, 62],
	                     // Grupo 2 (Servicio 3)
	                     [3, 2, 65],
	                     // Grupo 4 (Servicio 5-9)
	                     [3, 4, 18], [3, 4, 47], [3, 4, 52], [3, 4, 14],
	                     // Grupo 5 (Servicios 10 y 11)
	                     [3, 5, 17],
	                     // Grupo 6 (Servicio 12)
	                     [3, 6, 23], [3, 6, 60],
	                     // Grupo 9 (Servicios 22 y 23)
	                     [3, 9, 79], [3, 9 , 55],
	                     // Grupo 10 (Servicios 24-27)
	                     [3, 10, 76],
                      ];
        foreach ($conditions as $condition) {
            $serviceCondition = new ServiceCondition([ServiceConditionContract::PERIOD_ID => $condition[0],
                                                      ServiceConditionContract::SERVICE_GROUP => $condition[1],
                                                      ServiceConditionContract::DRIVER_ID => $condition[2]]);
            $serviceCondition->save();
        }
    }
}
