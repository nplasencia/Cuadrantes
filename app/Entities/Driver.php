<?php

namespace Cuadrantes\Entities;

use Cuadrantes\Commons\CuadranteContract;
use Cuadrantes\Commons\DriverContract;
use Cuadrantes\Commons\DriverRestdayContract;
use Cuadrantes\Commons\Globals;
use Cuadrantes\Repositories\CuadranteRepository;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class Driver extends Entity
{
    use SoftDeletes;

    protected $table = DriverContract::TABLE_NAME;

    protected $fillable = [DriverContract::FIRST_NAME, DriverContract::LAST_NAME, DriverContract::DNI, DriverContract::TELEPHONE,
                           DriverContract::EXTENSION,  DriverContract::EMAIL,     DriverContract::CAP, DriverContract::EXPIRATION];

    /*
     * Relations
     */

	public function restDays()
    {
        return $this->belongsToMany(Weekday::class, DriverRestdayContract::TABLE_NAME)->withTimestamps()->whereNull('deleted_at');
    }

    public function holidays()
    {
        return $this->hasMany(DriverHoliday::class)->whereNull('deleted_at');
    }

	public function pair()
	{
		return $this->hasOne(Pair::class);
	}

    public function cuadrantes()
    {
    	return $this->hasMany(Cuadrante::class);
    }

    public function offWorks()
    {
	    return $this->hasMany(OffWork::class)->whereNull('deleted_at');
    }

    /*
     * Attributes
     */

	public function getCapFormattedAttribute()
	{
		return $this->getFormattedDate($this->cap);
	}

	public function getExpirationFormattedAttribute()
	{
		return $this->getFormattedDate($this->driver_expiration);
	}

	public function getCompleteNameAttribute()
	{
		return "{$this->first_name} {$this->last_name}";
	}

	public function getFormalCompleteNameAttribute()
	{
		return "{$this->last_name}, {$this->first_name}";
	}

	public function getHolidaysFormatted($index)
	{
		if (isset($this->holidays[$index])) {
			$from = Carbon::createFromFormat( Globals::CARBON_SQL_FORMAT, $this->holidays[ $index ]->date_from )->format( Globals::CARBON_VIEW_FORMAT );
			$to   = Carbon::createFromFormat( Globals::CARBON_SQL_FORMAT, $this->holidays[ $index ]->date_to )->format( Globals::CARBON_VIEW_FORMAT );
			return "$from - $to";
		}
		return '';
	}

	/*
	 * Functions
	 */

	public function isRestDaysAssigned()
	{
		if (isset($this->restDays) && sizeof($this->restDays) == 2) {
			return true;
		}
		return false;
	}

	//TODO: Este método debe mirar si existen vacaciones para ese año y si la suma de los días es 30.
	public function isHolidaysAssigned()
	{
		if (isset($this->holidays) && sizeof($this->holidays) > 0) {

			return true;
		}
		return false;
	}

    public function isRestDay($weekday, Collection $restDays = null)
    {
    	if (!($weekday instanceof Weekday)) {
    		$weekdayId = $weekday;
    		$weekday = new Weekday();
		    $weekday->id = $weekdayId;
	    }

        if (!isset($restDays)) {
            return $this->restDays()->where('weekday_id', $weekday->id)->count();
        } else {
            foreach ($restDays as $restDay) {
                if ($restDay->id == $weekday->id) {
                    return true;
                }
            }
            return false;
        }
    }

    public function isInHolidays(Carbon $date, Collection $driverHolidays = null)
    {
        if (!isset($driverHolidays)) {
            $driverHolidays = $this->holidays;
        }

        foreach ($driverHolidays as $driverHoliday) {
            $holidayFrom = Carbon::createFromFormat( Globals::CARBON_SQL_FORMAT, $driverHoliday->date_from)->setTime(0, 0, 0);
            $holidayTo = Carbon::createFromFormat( Globals::CARBON_SQL_FORMAT, $driverHoliday->date_to)->setTime(23, 59, 59);

            if( $date->between($holidayFrom, $holidayTo, true)) {
                return true;
            }
        }
        return false;
    }

    private function getOrderedRestDays(Collection $driverRestDays = null)
    {
	    if (!isset($driverRestDays)) {
		    $driverRestDays = $this->restDays();
	    }

	    $orderedRestDays = new Collection();
	    foreach ($driverRestDays as $restDay) {
		    if ($restDay->code == 'SUN') {
			    $restDay->id = 0;
		    }
		    $orderedRestDays->put($restDay->id, $restDay);
	    }

	    return $orderedRestDays;
    }

    public function getLastRestingDay(Collection $driverRestDays = null)
    {
    	if ($driverRestDays->count() > 0 ) {
		    $orderedRestDays = $this->getOrderedRestDays( $driverRestDays );

		    return $orderedRestDays->last();
	    } else {
	    	return null;
	    }
    }

	/**
	 * Este método se utiliza para conocer saber si el día pasado por parámetro se encuentra después del último descanso del conductor.
	 * NOTA: Sólo utilizar para métodos que vayan mirando semana a semana, pues el método no sabe si se ha producido un cambio de semana. Ahora mismo,
	 * sólo se utiliza para el cálculo de los cuadrantes.
	 *
	 * @param Carbon $date
	 * @param Collection|null $driverRestDays
	 *
	 * @return bool
	 */
    public function isDayAfterResting (Carbon $date, Collection $driverRestDays = null)
    {
	    $lastDay = $this->getLastRestingDay($driverRestDays);

	    if ($date->dayOfWeek  > $lastDay->id) {
	    	return true;
	    }
	    return false;
    }

    public function isOffWork (Carbon $date, Collection $offWorks = null)
    {
    	if (!isset($offWorks)) {
		    $offWorks = $this->offWorks;
	    }

	    foreach ($offWorks as $offWork) {
	    	$offWorkDate = Carbon::createFromFormat( Globals::CARBON_SQL_FORMAT, $offWork->when )->setTime(0, 0, 0);
	    	if ($offWorkDate->eq($date)) {
	    		return true;
		    }
	    }
	    return false;
    }

}