<?php

namespace Cuadrantes\Repositories;

use Carbon\Carbon;
use Cuadrantes\Commons\DriverContract;
use Cuadrantes\Entities\Driver;
use Illuminate\Http\Request;

class DriverRepository extends BaseRepository
{
    
    public function getEntity()
    {
        return new Driver();
    }

    public function getAll()
    {
        return $this->newQuery()->orderBy(DriverContract::LAST_NAME, 'ASC')->orderBy(DriverContract::FIRST_NAME, 'ASC')->with('restDays', 'holidays')->get();
    }

    public function getAllPaginated($numberOfElements)
    {
        return $this->newQuery()->orderBy(DriverContract::LAST_NAME, 'ASC')->orderBy(DriverContract::FIRST_NAME, 'ASC')->with('restDays', 'holidays')->paginate($numberOfElements);
    }

    public function store(Request $request)
    {
        $driver = new Driver($request->all());
        $driver->cap               = Carbon::createFromFormat('d/m/Y', $driver->cap)->format('Y-m-d');
        $driver->driver_expiration = Carbon::createFromFormat('d/m/Y', $driver->driver_expiration)->format('Y-m-d');
        $driver->save();
        return $driver;
    }
}