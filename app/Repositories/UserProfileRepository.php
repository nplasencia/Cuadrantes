<?php

namespace Cuadrantes\Repositories;

use Cuadrantes\Commons\UserContract;
use Cuadrantes\Entities\User;
use Illuminate\Contracts\Auth\Guard;

class UserProfileRepository extends BaseRepository
{
    
    public function getEntity()
    {
        return new User();
    }

    public function update(Guard $auth, $name, $surname, $telephone, $email)
    {
        $user = $auth->user();
	    $user->update([UserContract::NAME => $name, UserContract::SURNAME => $surname, UserContract::TELEPHONE => $telephone, UserContract::EMAIL => $email]);
        return $user;
    }
}