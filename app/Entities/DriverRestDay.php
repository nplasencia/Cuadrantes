<?php

namespace Cuadrantes\Entities;

class DriverRestDay extends Entity
{
    protected $fillable = ['driver_id', 'weekday_id'];

    public function getDriver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function getWeekday()
    {
        return $this->belongsTo(Weekday::class);
    }
}
