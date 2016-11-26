<?php

namespace Cuadrantes\Repositories;

use Carbon\Carbon;
use Cuadrantes\Commons\FestiveContract;
use Cuadrantes\Commons\Globals;
use Cuadrantes\Entities\Festive;
use Illuminate\Http\Request;

class FestiveRepository extends BaseRepository
{
    
    public function getEntity()
    {
        return new Festive();
    }

    public function getAllByYear()
    {
	    $firstDayOfYear = Carbon::now()->month(1)->day(1);
	    $lastDayOfYear = Carbon::now()->month(12)->day(31);
        return $this->newQuery()->whereBetween(FestiveContract::DATE, [$firstDayOfYear, $lastDayOfYear])
	        ->orWhere(FestiveContract::ALWAYS, true)->orderBy(FestiveContract::DATE, 'ASC')->get();
    }

	public function getAllByYearPaginated($numberOfElements)
	{
		$firstDayOfYear = Carbon::now()->month(1)->day(1);
		$lastDayOfYear = Carbon::now()->month(12)->day(31);
		return $this->newQuery()->whereBetween(FestiveContract::DATE, [$firstDayOfYear, $lastDayOfYear])
		            ->orWhere(FestiveContract::ALWAYS, true)->orderBy(FestiveContract::DATE, 'ASC')->paginate($numberOfElements);
	}

	public function store(Request $request)
	{
		$festive = new Festive($request->all());
		$festive->date = Carbon::createFromFormat(Globals::CARBON_VIEW_FORMAT, $request->get(FestiveContract::DATE))->format(Globals::CARBON_SQL_FORMAT);
		$festive->save();
		return $festive;
	}
}
