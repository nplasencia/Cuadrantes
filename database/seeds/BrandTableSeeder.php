<?php

use Illuminate\Database\Seeder;

use Cuadrantes\Entities\Brand;
use Cuadrantes\Commons\BrandContract;

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
            $brand = new Brand([BrandContract::NAME => $name]);
            $brand->save();
        }
    }
}