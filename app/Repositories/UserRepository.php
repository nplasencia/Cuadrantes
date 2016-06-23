<?php

namespace Cuadrantes\Repositories;

use Illuminate\Contracts\Auth\Guard;

use Cuadrantes\Entities\User;

class UserRepository extends BaseRepository
{
    
    public function getEntity()
    {
        return new User();
    }

    public function update(Guard $auth, $name, $surname, $telephone, $email)
    {
        $user = $auth->user();
        $user->name      = $name;
        $user->surname   = $surname;
        $user->telephone = $telephone;
        $user->email     = $email;
        $user->update();
        return $user;
    }
}