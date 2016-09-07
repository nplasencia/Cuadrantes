<?php

namespace Cuadrantes\Repositories;

use Cuadrantes\Entities\Bus;
use Cuadrantes\Commons\BusContract;

use Carbon\Carbon;
use Illuminate\Http\Request;

class BusRepository extends BaseRepository
{
    
    public function getEntity()
    {
        return new Bus();
    }

    public function getAll()
    {
        return $this->newQuery()->with('brand')->orderBy(BusContract::LICENSE, 'ASC')->get();
    }

    public function getAllPaginated($numberOfElements)
    {
        return $this->newQuery()->with('brand')
            ->orderBy(BusContract::LICENSE, 'ASC')
            ->paginate($numberOfElements);
    }
    
    public function searchByLicensePaginated($license, $numberOfElements)
    {
        return $this->newQuery()->where(BusContract::LICENSE, 'LIKE', '%'.$license.'%')
            ->orderBy(BusContract::LICENSE, 'ASC')
            ->paginate($numberOfElements);
    }

    public function insert( Request $request )
    {
		$bus = new Bus($request->all());
	    $bus->registration = Carbon::createFromFormat('d/m/Y', $request->get(BusContract::REGISTRATION))->format('Y-m-d');
	    $bus->save();
	    return $bus;
    }

	public function update($bus, $license, $brandId, $seats, $stands, $registration)
    {
        $bus->license      = $license;
        $bus->brand_id     = $brandId;
        $bus->seats        = $seats;
        $bus->stands       = $stands;
        $bus->registration = $registration;
        $bus->update();
        return $bus;
    }

    public function updateById($id, $license, $brandId, $seats, $stands, $registration)
    {
        $bus = $this->findOrFail($id);
        return $this->update($bus, $license, $brandId, $seats, $stands, $registration);
    }
    
}