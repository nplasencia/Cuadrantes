<?php

namespace Cuadrantes\Repositories;

use Cuadrantes\Entities\DriverHoliday;

class DriverHolidayRepository extends BaseRepository{
    
    public function getEntity() {
        return new DriverHoliday();
    }
}