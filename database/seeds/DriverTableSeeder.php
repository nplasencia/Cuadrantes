<?php

use Illuminate\Database\Seeder;
use Cuadrantes\Entities\Driver;

class DriverTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Driver::class, 100)->create();
    }
}