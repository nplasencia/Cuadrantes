<?php

namespace Cuadrantes\Repositories;

use Cuadrantes\Entities\Driver;

class DriverRepository extends BaseRepository{
    
    public function getEntity() {
        return new Driver();
    }
}