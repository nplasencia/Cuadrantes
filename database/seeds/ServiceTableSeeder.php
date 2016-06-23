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
        $services = [[1,'morning',1,0,1],[1,'afternoon',2,0,1],[1,'morning',3,0,2],[1,'afternoon',4,0,2],[1,'morning',5,0,3],[1,'afternoon',6,0,3],[1,'morning',7,0,4],
                     [1,'afternoon',8,0,4],[1,'morning',9,0,5],[1,'afternoon',10,0,5],[1,'morning',11,0,6],[1,'afternoon',12,0,6],[1,'morning',13,0,7],[1,'afternoon',14,0,7],
                     [1,'morning',15,0,8],[1,'afternoon',16,0,8],[1,'morning',17,0,9],[1,'afternoon',18,0,9],[1,'morning',19,0,10],[1,'afternoon',20,0,10],[1,'morning',21,0,11],
                     [1,'morning',22,0,11],[1,'afternoon',23,0,12],[1,'morning',24,0,12],[1,'afternoon',25,0,13], [1,'morning',26,0,14],[1,'afternoon',27,0,14],[1,'morning',28,0,15],
                     [1,'afternoon',29,0,15],[1,'morning',30,0,16],[1,'afternoon',31,0,16],[1,'morning',32,0,17],[1,'afternoon',33,0,17],[1,'morning',34,0,18],[1,'morning',35,0,19],
                     [1,'afternoon',36,0,18],[1,'afternoon',37,0,19],[1,'morning',38,0,20],[1,'afternoon',39,0,20],[1,'morning',40,0,21],[1,'afternoon',41,0,21],[1,'morning',42,0,22],
                     [1,'afternoon',43,0,22],[1,'morning',44,0,23],[1,'afternoon',47,0,23],[1,'morning',48,0,24],[1,'afternoon',49,0,24],[1,'morning',50,0,25],[1,'afternoon',51,0,25],
                     [1,'morning',52,0,26],[1,'afternoon',53,0,26],[1,'afternoon',54,0,26],[1,'morning',55,1,0],[1,'morning',56,1,0],[1,'morning',57,1,0],[1,'morning',58,1,0],
                     [1,'morning',59,1,0],[1,'morning',60,1,0],[1,'morning',61,1,0],[1,'afternoon',62,1,0],
                    ];

        foreach ($services as $serviceArray) {
            $service = new Service();
            $service->period_id = $serviceArray[0];
            $service->time      = $serviceArray[1];
            $service->number    = $serviceArray[2];
            $service->aux       = $serviceArray[3];
            $service->group     = $serviceArray[4];
            $service->save();
        }
    }
}
