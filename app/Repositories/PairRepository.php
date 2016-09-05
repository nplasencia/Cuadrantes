<?php

namespace Cuadrantes\Repositories;

use Cuadrantes\Commons\DriverContract;
use Cuadrantes\Commons\PairContract;
use Cuadrantes\Entities\Pair;

class PairRepository extends BaseRepository
{
    public function getEntity()
    {
        return new Pair();
    }

    public function getAll()
    {
        return $this->newQuery()->orderBy(PairContract::PAIR_ID)->with('driver')->get();
    }

    public function getAllPaginated($numberOfElements)
    {
        return $this->newQuery()->orderBy(PairContract::PAIR_ID)->with('driver')->paginate($numberOfElements);
    }
}