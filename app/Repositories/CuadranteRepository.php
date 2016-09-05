<?php

namespace Cuadrantes\Repositories;

use Carbon\Carbon;
use Cuadrantes\Commons\CuadranteContract;
use Cuadrantes\Entities\Cuadrante;

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

    public function deleteAllAfterDate(Carbon $date)
	{
    	$this->newQuery()->withTrashed()->where(CuadranteContract::DATE, '>', $date)->forceDelete();
	}
}