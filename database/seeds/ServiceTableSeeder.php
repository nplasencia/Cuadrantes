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
            [1,'morning',1,1,0],[1,'afternoon',2,1,0],[1,'morning',3,1,0],[1,'afternoon',4,1,0],[1,'morning',5,2,0],[1,'afternoon',6,2,0],[1,'morning',7,3,0],[1,'afternoon',8,3,0],[1,'morning',9,3,0],[1,'afternoon',10,3,0],[1,'morning',11,3,0],[1,'afternoon',12,3,0],[1,'morning',13,4,0],[1,'afternoon',14,4,0],[1,'morning',15,4,0],[1,'afternoon',16,4,0],[1,'morning',17,4,0],[1,'afternoon',18,4,0],[1,'morning',19,4,0],[1,'afternoon',20,4,0],[1,'morning',21,5,0],[1,'morning',22,6,0],[1,'afternoon',23,6,0],[1,'morning',24,6,0],[1,'afternoon',25,7,0],[1,'morning',26,8,0],[1,'afternoon',27,8,0],[1,'morning',28,8,0],[1,'afternoon',29,8,0],[1,'morning',30,9,0],[1,'afternoon',31,9,0],[1,'morning',32,10,0],[1,'afternoon',33,10,0],[1,'morning',34,11,0],[1,'morning',35,11,0],[1,'afternoon',36,12,0],[1,'afternoon',37,12,0],[1,'morning',38,12,0],[1,'afternoon',39,12,0],[1,'morning',40,12,0],[1,'afternoon',41,12,0],[1,'morning',42,12,0],[1,'afternoon',43,12,0],[1,'morning',44,12,0],[1,'afternoon',47,12,0],[1,'morning',48,13,0],[1,'afternoon',49,14,0],[1,'morning',50,15,0],[1,'afternoon',51,null,0],[1,'morning',52,null,0],[1,'afternoon',53,null,0],[1,'afternoon',54,null,0],[1,'morning',55,16,1],[1,'morning',56,null,1],[1,'morning',57,null,1],[1,'morning',58,null,1],[1,'morning',59,null,1],[1,'morning',60,null,1],[1,'morning',61,null,1],[1,'afternoon',62,null,1],[2,'morning',1,null,0],[2,'afternoon',2,null,0],[2,'morning',3,null,0],[2,'afternoon',4,null,0],[2,'morning',5,null,0],[2,'afternoon',6,null,0],[2,'morning',7,null,0],[2,'afternoon',8,null,0],[2,'morning',9,null,0],[2,'morning',10,null,0],[2,'afternoon',11,null,0],[2,'morning',12,null,0],[2,'afternoon',13,null,0],[2,'morning',14,null,0],[2,'afternoon',15,null,0],[2,'morning',16,null,0],[2,'afternoon',17,null,0],[2,'morning',18,null,0],[2,'afternoon',19,null,0],[2,'morning',20,null,0],[2,'afternoon',21,null,0],[2,'morning',22,null,0],[2,'afternoon',23,null,0],[2,'morning',24,null,0],[2,'afternoon',25,null,0],[2,'morning',26,null,0],[2,'afternoon',27,null,0],[2,'morning',28,null,0],[2,'afternoon',29,null,0],[2,'morning',30,null,0],[2,'afternoon',31,null,0],[2,'morning',32,null,1],[2,'morning',33,null,1],[2,'morning',34,null,1],[2,'morning',35,null,1],[2,'morning',36,null,1],[2,'morning',37,null,1],[2,'morning',38,null,1],[2,'afternoon',39,null,1],[3,'morning',1,null,0],[3,'afternoon',2,null,0],[3,'morning',3,null,0],[3,'afternoon',4,null,0],[3,'morning',5,null,0],[3,'morning',6,null,0],[3,'afternoon',7,null,0],[3,'morning',8,null,0],[3,'afternoon',9,null,0],[3,'morning',10,null,0],[3,'afternoon',11,null,0],[3,'morning',12,null,0],[3,'afternoon',13,null,0],[3,'afternoon',14,null,0],[3,'morning',15,null,0],[3,'afternoon',16,null,0],[3,'morning',17,null,0],[3,'afternoon',18,null,0],[3,'morning',19,null,0],[3,'afternoon',20,null,0],[3,'afternoon',21,null,0],[3,'afternoon',22,null,0],[3,'morning',23,null,0],[3,'afternoon',24,null,0],[3,'morning',25,null,0],[3,'afternoon',26,null,0],[3,'morning',27,null,0],[3,'morning',28,null,0],[3,'morning',29,null,0],[3,'morning',30,null,0],[3,'morning',31,null,0],[3,'morning',32,null,0],[3,'morning',33,null,0],[3,'morning',34,null,0],[3,'afternoon',35,null,0],[3,'morning',36,null,0],[3,'afternoon',37,null,0],[3,'morning',38,null,1],[3,'morning',39,null,1],[3,'morning',40,null,1],[3,'morning',41,null,1],[3,'morning',42,null,1],[3,'morning',43,null,1],[3,'morning',44,null,1],[3,'afternoon',45,null,1]
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
