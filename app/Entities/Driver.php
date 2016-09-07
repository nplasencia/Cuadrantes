<?php

namespace Cuadrantes\Entities;

use Cuadrantes\Commons\DriverContract;
use Cuadrantes\Commons\DriverRestdayContract;
use Cuadrantes\Commons\Globals;
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
		return $this->belongsTo(Pair::class);
	}

    public function cuadrantes()
    {
    	return $this->hasMany(Cuadrante::class);
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

}