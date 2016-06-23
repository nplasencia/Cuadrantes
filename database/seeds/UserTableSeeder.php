<?php

use Illuminate\Database\Seeder;

use Cuadrantes\Entities\User;
use Cuadrantes\Commons\UserContract;

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
        factory(User::class)->create([
            UserContract::NAME     => 'Nauzet',
            UserContract::SURNAME  => 'Plasencia Cruz',
            UserContract::EMAIL    => 'nplasencia@auret.es',
            UserContract::ROLE     => 'Admin',
            UserContract::PASSWORD =>  bcrypt('admin')
        ]);

        factory(User::class)->create([
            UserContract::NAME     => 'Patricia',
            UserContract::SURNAME  => 'Botella',
            UserContract::EMAIL    => 'patriciabotella@arrecifebus.com',
            UserContract::ROLE     => 'Admin',
            UserContract::PASSWORD =>  bcrypt('admin')
        ]);
    }
}