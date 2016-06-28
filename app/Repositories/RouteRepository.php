<?php

namespace Cuadrantes\Repositories;

use Cuadrantes\Commons\RouteContract;
use Cuadrantes\Entities\Route;

class RouteRepository extends BaseRepository{
    
    public function getEntity()
    {
        return new Route();
    }

    public function findByLineId($line_id)
    {
        return $this->newQuery()->where(RouteContract::LINE_ID, $line_id)->orderBy(RouteContract::GO);
    }
    
    public function getByPeriodNoService($period_id)
    {
        $query = "SELECT ro.* FROM cuadrantes.timetables tim 
                    LEFT JOIN cuadrantes.routes ro ON tim.route_id=ro.id 
                    LEFT JOIN cuadrantes.lines li ON ro.line_id = li.id 
                    WHERE tim.period_id=$period_id AND tim.id NOT IN (SELECT timetable_id FROM cuadrantes.service_timetables) 
                    GROUP BY ro.id ORDER BY li.number ";
        return $this->getEntity()->hydrateRaw($query);
    }
}