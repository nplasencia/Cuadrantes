<?php

namespace Cuadrantes\Repositories;

use Cuadrantes\Commons\ServiceContract;
use Cuadrantes\Entities\ServiceTimetable;

class ServiceTimetableRepository extends BaseRepository{
    
    public function getEntity()
    {
        return new ServiceTimetable();
    }

    public function findByPeriod($period_id)
    {
        return $this->newQuery()->with('service')->where(ServiceContract::PERIOD_ID, $period_id)->orderBy(ServiceContract::NUMBER)->get();
    }
}