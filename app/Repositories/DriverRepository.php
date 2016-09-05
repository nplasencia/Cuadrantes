<?php

namespace Cuadrantes\Repositories;

use Carbon\Carbon;
use Cuadrantes\Commons\DriverContract;
use Cuadrantes\Entities\Driver;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class DriverRepository extends BaseRepository
{
    
    public function getEntity()
    {
        return new Driver();
    }

    public function getAll()
    {
        return $this->newQuery()->orderBy(DriverContract::LAST_NAME, 'ASC')->orderBy(DriverContract::FIRST_NAME, 'ASC')->with('restDays', 'holidays')->get();
    }

    public function getAllPaginated($numberOfElements)
    {
        return $this->newQuery()->orderBy(DriverContract::LAST_NAME, 'ASC')->orderBy(DriverContract::FIRST_NAME, 'ASC')->with('restDays', 'holidays')->paginate($numberOfElements);
    }

    public function findById($id)
    {
    	return $this->newQuery()->findOrFail($id);
    }

    public function store(Request $request)
    {
        $driver = new Driver($request->all());
        $driver->cap               = Carbon::createFromFormat('d/m/Y', $driver->cap)->format('Y-m-d');
        $driver->driver_expiration = Carbon::createFromFormat('d/m/Y', $driver->driver_expiration)->format('Y-m-d');
        $driver->save();
        return $driver;
    }

    public function getDriversNotInArray(Array $drivers)
    {
    	return $this->newQuery()->whereNotIn(DriverContract::ID, $drivers)->orderBy(DriverContract::LAST_NAME, 'ASC')
		    ->orderBy(DriverContract::FIRST_NAME, 'ASC')->with('restDays', 'holidays')->get();
    }

    public function getRestingDriversByDate(Carbon $date = null)
    {
	    $restingDrivers = new Collection();
    	if (!isset($date)){ $date = Carbon::create();}
	    $weekday = $date->dayOfWeek;
    	if ($weekday == Carbon::SUNDAY) {
    		$weekday = 7;
	    }

	    $drivers = $this->newQuery()->orderBy(DriverContract::FIRST_NAME, 'ASC')->orderBy(DriverContract::LAST_NAME, 'ASC')->with('restDays', 'holidays')->get();
	    foreach ($drivers as $driver) {
	    	if($driver->isRestDay( $weekday, $driver->restDays )) {
	    		$restingDrivers->add($driver);
		    }
	    }
	    return $restingDrivers;
    }

    public function getHolidaysDriversByDate(Carbon $date = null)
    {
	    $holidaysDrivers = new Collection();
	    if ( ! isset( $date ) ) {
		    $date = Carbon::create();
	    }
	    $drivers = $this->newQuery()->orderBy(DriverContract::FIRST_NAME, 'ASC')->orderBy(DriverContract::LAST_NAME, 'ASC')->with('restDays', 'holidays')->get();
	    foreach ($drivers as $driver) {
		    if($driver->isInHolidays( $date, $driver->holidays )) {
			    $holidaysDrivers->add($driver);
		    }
	    }
	    return $holidaysDrivers;
    }
}