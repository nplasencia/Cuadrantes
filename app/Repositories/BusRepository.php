<?php

namespace Cuadrantes\Repositories;

use Cuadrantes\Commons\Globals;
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
        return $this->newQuery()->with('brand')->orderBy(BusContract::LICENSE, 'ASC')->paginate($numberOfElements);
    }

    public function insert( Request $request )
    {
		$bus = new Bus($request->all());
	    $bus->registration = Carbon::createFromFormat(Globals::CARBON_VIEW_FORMAT, $request->get(BusContract::REGISTRATION))->format(Globals::CARBON_SQL_FORMAT);
	    $bus->save();
	    return $bus;
    }

	public function update($bus, Request $request)
    {
        $bus->license      = $request->get(BusContract::LICENSE);
        $bus->brand_id     = $request->get(BusContract::BRAND_ID);
        $bus->seats        = $request->get(BusContract::SEATS);
        $bus->stands       = $request->get(BusContract::STANDS);
        $bus->registration = Carbon::createFromFormat(Globals::CARBON_VIEW_FORMAT, $request->get(BusContract::REGISTRATION))->format(Globals::CARBON_SQL_FORMAT);
        $bus->update();
        return $bus;
    }

    public function updateById($id, Request $request)
    {
        $bus = $this->findOrFail($id);
        return $this->update($bus, $request);
    }
    
}