<?php

namespace Cuadrantes\Repositories;

use Cuadrantes\Commons\ServiceTimetablesContract;
use Cuadrantes\Entities\ServiceTimetable;

class ServiceTimetableRepository extends BaseRepository
{
    
    public function getEntity()
    {
        return new ServiceTimetable();
    }

    public function deleteByServiceId($serviceId)
    {
        $this->newQuery()->where(ServiceTimetablesContract::SERVICE_ID,$serviceId)->delete();
    }

    public function deleteByTimetableId($timetableId)
    {
        $this->newQuery()->where(ServiceTimetablesContract::TIMETABLE_ID, $timetableId)->delete();
    }
}