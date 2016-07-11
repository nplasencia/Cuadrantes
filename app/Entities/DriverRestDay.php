<?php

namespace Cuadrantes\Entities;

use Cuadrantes\Commons\DriverRestdayContract;
use Illuminate\Database\Eloquent\SoftDeletes;

class DriverRestDay extends Entity
{
    use SoftDeletes;

    protected $fillable = [DriverRestdayContract::DRIVER_ID, DriverRestdayContract::WEEKDAY_ID];

    public function getDriver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function getWeekday()
    {
        return $this->belongsTo(Weekday::class);
    }
}
