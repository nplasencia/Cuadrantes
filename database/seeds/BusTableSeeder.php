<?php

use Illuminate\Database\Seeder;
use Cuadrantes\Entities\Bus;

class BusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Bus::class, 46)->create();
    }
}
