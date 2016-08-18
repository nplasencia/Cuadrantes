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
            [1,'morning',1,1,0],[1,'afternoon',2,1,0],[1,'morning',3,1,0],[1,'afternoon',4,1,0],
	        [1,'morning',5,2,0],[1,'afternoon',6,2,0],
	        [1,'morning',7,3,0],[1,'afternoon',8,3,0],[1,'morning',9,3,0],[1,'afternoon',10,3,0],[1,'morning',11,3,0],[1,'afternoon',12,3,0],
	        [1,'morning',13,4,0],[1,'afternoon',14,4,0],[1,'morning',15,4,0],[1,'afternoon',16,4,0],[1,'morning',17,4,0],[1,'afternoon',18,4,0],[1,'morning',19,4,0],[1,'afternoon',20,4,0],
	        [1,'morning',21,4,0],
	        [1,'morning',23,5,0],[1,'afternoon',24,5,0],[1,'morning',25,5,0],
	        [1,'afternoon',26,6,0],
	        [1,'morning',27,7,0],[1,'afternoon',28,7,0],[1,'morning',29,7,0],[1,'afternoon',30,7,0],
	        [1,'morning',31,8,0],[1,'afternoon',32,8,0],
	        [1,'morning',33,9,0],[1,'afternoon',34,9,0],
	        [1,'morning',35,10,0],[1,'morning',36,10,0],
	        [1,'afternoon',37,11,0],[1,'afternoon',38,11,0],[1,'morning',39,11,0],[1,'afternoon',40,11,0],[1,'morning',41,11,0],[1,'afternoon',42,11,0],[1,'morning',43,11,0],[1,'afternoon',44,11,0],[1,'morning',45,11,0],[1,'afternoon',46,11,0],[1,'morning',47,11,0],[1,'afternoon',48,11,0],
	        [1,'morning',49,12,0],
	        [1,'afternoon',50,13,0],[1,'morning',51,13,0],
	        [1,'afternoon',52,null,0],[1,'morning',53,null,0],[1,'afternoon',54,null,0],[1,'afternoon',55,null,0],[1,'morning',56,null,1],[1,'morning',57,null,1],[1,'morning',58,null,1],[1,'morning',59,null,1],[1,'morning',60,null,1],[1,'morning',61,null,1],[1,'morning',62,null,1],[1,'afternoon',63,null,1],
	        //Sab
	        [2,'morning',1,1,0],[2,'afternoon',2,1,0],
	        [2,'morning',3,2,0],
	        [2,'afternoon',4,3,0],
	        [2,'morning',5,4,0],[2,'afternoon',6,4,0],[2,'morning',7,4,0],[2,'afternoon',8,4,0],[2,'morning',9,4,0],
	        [2,'morning',10,5,0],[2,'afternoon',11,5,0],
	        [2,'morning',12,6,0],[2,'afternoon',13,6,0],
	        [2,'morning',14,7,0],[2,'afternoon',15,7,0],[2,'morning',16,7,0],[2,'afternoon',17,7,0],[2,'morning',18,7,0],[2,'afternoon',19,7,0],[2,'morning',20,7,0],[2,'afternoon',21,7,0],
	        [2,'morning',22,8,0],[2,'afternoon',23,8,0],
	        [2,'morning',24,9,0],[2,'afternoon',25,9,0],[2,'morning',26,9,0],[2,'afternoon',27,9,0],
	        [2,'morning',28,10,0],[2,'afternoon',29,10,0],[2,'morning',30,10,0],[2,'afternoon',31,10,0],
	        [2,'morning',32,null,1],[2,'morning',33,null,1],[2,'morning',34,null,1],[2,'morning',35,null,1],[2,'morning',36,null,1],[2,'morning',37,null,1],[2,'morning',38,null,1],[2,'afternoon',39,null,1],
	        //Dom
	        [3,'morning',1,1,0],[3,'afternoon',2,1,0],
	        [3,'morning',3,2,0],
	        [3,'afternoon',4,3,0],
	        [3,'morning',5,4,0],[3,'morning',6,4,0],[3,'afternoon',7,4,0],[3,'morning',8,4,0],[3,'afternoon',9,4,0],
	        [3,'morning',10,5,0],[3,'afternoon',11,5,0],
	        [3,'morning',12,6,0],
	        [3,'afternoon',13,7,0],
	        [3,'afternoon',14,8,0],[3,'morning',15,8,0],[3,'afternoon',16,8,0],[3,'morning',17,8,0],[3,'afternoon',18,8,0],[3,'morning',19,8,0],[3,'afternoon',20,8,0],[3,'afternoon',21,8,0],
	        [3,'afternoon',22,9,0],[3,'morning',23,9,0],
	        [3,'afternoon',24,10,0],[3,'morning',25,10,0],[3,'afternoon',26,10,0],[3,'morning',27,10,0],
	        [3,'morning',28,11,0],[3,'morning',29,11,0],[3,'morning',30,11,0],
	        [3,'morning',31,12,0],[3,'morning',32,12,0],
	        [3,'morning',33,13,0],[3,'morning',34,13,0],
	        [3,'afternoon',35,14,0],[3,'morning',36,14,0],[3,'afternoon',37,14,0],[3,'morning',38,14,1],
	        [3,'morning',39,null,1],[3,'morning',40,null,1],[3,'morning',41,null,1],[3,'morning',42,null,1],[3,'morning',43,null,1],[3,'morning',44,null,1],[3,'afternoon',45,null,1],
	        // Nuevo servicio inlcuido a posteriori
	        [1,'afternoon', 22, 4, 0],
        ];

        foreach ($services as $serviceArray) {
            $service = new Service();
            $service->period_id = $serviceArray[0];
            $service->time      = $serviceArray[1];
            $service->number    = $serviceArray[2];
            $service->group     = $serviceArray[3];
            $service->aux       = $serviceArray[4];
            $service->save();
        }
    }
}
