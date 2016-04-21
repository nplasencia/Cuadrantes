<?php

use Illuminate\Database\Seeder;

class BusBrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bus_brands')->insert([
            'name'  => 'Irisbus'
        ]);
        DB::table('bus_brands')->insert([
            'name'  => 'Irizar'
        ]);
        DB::table('bus_brands')->insert([
            'name'  => 'Iveco'
        ]);
        DB::table('bus_brands')->insert([
            'name'  => 'Mercedes'
        ]);
        DB::table('bus_brands')->insert([
            'name'  => 'Scania'
        ]);
    }
}
