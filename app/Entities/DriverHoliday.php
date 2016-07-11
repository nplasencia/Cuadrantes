<?php

namespace Cuadrantes\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;

class DriverHoliday extends Entity
{
    use SoftDeletes;
    
    public function getDriver()
    {
        return $this->belongsTo(Driver::class);
    }
}