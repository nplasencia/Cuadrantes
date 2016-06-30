<?php

namespace Cuadrantes\Repositories;

use Cuadrantes\Commons\LineContract;
use Cuadrantes\Commons\TimetableContract;
use Cuadrantes\Entities\Line;

class LineRepository extends BaseRepository
{
    
    public function getEntity()
    {
        return new Line();
    }

    public function getAll()
    {
        return $this->newQuery()->orderBy(LineContract::NUMBER, 'ASC')->get();
    }

    public function getAllPaginated($numberOfElements)
    {
        return $this->newQuery()->orderBy(LineContract::NUMBER, 'ASC')->paginate($numberOfElements);
    }

    public function update($line, $number, $name)
    {
        $line->number = $number;
        $line->name   = $name;
        $line->update();
        return $line;
    }

    public function updateById($id, $number, $name)
    {
        $line = $this->findOrFail($id);
        return $this->update($line, $number, $name);
    }

    public function getTimetables($id)
    {
        return $this->findOrFail($id)->timetables()->orderBy(TimetableContract::PERIOD_ID)->orderBy(TimetableContract::TIME)->with('route')->with('period')->get();
    }
}