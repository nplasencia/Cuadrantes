<?php

namespace Cuadrantes\Entities;

class Driver extends Entity
{
    public function restDays() {
        return $this->belongsToMany(Weekday::getClass(), 'driver_rest_days');
    }

    public function holidays() {
        return $this->hasMany(DriverHoliday::getClass());
    }

    public function isRestDay(Weekday $weekday) {
        return $this->restDays()->where('weekday_id', $weekday->id)->where('active', true)->count();
    }

    public function addRestDay(array $weekdays) {
        foreach($weekdays as $weekday) {
            if (! $this->isRestDay($weekday)) {
                $this->restDays()->attach($weekday);
            }
        }
    }
}
