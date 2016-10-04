<?php

namespace Cuadrantes\Repositories;


use Cuadrantes\Commons\UserContract;
use Cuadrantes\Entities\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository
{
    
    public function getEntity()
    {
        return new User();
    }

    public function store(array $data, $password)
    {
	    $user = new User($data);
	    $user->password       = Hash::make($password);
	    $user->remember_token = str_random(10);
	    $user->save();

	    return $user;
    }

    public function update($id, array $data)
    {
        $user = $this->findOrFail($id);
        $user->update($data);

        return $user;
    }

    private function sqlForAll($withoutActualUser)
    {
	    $user = Auth::user();
	    $query = $this->newQuery();
	    if ($withoutActualUser) {
		    $query = $query->where(UserContract::ID, '<>', $user->id);
	    }

	    return $query->orderBy(UserContract::NAME)->orderBy(UserContract::SURNAME);
    }

    public function getAll($withoutActualUser = true)
    {
    	return $this->sqlForAll($withoutActualUser)->get();
    }

	public function getAllPaginated($pagination, $withoutActualUser = true)
	{
		return $this->sqlForAll($withoutActualUser)->paginate($pagination);
	}
}