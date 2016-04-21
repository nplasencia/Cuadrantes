<?php

use Illuminate\Database\Seeder;
use Cuadrantes\Entities\DriverHolidays;

class DriverHolidayTableSeeder extends Seeder
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
            factory(DriverHolidays::class)->create([
                'driver_id' => $driver->id,
                'date_from' => '2016-05-01',
                'date_to'   => '2016-05-15',
                'active'    => 1
            ]);

            factory(DriverHolidays::class)->create([
                'driver_id' => $driver->id,
                'date_from' => '2016-09-15',
                'date_to'   => '2016-09-30',
                'active'    => 1
            ]);
        }
    }
}
