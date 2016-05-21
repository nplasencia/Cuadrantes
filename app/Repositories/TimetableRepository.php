<?php

namespace Cuadrantes\Repositories;

use Cuadrantes\Commons\TimetableContract;
use Cuadrantes\Entities\Timetable;

class TimetableRepository extends BaseRepository{
    
    public function getEntity()
    {
        return new Timetable();
    }

    public function getAllByLine($line_id)
    {
        return $this->newQuery()->where(TimetableContract::LINE_ID, $line_id)
            ->orderBy(TimetableContract::TIME, 'ASC');
    }
}