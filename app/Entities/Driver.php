<?php

namespace Cuadrantes\Entities;

use Cuadrantes\Commons\DriverContract;
use Cuadrantes\Commons\DriverRestdayContract;

class Driver extends Entity
{
    protected $table = 'drivers';

    protected $fillable = [DriverContract::FIRST_NAME, DriverContract::LAST_NAME, DriverContract::DNI, DriverContract::TELEPHONE,
                           DriverContract::EXTENSION,  DriverContract::EMAIL,     DriverContract::CAP, DriverContract::EXPIRATION];

    public function restDays()
    {
        return $this->belongsToMany(Weekday::class, DriverRestdayContract::TABLE_NAME);
    }

    public function holidays()
    {
        return $this->hasMany(DriverHoliday::class);
    }

    public function isRestDay(Weekday $weekday)
    {
        return $this->restDays()->where(DriverRestdayContract::WEEKDAY_ID, $weekday->id)->where(DriverContract::ACTIVE, true)->count();
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