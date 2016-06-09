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
                     [1,'morning',22,0,11],[1,'afternoon',23,0,12],[1,'morning',24,0,12],[1,'afternoon',25,0,13],
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
