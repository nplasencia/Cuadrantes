<?php

namespace Cuadrantes\Repositories;

use Carbon\Carbon;
use Cuadrantes\Commons\Globals;
use Cuadrantes\Commons\OffWorkContract;
use Cuadrantes\Entities\OffWork;
use Illuminate\Http\Request;

class OffWorkRepository extends BaseRepository
{
    
    public function getEntity() {
        return new OffWork();
    }

    public function getAll() {
        return $this->newQuery()->with('driver')->orderBy(OffWorkContract::WHEN, 'ASC')->get();
    }

	public function getAllPaginated($numberOfElements)
	{
		return $this->newQuery()->with('driver')->orderBy(OffWorkContract::WHEN, 'ASC')->paginate($numberOfElements);
	}

	public function store(Request $request)
	{
		$offWork = new OffWork($request->all());
		$offWork->when = Carbon::createFromFormat(Globals::CARBON_VIEW_FORMAT, $offWork->when)->format(Globals::CARBON_SQL_FORMAT);
		$offWork->save();

		return $offWork;
	}

	public function getDriversByDate(Carbon $date)
	{
		$when = $date->format(Globals::CARBON_SQL_FORMAT);
		return $this->newQuery()->with('driver')->where(OffWorkContract::WHEN, $when)->get();
	}
}