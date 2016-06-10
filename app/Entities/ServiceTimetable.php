<?php

namespace Cuadrantes\Entities;

use Illuminate\Database\Eloquent\Model;

class ServiceTimetable extends Model
{
    //

    public function services()
    {
        return $this->belongsTo(Service::class);
    }

    public function timetables()
    {
        return $this->belongsTo(Timetable::class);
    }
}
