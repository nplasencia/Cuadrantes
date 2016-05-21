<?php

namespace Cuadrantes\Repositories;

use Cuadrantes\Entities\Bus;
use Cuadrantes\Commons\BusContract;

class BusRepository extends BaseRepository{
    
    public function getEntity()
    {
        return new Bus();
    }

    public function getAllPaginated($numberOfElements)
    {
        return $this->newQuery()->where(BusContract::ACTIVE, true)
            ->orderBy(BusContract::LICENSE, 'ASC')
            ->with('brand')
            ->paginate($numberOfElements);
    }
    
    public function searchByLicensePaginated($license, $numberOfElements)
    {
        return $this->newQuery()->where(BusContract::LICENSE, 'LIKE', '%'.$license.'%')
            ->orderBy(BusContract::LICENSE, 'ASC')
            ->paginate($numberOfElements);
    }

    public function update($bus, $license, $brandId, $seats, $stands, $registration)
    {
        $bus->license      = $license;
        $bus->brand_id     = $brandId;
        $bus->seats        = $seats;
        $bus->stands       = $stands;
        $bus->registration = $registration;
        $bus->active       = true;
        $bus->save();
        return $bus;
    }

    public function updateById($id, $license, $brandId, $seats, $stands, $registration)
    {
        $bus = $this->findOrFail($id);
        return $this->update($bus, $license, $brandId, $seats, $stands, $registration);
    }
    
}