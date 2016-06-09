<?php

namespace Cuadrantes\Repositories;

use Cuadrantes\Commons\ServiceContract;
use Cuadrantes\Entities\Service;

class ServiceRepository extends BaseRepository{
    
    public function getEntity()
    {
        return new Service();
    }

    public function findByPeriod($period_id)
    {
        return $this->newQuery()->where(ServiceContract::PERIOD_ID, $period_id)->orderBy(ServiceContract::NUMBER)->get();
    }
}