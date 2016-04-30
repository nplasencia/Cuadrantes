<?php

use Illuminate\Database\Seeder;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands')->insert([
            'name'  => 'Irisbus'
        ]);
        DB::table('brands')->insert([
            'name'  => 'Irizar'
        ]);
        DB::table('brands')->insert([
            'name'  => 'Iveco'
        ]);
        DB::table('brands')->insert([
            'name'  => 'Mercedes'
        ]);
        DB::table('brands')->insert([
            'name'  => 'Scania'
        ]);
    }
}
