<?php

namespace Cuadrantes\Repositories;

use Cuadrantes\Entities\Service;

class ServiceRepository extends BaseRepository{
    
    public function getEntity() {
        return new Service();
    }
}