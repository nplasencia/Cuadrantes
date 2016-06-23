<?php

namespace Cuadrantes\Repositories;

use Cuadrantes\Entities\Weekday;

class WeekdayRepository extends BaseRepository{
    
    public function getEntity()
    {
        return new Weekday();
    }

    public function getAll()
    {
        return $this->newQuery();
    }
}