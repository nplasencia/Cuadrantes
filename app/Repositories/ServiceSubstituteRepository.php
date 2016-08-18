<?php

namespace Cuadrantes\Repositories;

use Cuadrantes\Commons\ServiceSubstituteContract;
use Cuadrantes\Entities\ServiceSubstitute;

class ServiceSubstituteRepository extends BaseRepository
{
    
    public function getEntity()
    {
        return new ServiceSubstitute();
    }

    public function getAll()
    {
        return $this->newQuery()->orderBy(ServiceSubstituteContract::PERIOD_ID)->with('driver')->get();
    }

}