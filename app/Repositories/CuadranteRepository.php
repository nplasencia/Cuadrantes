<?php

namespace Cuadrantes\Repositories;

use Carbon\Carbon;
use Cuadrantes\Commons\CuadranteContract;
use Cuadrantes\Entities\Cuadrante;
use Cuadrantes\Entities\Driver;

class CuadranteRepository extends BaseRepository{
    
    public function getEntity()
    {
        return new Cuadrante();
    }

    public function getAllByDate(Carbon $date = null)
    {
    	if (!isset($date)) {
    		$date = new Carbon();
	    }

    	return $this->newQuery()->where(CuadranteContract::DATE, $date->format('Y-m-d'))->get();
    }

    public function getByDateServiceId(Carbon $date, $serviceId)
    {
	    return $this->newQuery()->where(CuadranteContract::DATE, $date->format('Y-m-d'))->where(CuadranteContract::SERVICE_ID, $serviceId)->firstOrFail();
    }

    public function deleteAllAfterDate(Carbon $date)
	{
    	$this->newQuery()->withTrashed()->where(CuadranteContract::DATE, '>', $date)->forceDelete();
	}

	public function getByServiceDateDriver(Carbon $date, Driver $driver)
	{
		return $this->newQuery()->where(CuadranteContract::DATE, $date->format('Y-m-d'))->where(CuadranteContract::DRIVER_ID, $driver->id)->first();
	}
}