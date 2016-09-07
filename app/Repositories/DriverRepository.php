<?php

namespace Cuadrantes\Repositories;

use Carbon\Carbon;
use Cuadrantes\Commons\DriverContract;
use Cuadrantes\Commons\Globals;
use Cuadrantes\Entities\Driver;
use Cuadrantes\Entities\DriverHoliday;
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

	private function saveHolidays( Array $holidaysRaw, Driver $driver )
	{
		foreach ($holidaysRaw as $holidayRaw) {
			if ( ! isset( $holidayRaw ) || $holidayRaw == null || $holidayRaw == '' ) {
				continue;
			}

			$holidays                 = str_split( str_replace( ' - ', '', $holidayRaw ), strpos( $holidayRaw, ' - ' ) );
			$driverHoliday            = new DriverHoliday();
			$driverHoliday->driver_id = $driver->id;
			$driverHoliday->date_from = Carbon::createFromFormat( Globals::CARBON_VIEW_FORMAT, $holidays[0] )->format( Globals::CARBON_SQL_FORMAT );
			$driverHoliday->date_to   = Carbon::createFromFormat( Globals::CARBON_VIEW_FORMAT, $holidays[1] )->format( Globals::CARBON_SQL_FORMAT );
			$driverHoliday->save();
		}

	}

    public function store(Request $request)
    {
        $driver = new Driver($request->all());
        $driver->cap               = Carbon::createFromFormat(Globals::CARBON_VIEW_FORMAT, $driver->cap)->format(Globals::CARBON_SQL_FORMAT);
        $driver->driver_expiration = Carbon::createFromFormat(Globals::CARBON_VIEW_FORMAT, $driver->driver_expiration)->format(Globals::CARBON_SQL_FORMAT);
        $driver->save();

	    $driver->restDays()->attach( $request->get( 'restDays' ) );
	    $this->saveHolidays([$request->get( 'holidays1' ), $request->get( 'holidays2' )], $driver);

        return $driver;
    }

	public function updateById($id, Request $request)
	{
		$driver = $this->findById($id);
		return $this->update($driver, $request);
	}

	public function update(Driver $driver, Request $request)
	{
		$driver->last_name         = $request->get(DriverContract::LAST_NAME);
		$driver->first_name        = $request->get(DriverContract::FIRST_NAME);
		$driver->dni               = $request->get(DriverContract::DNI);
		$driver->telephone         = $request->get(DriverContract::TELEPHONE);
		$driver->extension         = $request->get(DriverContract::EXTENSION);
		$driver->email             = $request->get(DriverContract::EMAIL);
		$driver->cap               = Carbon::createFromFormat(Globals::CARBON_VIEW_FORMAT, $request->get(DriverContract::CAP))->format(Globals::CARBON_SQL_FORMAT);
		$driver->driver_expiration = Carbon::createFromFormat(Globals::CARBON_VIEW_FORMAT, $request->get(DriverContract::EXPIRATION))->format(Globals::CARBON_SQL_FORMAT);
		$driver->update();

		$driver->restDays()->sync($request->get('restDays'));
		$driver->holidays()->delete();
		$this->saveHolidays([$request->get( 'holidays1' ), $request->get( 'holidays2' )], $driver);

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