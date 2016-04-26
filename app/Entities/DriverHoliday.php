<?php

namespace Cuadrantes\Entities;

class DriverHoliday extends Entity
{
    public function getDriver() {
        return $this->belongsTo(Driver::getClass());
    }
}