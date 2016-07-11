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
        $services = [[1,'morning',1,0],[1,'afternoon',2,0],[1,'morning',3,0],[1,'afternoon',4,0],[1,'morning',5,0],[1,'afternoon',6,0],[1,'morning',7,0],[1,'afternoon',8,0],[1,'morning',9,0],[1,'afternoon',10,0],[1,'morning',11,0],[1,'afternoon',12,0],[1,'morning',13,0],[1,'afternoon',14,0],[1,'morning',15,0],[1,'afternoon',16,0],[1,'morning',17,0],
                     [1,'afternoon',18,0],[1,'morning',19,0],[1,'afternoon',20,0],[1,'morning',21,0],[1,'morning',22,0],[1,'afternoon',23,0],[1,'morning',24,0],[1,'afternoon',25,0],[1,'morning',26,0],[1,'afternoon',27,0],[1,'morning',28,0],[1,'afternoon',29,0],[1,'morning',30,0],[1,'afternoon',31,0],[1,'morning',32,0],[1,'afternoon',33,0],
                     [1,'morning',34,0],[1,'morning',35,0],[1,'afternoon',36,0],[1,'afternoon',37,0],[1,'morning',38,0],[1,'afternoon',39,0],[1,'morning',40,0],[1,'afternoon',41,0],[1,'morning',42,0],[1,'afternoon',43,0],[1,'morning',44,0],[1,'afternoon',47,0],[1,'morning',48,0],[1,'afternoon',49,0],[1,'morning',50,0],[1,'afternoon',51,0],
                     [1,'morning',52,0],[1,'afternoon',53,0],[1,'afternoon',54,0],[1,'morning',55,1],[1,'morning',56,1],[1,'morning',57,1],[1,'morning',58,1],[1,'morning',59,1],[1,'morning',60,1],[1,'morning',61,1],[1,'afternoon',62,1],[2,'morning',1,0],[2,'afternoon',2,0],[2,'morning',3,0],[2,'afternoon',4,0],[2,'morning',5,0],
                     [2,'afternoon',6,0],[2,'morning',7,0],[2,'afternoon',8,0],[2,'morning',9,0],[2,'morning',10,0],[2,'afternoon',11,0],[2,'morning',12,0],[2,'afternoon',13,0],[2,'morning',14,0],[2,'afternoon',15,0],[2,'morning',16,0],[2,'afternoon',17,0],[2,'morning',18,0],[2,'afternoon',19,0],[2,'morning',20,0],[2,'afternoon',21,0],
                     [2,'morning',22,0],[2,'afternoon',23,0],[2,'morning',24,0],[2,'afternoon',25,0],[2,'morning',26,0],[2,'afternoon',27,0],[2,'morning',28,0],[2,'afternoon',29,0],[2,'morning',30,0],[2,'afternoon',31,0],[2,'morning',32,1],[2,'morning',33,1],[2,'morning',34,1],[2,'morning',35,1],[2,'morning',36,1],[2,'morning',37,1],
                     [2,'morning',38,1],[2,'afternoon',39,1],[3,'morning',1,0],[3,'afternoon',2,0],[3,'morning',3,0],[3,'afternoon',4,0],[3,'morning',5,0],[3,'morning',6,0],[3,'afternoon',7,0],[3,'morning',8,0],[3,'afternoon',9,0],[3,'morning',10,0],[3,'afternoon',11,0],[3,'morning',12,0],[3,'afternoon',13,0],[3,'afternoon',14,0],
                     [3,'morning',15,0],[3,'afternoon',16,0],[3,'morning',17,0],[3,'afternoon',18,0],[3,'morning',19,0],[3,'afternoon',20,0],[3,'afternoon',21,0],[3,'afternoon',22,0],[3,'morning',23,0],[3,'afternoon',24,0],[3,'morning',25,0],[3,'afternoon',26,0],[3,'morning',27,0],[3,'morning',28,0],[3,'morning',29,0],[3,'morning',30,0],
                     [3,'morning',31,0],[3,'morning',32,0],[3,'morning',33,0],[3,'morning',34,0],[3,'afternoon',35,0],[3,'morning',36,0],[3,'afternoon',37,0],[3,'morning',38,1],[3,'morning',39,1],[3,'morning',40,1],[3,'morning',41,1],[3,'morning',42,1],[3,'morning',43,1],[3,'morning',44,1],[3,'afternoon',45,1],
                    ];

        foreach ($services as $serviceArray) {
            $service = new Service();
            $service->period_id = $serviceArray[0];
            $service->time      = $serviceArray[1];
            $service->number    = $serviceArray[2];
            $service->aux       = $serviceArray[3];
            $service->save();
        }
    }
}
