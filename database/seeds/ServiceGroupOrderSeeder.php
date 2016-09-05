<?php

use Cuadrantes\Commons\ServiceGroupOrderContract;
use Cuadrantes\Entities\ServiceGroupOrder;

use Illuminate\Database\Seeder;

class ServiceGroupOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = [
                    // Grupo 1 (Servicios: 1, 2, 3 y 4)
                    [1, 10, 1, 1, 1], [1, 10, 2, 2, 1], [1, 10, 3, 3, 1], [1, 10, 4, 0, 1],
                    [1, 24, 2, 1, 1], [1, 24, 1, 2, 1], [1, 24, 4, 3, 1], [1, 24, 3, 0, 1],
	                [1, 40, 3, 1, 1], [1, 40, 4, 2, 1], [1, 40, 1, 3, 1], [1, 40, 2, 0, 1],
                    [1, 49, 4, 1, 1], [1, 49, 3, 2, 1], [1, 49, 2, 3, 1], [1, 49, 1, 0, 1],
                    // Grupo 2 (Servicios: 5 y 6)
                    [1, 9,  5, 0, 2], [1, 9,  6, 1, 2],
                    [1, 16, 6, 0, 2], [1, 16, 5, 1, 2],
	                //Grupo 3 (Servicios: 7-12)
	                [1, 43,  7, 5 ,3], [1, 43,  8, 0 ,3], [1, 43,  9, 1 ,3], [1, 43, 10, 2 ,3], [1, 43, 11, 3 ,3], [1, 43, 12, 4 ,3],
	                [1, 30,  8, 5 ,3], [1, 30,  7, 0 ,3], [1, 30, 10, 1 ,3], [1, 30,  9, 2 ,3], [1, 30, 12, 3 ,3], [1, 30, 11, 4 ,3],
	                [1, 17,  9, 5 ,3], [1, 17, 10, 0 ,3], [1, 17, 11, 1 ,3], [1, 17, 12, 2 ,3], [1, 17,  7, 3 ,3], [1, 17,  8, 4 ,3],
			        [1, 12, 10, 5 ,3], [1, 12,  9, 0 ,3], [1, 12, 12, 1 ,3], [1, 12, 11, 2 ,3], [1, 12,  8, 3 ,3], [1, 12,  7, 4 ,3],
			        [1,  3, 11, 5 ,3], [1,  3, 12, 0 ,3], [1,  3,  7, 1 ,3], [1,  3,  8, 2 ,3], [1,  3,  9, 3 ,3], [1,  3, 10, 4 ,3],
			        [1, 25, 12, 5 ,3], [1, 25, 11, 0 ,3], [1, 25,  8, 1 ,3], [1, 25,  7, 2 ,3], [1, 25, 10, 3 ,3], [1, 25,  9, 4 ,3],
	                //Grupo 4 (Servicios: 13-22)
			        [1, 46,  13, 2, 4], [1, 46,  14, 3, 4], [1, 46,  15, 5, 4], [1, 46,  16, 6, 4], [1, 46,  17, 6, 4], [1, 46,  18, 7, 4], [1, 46,  19, 8, 4], [1, 46,  20, 9, 4], [1, 46,  21, 0, 4], [1, 46, 147, 1, 4],
	                [1, 14,  14, 2, 4], [1, 14,  13, 3, 4], [1, 14,  16, 5, 4], [1, 14,  15, 6, 4], [1, 14,  18, 6, 4], [1, 14,  17, 7, 4], [1, 14,  20, 8, 4], [1, 14,  19, 9, 4], [1, 14, 147, 0, 4], [1, 14,  21, 1, 4],
	                [1, 21,  15, 2, 4], [1, 21,  16, 3, 4], [1, 21,  17, 5, 4], [1, 21,  18, 6, 4], [1, 21,  19, 6, 4], [1, 21,  20, 7, 4], [1, 21,  21, 8, 4], [1, 21, 147, 9, 4], [1, 21,  13, 0, 4], [1, 21,  14, 1, 4],
	                [1, 54,  16, 2, 4], [1, 54,  15, 3, 4], [1, 54,  18, 5, 4], [1, 54,  17, 6, 4], [1, 54,  20, 6, 4], [1, 54,  19, 7, 4], [1, 54, 147, 8, 4], [1, 54,  21, 9, 4], [1, 54,  14, 0, 4], [1, 54,  13, 1, 4],
	                [1,  8,  17, 2, 4], [1,  8,  18, 3, 4], [1,  8,  19, 5, 4], [1,  8,  20, 6, 4], [1,  8,  21, 6, 4], [1,  8, 147, 7, 4], [1,  8,  13, 8, 4], [1,  8,  14, 9, 4], [1,  8,  15, 0, 4], [1,  8,  16, 1, 4],
	                [1, 52,  18, 2, 4], [1, 52,  17, 3, 4], [1, 52,  20, 5, 4], [1, 52,  19, 6, 4], [1, 52, 147, 6, 4], [1, 52,  21, 7, 4], [1, 52,  14, 8, 4], [1, 52,  13, 9, 4], [1, 52,  16, 0, 4], [1, 52,  15, 1, 4],
	                [1, 41,  19, 2, 4], [1, 41,  20, 3, 4], [1, 41,  21, 5, 4], [1, 41, 147, 6, 4], [1, 41,  13, 6, 4], [1, 41,  14, 7, 4], [1, 41,  15, 8, 4], [1, 41,  16, 9, 4], [1, 41,  17, 0, 4], [1, 41,  18, 1, 4],
	                [1, 39,  20, 2, 4], [1, 39,  19, 3, 4], [1, 39, 147, 5, 4], [1, 39,  21, 6, 4], [1, 39,  14, 6, 4], [1, 39,  13, 7, 4], [1, 39,  16, 8, 4], [1, 39,  15, 9, 4], [1, 39,  18, 0, 4], [1, 39,  17, 1, 4],
	                [1, 18,  21, 2, 4], [1, 18, 147, 3, 4], [1, 18,  13, 5, 4], [1, 18,  14, 6, 4], [1, 18,  15, 6, 4], [1, 18,  16, 7, 4], [1, 18,  17, 8, 4], [1, 18,  18, 9, 4], [1, 18,  19, 0, 4], [1, 18,  20, 1, 4],
	                [1, 47, 147, 2, 4], [1, 47,  21, 3, 4], [1, 47,  14, 5, 4], [1, 47,  13, 6, 4], [1, 47,  16, 6, 4], [1, 47,  15, 7, 4], [1, 47,  18, 8, 4], [1, 47,  17, 9, 4], [1, 47,  20, 0, 4], [1, 47,  19, 1, 4],
	                //Grupo 5 (Servicios: 23-25)
	                [1,  6, 22, 2, 5], [1,  6, 24, 0, 5], [1,  6, 23, 1, 5],
	                [1,  2, 23, 2, 5], [1,  2, 22, 0, 5], [1,  2, 24, 1, 5],
	                [1,  5, 24, 2, 5], [1,  5, 23, 0, 5], [1,  5, 22, 1, 5],
	                //Grupo 6 (Servicio 26)
	                // Cualquier conductor
			        //Grupo 7 (Servicios: 27-30)
	                [1, 36, 26, 3, 7], [1, 36, 27, 0, 7], [1, 36, 28, 1, 7], [1, 36, 29, 2, 7],
	                [1, 38, 27, 3, 7], [1, 38, 26, 0, 7], [1, 38, 29, 1, 7], [1, 38, 28, 2, 7],
	                [1, 37, 28, 3, 7], [1, 37, 29, 0, 7], [1, 37, 26, 1, 7], [1, 37, 27, 2, 7],
	                [1,  4, 29, 3, 7], [1,  4, 28, 0, 7], [1,  4, 27, 1, 7], [1,  4, 26, 2, 7],
	                //Grupo 8 (Servicios: 31-32)
	                [1, 44, 30, 1, 8], [1, 44, 30, 0, 8],
	                [1, 28, 31, 1, 8], [1, 28, 31, 0, 8],
	                //Grupo 9 (Servicios: 33-34)
	                [1, 48, 32, 1, 9], [1, 48, 33, 0, 9],
	                [1,  1, 33, 1, 9], [1,  1, 32, 0, 9],
	                //Grupo 10 (Servicios: 35-36)
	                [1, 45, 34, 0, 10], [1, 45, 35, 1, 10],
	                [1, 11, 35, 0, 10], [1, 11, 34, 1, 10],
	                //Grupo 11 (Servicios: 37-48)
	                [1, 13, 36, 4, 11],[1, 13, 39, 5, 11],[1, 13, 38, 6, 11],[1, 13, 41, 7, 11],[1, 13, 40, 8, 11],[1, 13, 43, 9, 11],[1, 13, 42, 10, 11],[1, 13, 45, 11, 11],[1, 13, 44, 0, 11],[1, 13, 47, 1, 11],[1, 13, 46, 2, 11],[1, 13, 37, 3, 11],
	                [1, 19, 37, 4, 11],[1, 19, 38, 5, 11],[1, 19, 39, 6, 11],[1, 19, 40, 7, 11],[1, 19, 41, 8, 11],[1, 19, 42, 9, 11],[1, 19, 43, 10, 11],[1, 19, 44, 11, 11],[1, 19, 45, 0, 11],[1, 19, 46, 1, 11],[1, 19, 47, 2, 11],[1, 19, 36, 3, 11],
			        [1, 59, 38, 4, 11],[1, 59, 41, 5, 11],[1, 59, 40, 6, 11],[1, 59, 43, 7, 11],[1, 59, 42, 8, 11],[1, 59, 45, 9, 11],[1, 59, 44, 10, 11],[1, 59, 47, 11, 11],[1, 59, 46, 0, 11],[1, 59, 37, 1, 11],[1, 59, 36, 2, 11],[1, 59, 39, 3, 11],
			        [1, 58, 39, 4, 11],[1, 58, 40, 5, 11],[1, 58, 41, 6, 11],[1, 58, 42, 7, 11],[1, 58, 43, 8, 11],[1, 58, 44, 9, 11],[1, 58, 45, 10, 11],[1, 58, 46, 11, 11],[1, 58, 47, 0, 11],[1, 58, 36, 1, 11],[1, 58, 37, 2, 11],[1, 58, 38, 3, 11],
			        [1, 22, 40, 4, 11],[1, 22, 43, 5, 11],[1, 22, 42, 6, 11],[1, 22, 45, 7, 11],[1, 22, 44, 8, 11],[1, 22, 47, 9, 11],[1, 22, 46, 10, 11],[1, 22, 37, 11, 11],[1, 22, 36, 0, 11],[1, 22, 39, 1, 11],[1, 22, 38, 2, 11],[1, 22, 41, 3, 11],
			        [1, 20, 41, 4, 11],[1, 20, 42, 5, 11],[1, 20, 43, 6, 11],[1, 20, 44, 7, 11],[1, 20, 45, 8, 11],[1, 20, 46, 9, 11],[1, 20, 47, 10, 11],[1, 20, 36, 11, 11],[1, 20, 37, 0, 11],[1, 20, 38, 1, 11],[1, 20, 39, 2, 11],[1, 20, 40, 3, 11],
			        [1,  7, 42, 4, 11],[1,  7, 45, 5, 11],[1,  7, 44, 6, 11],[1,  7, 47, 7, 11],[1,  7, 46, 8, 11],[1,  7, 37, 9, 11],[1,  7, 36, 10, 11],[1,  7, 39, 11, 11],[1,  7, 38, 0, 11],[1,  7, 41, 1, 11],[1,  7, 40, 2, 11],[1,  7, 43, 3, 11],
			        [1, 29, 43, 4, 11],[1, 29, 44, 5, 11],[1, 29, 45, 6, 11],[1, 29, 46, 7, 11],[1, 29, 47, 8, 11],[1, 29, 36, 9, 11],[1, 29, 37, 10, 11],[1, 29, 38, 11, 11],[1, 29, 39, 0, 11],[1, 29, 40, 1, 11],[1, 29, 41, 2, 11],[1, 29, 42, 3, 11],
			        [1, 27, 44, 4, 11],[1, 27, 47, 5, 11],[1, 27, 46, 6, 11],[1, 27, 37, 7, 11],[1, 27, 36, 8, 11],[1, 27, 39, 9, 11],[1, 27, 38, 10, 11],[1, 27, 41, 11, 11],[1, 27, 40, 0, 11],[1, 27, 43, 1, 11],[1, 27, 42, 2, 11],[1, 27, 45, 3, 11],
			        [1, 32, 45, 4, 11],[1, 32, 46, 5, 11],[1, 32, 47, 6, 11],[1, 32, 36, 7, 11],[1, 32, 37, 8, 11],[1, 32, 38, 9, 11],[1, 32, 39, 10, 11],[1, 32, 40, 11, 11],[1, 32, 41, 0, 11],[1, 32, 42, 1, 11],[1, 32, 43, 2, 11],[1, 32, 44, 3, 11],
			        [1, 15, 46, 4, 11],[1, 15, 37, 5, 11],[1, 15, 36, 6, 11],[1, 15, 39, 7, 11],[1, 15, 38, 8, 11],[1, 15, 41, 9, 11],[1, 15, 40, 10, 11],[1, 15, 43, 11, 11],[1, 15, 42, 0, 11],[1, 15, 45, 1, 11],[1, 15, 44, 2, 11],[1, 15, 47, 3, 11],
			        [1, 31, 47, 4, 11],[1, 31, 36, 5, 11],[1, 31, 37, 6, 11],[1, 31, 38, 7, 11],[1, 31, 39, 8, 11],[1, 31, 40, 9, 11],[1, 31, 41, 10, 11],[1, 31, 42, 11, 11],[1, 31, 43, 0, 11],[1, 31, 44, 1, 11],[1, 31, 45, 2, 11],[1, 31, 46, 3, 11],
	                //Grupo 13 (Servicios: 50 y 51)
	                [1, 35, 50, 1, 13], [1, 35, 49, 0, 13],
	                [1, 55, 49, 1, 13], [1, 55, 50, 0, 13],
	                // Grupo 14 (Servicio 52)
	                [1, 19, 51, 0, 14],
			        [1,  5, 51, 1, 14],
			        [1, 33, 51, 2, 14],
			        [1, 34, 51, 3, 14],
	                // Grupo 16 (Servicio auxiliar 54)
	                [1, 23, 53, 0, 16],
	                // Grupo 17 (Servicio auxiliar 55)
	                [1, 60, 54, 0, 17],

	                // Sábados
	                // Grupo 1 (Servicios 1 y 2)
	                [2, 49, 63, 0, 1], [2, 49, 64, 1, 1],
	                [2, 40, 64, 0, 1], [2, 40, 63, 1, 1],
	                // Grupo 2 (Servicio 3)
	                [2, 65, 65, 0, 2],
	                // Grupo 3 (servicio 4)
	                [2, 28, 66, 0, 3],
	                // Grupo 4 (servicio 5-9)
	                [2, 46, 67, 4, 4], [2, 46, 68, 0, 4], [2, 46, 69, 1, 4], [2, 46, 70, 2, 4], [2, 46, 71, 3, 4],
	                [2, 52, 68, 4, 4], [2, 52, 69, 0, 4], [2, 52, 70, 1, 4], [2, 52, 71, 2, 4], [2, 52, 67, 3, 4],
			        [2, 41, 69, 4, 4], [2, 41, 70, 0, 4], [2, 41, 71, 1, 4], [2, 41, 67, 2, 4], [2, 41, 68, 3, 4],
			        [2, 39, 70, 4, 4], [2, 39, 71, 0, 4], [2, 39, 67, 1, 4], [2, 39, 68, 2, 4], [2, 39, 69, 3, 4],
	                // Grupo 5 (Servicios 10 y 11)
	                [2, 26, 72, 0, 5], [2, 26, 73, 1, 5],
	                // Grupo 8 (Servicios 22-23)
	                [2, 79, 84, 0, 8], [2, 79, 85, 1, 8],
	                [2, 55, 85, 0, 8], [2, 55, 84, 1, 8],
	                // Grupo 9 (Servicios 24-27)
	                [2, 76, 87, 2, 9], [2, 76, 86, 3, 9], [2, 76, 89, 0, 9], [2, 76, 88, 1, 9],
	                [2,  4, 88, 2, 9], [2,  4, 89, 3, 9], [2,  4, 86, 0, 9], [2,  4, 87, 1, 9],
	                [2, 37, 89, 2, 9], [2, 37, 88, 3, 9], [2, 37, 87, 0, 9], [2, 37, 86, 1, 9],
	                // Grupo 13 (Auxiliar servicio 35)
					[2, 23, 96, 0, 13],
	                // Grupo 14 (Auxiliar servicio 36)
	                [2, 60, 97, 0, 14],

	                // Domingos
	                // Grupo 1 (Servicios 1 y 2)
	                [3, 68, 102, 0, 1],[3, 68, 103, 1, 1],
	                [3, 62, 103, 0, 1],[3, 62, 102, 1, 1],
	                // Grupo 2 (Servicio 3)
	                [3, 65, 104, 0, 3],
	                // Grupo 4 (Servicios: 5 - 9 )
	                [3, 52, 106, 0, 4],[3, 52, 107, 1, 4],[3, 52, 108, 2, 4],[3, 52, 109, 3, 4],[3, 52, 110, 4, 4],
	                [3, 47, 107, 0, 4],[3, 47, 108, 1, 4],[3, 47, 109, 2, 4],[3, 47, 110, 3, 4],[3, 47, 106, 4, 4],
	                [3, 18, 108, 0, 4],[3, 18, 109, 1, 4],[3, 18, 110, 2, 4],[3, 18, 106, 3, 4],[3, 18, 107, 4, 4],
	                [3, 14, 109, 0, 4],[3, 14, 110, 1, 4],[3, 14, 106, 2, 4],[3, 14, 107, 3, 4],[3, 14, 108, 4, 4],
	                // Grupo 5 (Servicios 10 y 11)
	                [3, 17, 111, 0, 5], [3, 17, 112, 1, 5],
	                // Grupo 6 (Servicio 12)
	                [3, 23, 113, 0, 6],
	                [3, 60, 113, 0, 6],
	                // Grupo 9 (Servicios 22 y 23)
	                [3, 79, 123, 0, 9], [3, 79, 124, 1, 9],
	                [3, 55, 124, 0, 9], [3, 55, 123, 1, 9],
	                // Grupo 10 (Servicios 24-27)
					[3, 76, 127, 0, 10], [3, 76, 128, 1, 10], [3, 76, 125, 2, 10], [3, 76, 126, 3, 10],
        ];
        foreach ($orders as $order) {
            $serviceGroupOrder = new ServiceGroupOrder([ServiceGroupOrderContract::PERIOD_ID  => $order[0],
	                                                    ServiceGroupOrderContract::DRIVER_ID  => $order[1],
                                                        ServiceGroupOrderContract::SERVICE_ID => $order[2],
                                                        ServiceGroupOrderContract::NORMALIZED => $order[3],
                                                        ServiceGroupOrderContract::GROUP      => $order[4]]);
            $serviceGroupOrder->save();
        }
    }
}