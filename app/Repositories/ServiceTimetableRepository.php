<?php

namespace Cuadrantes\Repositories;

use Cuadrantes\Commons\ServiceContract;
use Cuadrantes\Entities\ServiceTimetable;

class ServiceTimetableRepository extends BaseRepository{
    
    public function getEntity()
    {
        return new ServiceTimetable();
    }
}