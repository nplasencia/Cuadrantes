<?php

namespace Cuadrantes\Repositories;

use Cuadrantes\Entities\ServiceGroupOrder;

class ServiceGroupOrderRepository extends BaseRepository{
    
    public function getEntity()
    {
        return new ServiceGroupOrder();
    }

    public function getAll()
    {
        return $this->newQuery()->with('service')->get();
    }
}