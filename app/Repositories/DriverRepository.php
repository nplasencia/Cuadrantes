<?php

namespace Cuadrantes\Repositories;

use Cuadrantes\Commons\DriverContract;
use Cuadrantes\Entities\Driver;

class DriverRepository extends BaseRepository{
    
    public function getEntity() {
        return new Driver();
    }

    public function getAll()
    {
        return $this->newQuery()->orderBy(DriverContract::LAST_NAME, 'ASC')->orderBy(DriverContract::FIRST_NAME, 'ASC')->get();
    }

    public function getAllPaginated($numberOfElements)
    {
        return $this->newQuery()->orderBy(DriverContract::LAST_NAME, 'ASC')->orderBy(DriverContract::FIRST_NAME, 'ASC')->paginate($numberOfElements);
    }
}