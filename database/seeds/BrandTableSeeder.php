<?php

use Cuadrantes\Entities\Brand;
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
        $brandNames = ['Irisbus', 'Irizar', 'Iveco', 'Mercedes', 'Scania'];
        
        foreach ($brandNames as $name) {
            $brand = new Brand();
            $brand->name = $name;
            $brand->timestamps = false;
            $brand->save();
        }
    }
}