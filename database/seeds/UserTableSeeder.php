<?php

use Illuminate\Database\Seeder;
use Cuadrantes\Entities\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createAdmin();
    }

    private function createAdmin()
    {
        User::create([
            'name'     => 'Nauzet Plaencia',
            'email'    => 'nplasencia@auret.es',
            'password' =>  bcrypt('admin')
        ]);
    }
}
