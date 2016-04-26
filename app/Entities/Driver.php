<?php

namespace Cuadrantes\Entities;

class Driver extends Entity
{
    public function restDays() {
        return $this->hasMany(DriverRestDay::getClass());
    }

    public function holidays() {
        return $this->hasMany(DriverHoliday::getClass());
    }
}
