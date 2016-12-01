<?php

namespace Cuadrantes\Repositories;

use Cuadrantes\Entities\Timetable;
use Cuadrantes\Commons\TimetableContract;

class TimetableRepository extends BaseRepository
{
    
    public function getEntity()
    {
        return new Timetable();
    }

    public function getByRouteNoService($route_id, $period_id)
    {
        $query = "SELECT * FROM cuadrantes.timetables   
                    WHERE route_id=$route_id AND period_id=$period_id AND id NOT IN (SELECT timetable_id FROM service_timetables WHERE deleted_at is null) 
                    ORDER BY time";
        return $this->getEntity()->hydrateRaw($query);
    }
}
