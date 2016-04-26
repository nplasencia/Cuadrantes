<?php

use Illuminate\Database\Seeder;
use Cuadrantes\Entities\DriverRestDay;

class DriverRestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $drivers = DB::table('drivers')->get();
        foreach ($drivers as $driver) {
            factory(DriverRestDay::class)->create([
                'driver_id' => $driver->id,
                'active'    => 1
            ]);

            factory(DriverRestDay::class)->create([
                'driver_id' => $driver->id,
                'active'    => 1
            ]);
        }
    }
}
