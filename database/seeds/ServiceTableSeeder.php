<?php

use Illuminate\Database\Seeder;
use Cuadrantes\Entities\Service;

class ServiceTableSeeder extends Seeder
{

	/**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $services = [
            [1,'morning',1,1,0,null],[1,'afternoon',2,1,0,null],[1,'morning',3,1,0,null],[1,'afternoon',4,1,0,null],
	        [1,'morning',5,2,0,null],[1,'afternoon',6,2,0,null],
	        [1,'morning',7,3,0,null],[1,'afternoon',8,3,0,null],[1,'morning',9,3,0,null],[1,'afternoon',10,3,0,null],[1,'morning',11,3,0,null],[1,'afternoon',12,3,0,null],
	        [1,'morning',13,4,0,null],[1,'afternoon',14,4,0,null],[1,'morning',15,4,0,null],[1,'afternoon',16,4,0,null],[1,'morning',17,4,0,null],[1,'afternoon',18,4,0,null],[1,'morning',19,4,0,null],[1,'afternoon',20,4,0,null],
	        [1,'morning',21,4,0,null],
	        [1,'morning',23,5,0,null],[1,'afternoon',24,5,0,null],[1,'morning',25,5,0,null],
	        [1,'afternoon',26,6,0,null],
	        [1,'morning',27,7,0,null],[1,'afternoon',28,7,0,null],[1,'morning',29,7,0,null],[1,'afternoon',30,7,0,null],
	        [1,'morning',31,8,0,null],[1,'afternoon',32,8,0,null],
	        [1,'morning',33,9,0,null],[1,'afternoon',34,9,0,null],
	        [1,'morning',35,10,0,null],[1,'morning',36,10,0,null],
	        [1,'afternoon',37,11,0,null],[1,'afternoon',38,11,0,null],[1,'morning',39,11,0,null],[1,'afternoon',40,11,0,null],[1,'morning',41,11,0,null],[1,'afternoon',42,11,0,null],[1,'morning',43,11,0,null],[1,'afternoon',44,11,0,null],[1,'morning',45,11,0,null],[1,'afternoon',46,11,0,null],[1,'morning',47,11,0,null],[1,'afternoon',48,11,0,null],
	        [1,'morning',49,12,0,1],
	        [1,'afternoon',50,13,0,null],[1,'morning',51,13,0,null],
			// Caso especial
	        [1,'afternoon',52,14,0,null],
	        [1,'morning',53,15,1,null],[1,'morning',54,16,1,null],[1,'morning',55,17,0,null],[1,'morning',56,18,1,null],[1,'morning',57,19,1,null],[1,'afternoon',58,20,1,null],[1,'afternoon',59,21,1,null],[1,'morning',60,null,1,null],[1,'morning',61,null,1,null],[1,'morning',62,null,1,null],[1,'afternoon',63,null,1,null],
	        //Sab
	        [2,'morning',1,1,0,null],[2,'afternoon',2,1,0,null],
	        [2,'morning',3,2,0,null],
	        [2,'afternoon',4,3,0,null],
	        [2,'morning',5,4,0,null],[2,'afternoon',6,4,0,null],[2,'morning',7,4,0,null],[2,'afternoon',8,4,0,null],[2,'morning',9,4,0,null],
	        [2,'morning',10,5,0,null],[2,'afternoon',11,5,0,null],
	        [2,'morning',12,6,0,null],[2,'afternoon',13,6,0,null],
	        [2,'morning',14,7,0,null],[2,'afternoon',15,7,0,null],[2,'morning',16,7,0,null],[2,'afternoon',17,7,0,null],[2,'morning',18,7,0,null],[2,'afternoon',19,7,0,null],[2,'morning',20,7,0,null],[2,'afternoon',21,7,0,null],
	        [2,'morning',22,8,0,null],[2,'afternoon',23,8,0,null],
	        [2,'morning',24,9,0,null],[2,'afternoon',25,9,0,null],[2,'morning',26,9,0,null],[2,'afternoon',27,9,0,null],
	        [2,'morning',28,10,0,null],[2,'afternoon',29,10,0,null],[2,'morning',30,10,0,null],[2,'afternoon',31,10,0,null],
	        [2,'morning',33,11,1,null],[2,'morning',34,12,1,null],[2,'morning',35,13,1,null],[2,'morning',36,14,1,null],[2,'morning',37,15,1,null],[2,'morning',38,16,1,null],[2,'morning',39,17,1,null],[2,'afternoon',40,18,1,null],
	        //Dom
	        [3,'morning',1,1,0,null],[3,'afternoon',2,1,0,null],
	        [3,'morning',3,2,0,null],
	        [3,'afternoon',4,3,0,null],
	        [3,'morning',5,4,0,null],[3,'morning',6,4,0,null],[3,'afternoon',7,4,0,null],[3,'morning',8,4,0,null],[3,'afternoon',9,4,0,null],
	        [3,'morning',10,5,0,null],[3,'afternoon',11,5,0,null],
	        [3,'morning',12,6,0,null],
	        [3,'afternoon',13,7,0,null],
	        [3,'afternoon',14,8,0,null],[3,'morning',15,8,0,null],[3,'afternoon',16,8,0,null],[3,'morning',17,8,0,null],[3,'afternoon',18,8,0,null],[3,'morning',19,8,0,null],[3,'afternoon',20,8,0,null],[3,'afternoon',21,8,0,null],
	        [3,'afternoon',22,9,0,null],[3,'morning',23,9,0,null],
	        [3,'afternoon',24,10,0,null],[3,'morning',25,10,0,null],[3,'afternoon',26,10,0,null],[3,'morning',27,10,0,null],
	        [3,'morning',28,11,0,null],[3,'morning',29,11,0,null],[3,'morning',30,11,0,null],
	        [3,'morning',31,12,0,null],[3,'morning',32,12,0,null],
	        [3,'morning',33,11,0,null],[3,'morning',34,11,0,null],
	        [3,'afternoon',35,13,0,null],[3,'morning',36,13,0,null],[3,'afternoon',37,13,0,null],[3,'morning',38,13,1,null],
	        [3,'morning',39,null,1,null],[3,'morning',40,null,1,null],[3,'morning',41,null,1,null],[3,'morning',42,null,1,null],[3,'morning',43,null,1,null],[3,'morning',44,null,1,null],[3,'afternoon',45,null,1,null],
	        // Nuevo servicio inlcuido a posteriori laborables
	        [1,'afternoon', 22, 4, 0,null],
	        // Nuevo servicio inlcuido a posteriori sábados
	        [2, 'afternoon', 32, 10, 0, null],

        ];

        foreach ($services as $serviceArray) {
            $service = new Service();
            $service->period_id      = $serviceArray[0];
            $service->time           = $serviceArray[1];
            $service->number         = $serviceArray[2];
            $service->group          = $serviceArray[3];
            $service->aux            = $serviceArray[4];
	        $service->excluded_period_id = $serviceArray[5];
            $service->save();
	        if ($serviceArray[2] == 61 || $serviceArray[2] == 62 || $serviceArray[2] == 63) {
		        $service->delete();
	        }
        }
    }
}
