<?php

namespace Cuadrantes\Entities;

use Cuadrantes\Commons\DriverContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class Driver extends Entity
{
    use SoftDeletes;

    protected $table = DriverContract::TABLE_NAME;

    protected $fillable = [DriverContract::FIRST_NAME, DriverContract::LAST_NAME, DriverContract::DNI, DriverContract::TELEPHONE,
                           DriverContract::EXTENSION,  DriverContract::EMAIL,     DriverContract::CAP, DriverContract::EXPIRATION];

    public function restDays()
    {
        return $this->belongsToMany(Weekday::class, 'driver_rest_days');
    }

    public function holidays()
    {
        return $this->hasMany(DriverHoliday::class);
    }

    public function isRestDay(Weekday $weekday, Collection $restDays = null)
    {
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
            $holidayFrom = Carbon::createFromFormat('Y-m-d', $driverHoliday->date_from);
            $holidayTo = Carbon::createFromFormat('Y-m-d', $driverHoliday->date_to);

            if( $date->between($holidayFrom, $holidayTo)) {
                return true;
            }
        }
        return false;
    }

    public function pair()
    {
        return $this->belongsTo(Pair::class);
    }

    public function getCompleteName()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function addRestDay(array $weekdays)
    {
        foreach($weekdays as $weekday) {
            if (! $this->isRestDay($weekday)) {
                $this->restDays()->attach($weekday);
            }
        }
    }
}