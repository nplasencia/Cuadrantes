<?php

namespace Cuadrantes\Repositories;

use Carbon\Carbon;
use Cuadrantes\Commons\Globals;
use Cuadrantes\Commons\OffWorkContract;
use Cuadrantes\Entities\OffWork;
use Illuminate\Http\Request;

class OffWorkRepository extends BaseRepository
{
    
    public function getEntity()
    {
        return new OffWork();
    }

    public function getAll()
    {
        return $this->newQuery()->with('driver')->orderBy(OffWorkContract::FROM, 'ASC')->get();
    }

	public function getAllPaginated($numberOfElements)
	{
		return $this->newQuery()->with('driver')->orderBy(OffWorkContract::FROM, 'ASC')->paginate($numberOfElements);
	}

	public function store(Request $request)
	{
		$offWork = new OffWork($request->all());
		$offWorkDates = str_split( str_replace( ' - ', '', $request['offWork'] ), strpos( $request['offWork'], ' - ' ) );
		$offWork->from = Carbon::createFromFormat(Globals::CARBON_VIEW_FORMAT, $offWorkDates[0])->format(Globals::CARBON_SQL_FORMAT);
		$offWork->to   = Carbon::createFromFormat(Globals::CARBON_VIEW_FORMAT, $offWorkDates[1])->format(Globals::CARBON_SQL_FORMAT);
		$offWork->save();

		return $offWork;
	}

	public function getDriversByDate(Carbon $date)
	{
		$date = $date->format(Globals::CARBON_SQL_FORMAT);
		return $this->newQuery()->with('driver')->where(OffWorkContract::FROM, '<=' ,$date)->where(OffWorkContract::TO, '>=' ,$date)->get();
	}
}
