<?php

namespace Cuadrantes\Entities;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Cuadrantes\Commons\UserContract;
use Illuminate\Support\Facades\Storage;

class User extends Entity implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = UserContract::TABLE_NAME;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [UserContract::NAME, UserContract::SURNAME, UserContract::EMAIL, UserContract::ROLE, UserContract::PASSWORD,];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [UserContract::PASSWORD, 'remember_token'];

    public function getCompleteName() {
        return "{$this->name} {$this->surname}";
    }

    public function hasProfileImage() {
        if (Storage::disk('public')->exists('avatar'.'/'.$this->id.'.jpg')) {
            return true;
        } else {
            return false;
        }
    }
}
