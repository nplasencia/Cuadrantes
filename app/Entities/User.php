<?php

namespace Cuadrantes\Entities;

use Cuadrantes\Commons\Roles;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

use Cuadrantes\Commons\UserContract;
use Cuadrantes\Notifications\ResetPassword as ResetPasswordNotification;


class User extends Entity implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, Notifiable;

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
    protected $fillable = [UserContract::NAME, UserContract::SURNAME, UserContract::EMAIL, UserContract::ROLE, UserContract::TELEPHONE];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [UserContract::PASSWORD, 'remember_token'];

	public function isAdmin()
	{
		if ($this->role == Roles::ADMIN) {
			return true;
		}
		return false;
	}

    public function getCompleteNameAttribute()
    {
        return "{$this->name} {$this->surname}";
    }

    public function hasProfileImage()
    {
        if (Storage::disk('public')->exists('avatar'.'/'.$this->id.'.jpg')) {
            return true;
        } else {
            return false;
        }
    }

	/**
	 * Send the password reset notification.
	 *
	 * @param  string  $token
	 * @return void
	 */
	public function sendPasswordResetNotification($token)
	{
		$this->notify(new ResetPasswordNotification($token));
	}
}
