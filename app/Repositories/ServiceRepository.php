<?php

namespace Cuadrantes\Repositories;

use Cuadrantes\Commons\ServiceContract;
use Cuadrantes\Entities\Service;
use Illuminate\Http\Request;

class ServiceRepository extends BaseRepository
{
    
    public function getEntity()
    {
        return new Service();
    }

    public function findByPeriod($period_id)
    {
        return $this->newQuery()->where(ServiceContract::PERIOD_ID, $period_id)->orderBy(ServiceContract::NUMBER)->with('timetables.route.line')->get();
    }

    public function findByNumber($serviceNumber)
    {
        return $this->newQuery()->where(ServiceContract::NUMBER, $serviceNumber)->orderBy(ServiceContract::NUMBER)->firstOrFail();
    }

    public function updateById($id, Request $request)
    {
        $service = $this->findOrFail($id);
        $service->period_id = $request->get(ServiceContract::PERIOD_ID);
        $service->time      = $request->get(ServiceContract::TIME);
        $service->number    = $request->get(ServiceContract::NUMBER);
        $service->aux       = $request->get(ServiceContract::AUX);
        $service->update();

        return $service;
    }
}