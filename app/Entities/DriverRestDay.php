<?php

namespace Cuadrantes\Entities;

class DriverRestDay extends Entity
{
    public function getDriver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function getWeekday()
    {
        return $this->belongsTo(Weekday::class);
    }
}
