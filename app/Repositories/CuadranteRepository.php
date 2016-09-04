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

    public function deleteAllAfterDate(Carbon $date)
	{
    	$this->newQuery()->withTrashed()->where(CuadranteContract::DATE, '>', $date)->forceDelete();
	}
}