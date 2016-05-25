<?php

namespace Cuadrantes\Repositories;

use Cuadrantes\Entities\Timetable;

class TimetableRepository extends BaseRepository{
    
    public function getEntity()
    {
        return new Timetable();
    }
}