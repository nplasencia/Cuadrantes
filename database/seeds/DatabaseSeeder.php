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

        $this->call(UserTableSeeder::class);
        $this->call(DriverTableSeeder::class);
        $this->call(PeriodTableSeeder::class);
        $this->call(WeekdayTableSeeder::class);
        $this->call(DriverRestTableSeeder::class);
        $this->call(DriverHolidayTableSeeder::class);
        $this->call(BrandTableSeeder::class);
        $this->call(BusTableSeeder::class);
        $this->call(LineTableSeeder::class);
        $this->call(RouteTableSeeder::class);
        $this->call(TimetableTableSeeder::class);
        $this->call(ServiceTableSeeder::class);
        $this->call(ServiceTimetableSeeder::class);
        $this->call(PairTableSeeder::class);
        $this->call(ServiceConditionSeeder::class);
        $this->call(ServiceGroupOrderSeeder::class);

        Model::reguard();
    }
}