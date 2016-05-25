<?php

namespace Cuadrantes\Repositories;

use Cuadrantes\Commons\LineContract;
use Cuadrantes\Commons\TimetableContract;
use Cuadrantes\Entities\Line;

class LineRepository extends BaseRepository{
    
    public function getEntity()
    {
        return new Line();
    }

    public function getAllPaginated($numberOfElements)
    {
        return $this->newQuery()->where(LineContract::ACTIVE, true)
            ->orderBy(LineContract::NUMBER, 'ASC')
            ->paginate($numberOfElements);
    }

    public function searchPaginated($item, $numberOfElements)
    {
        return $this->newQuery()->where(LineContract::NAME, 'LIKE', '%'.$item.'%')
            ->orWhere(LineContract::NUMBER, 'LIKE', '%'.$item.'%')
            ->orderBy(LineContract::NUMBER, 'ASC')
            ->paginate($numberOfElements);
    }

    public function update($line, $number, $name)
    {
        $line->number = $number;
        $line->name   = $name;
        $line->active = true;
        $line->save();
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