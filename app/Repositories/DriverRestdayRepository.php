<?php

namespace Cuadrantes\Repositories;

use Cuadrantes\Entities\DriverRestDay;

class DriverRestdayRepository extends BaseRepository{
    
    public function getEntity()
    {
        return new DriverRestDay();
    }
}