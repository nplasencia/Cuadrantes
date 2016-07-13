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
                    [10, 1, 2], [10, 2, 3], [10, 3, 0], [10, 4, 1],
                    [24, 2, 2], [24, 1, 3], [24, 4, 0], [24, 3, 1],
                    [49, 3, 2], [49, 4, 3], [49, 1, 0], [49, 2, 1],
                    [40, 4, 2], [40, 3, 3], [40, 2, 0], [40, 1, 1],
                    // Grupo 2 (Servicios: 5 y 6)
                    [9, 5, 0], [9, 6, 1],
                    [16, 6, 0], [16, 5, 1],
        ];
        foreach ($orders as $order) {
            $serviceGroupOrder = new ServiceGroupOrder([ServiceGroupOrderContract::DRIVER_ID => $order[0], ServiceGroupOrderContract::SERVICE_ID => $order[1],
                                ServiceGroupOrderContract::NORMALIZED => $order[2]]);
            $serviceGroupOrder->save();
        }
    }
}
