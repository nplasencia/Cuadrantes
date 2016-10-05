<?php

namespace Cuadrantes\Repositories;

use Cuadrantes\Commons\ServiceConditionContract;
use Cuadrantes\Entities\ServiceCondition;

class ServiceConditionRepository extends BaseRepository
{
    
    public function getEntity()
    {
        return new ServiceCondition();
    }

    public function getAll()
    {
        return $this->newQuery()->orderBy(ServiceConditionContract::PERIOD_ID)->with('driver','service')->get();
    }

}