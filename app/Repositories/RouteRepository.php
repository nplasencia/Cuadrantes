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
}