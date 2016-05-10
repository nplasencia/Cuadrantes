<?php

namespace Cuadrantes\Entities;

use Cuadrantes\Commons\DriverContract;

class Driver extends Entity
{
    protected $table = 'drivers';

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

    public function isRestDay(Weekday $weekday)
    {
        return $this->restDays()->where('weekday_id', $weekday->id)->where('active', true)->count();
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