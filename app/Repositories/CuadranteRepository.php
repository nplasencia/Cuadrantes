<?php

namespace Cuadrantes\Repositories;

use Carbon\Carbon;
use Cuadrantes\Commons\CuadranteContract;
use Cuadrantes\Commons\Globals;
use Cuadrantes\Commons\ServiceContract;
use Cuadrantes\Commons\TimetableContract;
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

    	return $this->newQuery()->where(CuadranteContract::DATE, $date->format(Globals::CARBON_SQL_FORMAT))->get();
    }

    public function getByDateServiceId(Carbon $date, $serviceId)
    {
    	try {
		    return $this->newQuery()->where( CuadranteContract::DATE, $date->format( Globals::CARBON_SQL_FORMAT ) )->where( CuadranteContract::SERVICE_ID, $serviceId )->firstOrFail();
	    } catch (\Exception $e) {
    		dd($date, $serviceId);
	    }
    }

    public function deleteAllAfterDate(Carbon $date)
	{
    	$this->newQuery()->withTrashed()->where(CuadranteContract::DATE, '>', $date)->forceDelete();
	}

	public function getByServiceDateDriver(Carbon $date, Driver $driver)
	{
		return $this->newQuery()->where(CuadranteContract::DATE, $date->format(Globals::CARBON_SQL_FORMAT))->where(CuadranteContract::DRIVER_ID, $driver->id)->first();
	}
}