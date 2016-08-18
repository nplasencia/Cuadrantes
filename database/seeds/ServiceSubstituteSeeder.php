<?php

use Cuadrantes\Commons\ServiceSubstituteContract;
use Cuadrantes\Entities\ServiceSubstitute;

use Illuminate\Database\Seeder;

class ServiceSubstituteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $substitutes = [
                         // Grupo 1 (Servicios: 1, 2, 3 y 4)
                         [1, 1, 68], [1, 1, 62],
                         // Grupo 2 (Servicios 5 y 6)
                         [1, 2, 65],
                         // Grupo 3 (Servicios 7 - 12)
                         [1, 3, 26],
	                     // Grupo 4-13 (Servicios 13 - 48)
	                     // Cualquiera puede ser sustituto
	                     // Grupo 14 (Servicios 49 y 50)
	                     [1, 14, 79],
                      ];
        foreach ($substitutes as $substitute) {
            $serviceSubstitute = new ServiceSubstitute([ServiceSubstituteContract::PERIOD_ID => $substitute[0],
                                                        ServiceSubstituteContract::SERVICE_GROUP => $substitute[1],
                                                        ServiceSubstituteContract::DRIVER_ID => $substitute[2]]);
            $serviceSubstitute->save();
        }
    }
}
