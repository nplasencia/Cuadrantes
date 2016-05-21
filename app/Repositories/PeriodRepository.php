<?php

namespace Cuadrantes\Repositories;

use Cuadrantes\Entities\Period;

class PeriodRepository extends BaseRepository{
    
    public function getEntity() {
        return new Period();
    }
}