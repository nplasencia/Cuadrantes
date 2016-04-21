<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call(UserTableSeeder::class);
        $this->call(DriverTableSeeder::class);
        $this->call(WeekdayTableSeeder::class);
        $this->call(DriverRestTableSeeder::class);
        $this->call(DriverHolidayTableSeeder::class);
        $this->call(BusBrandTableSeeder::class);
        $this->call(BusTableSeeder::class);
        Model::reguard();
    }
}
