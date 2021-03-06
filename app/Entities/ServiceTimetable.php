<?php

namespace Cuadrantes\Entities;

use Illuminate\Database\Eloquent\Model;
use Cuadrantes\Commons\ServiceTimetablesContract;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceTimetable extends Model
{
    use SoftDeletes;

    public $timestamps = false;

    protected $fillable = [ ServiceTimetablesContract::SERVICE_ID, ServiceTimetablesContract::TIMETABLE_ID, ServiceTimetablesContract::COLOUR ];

    public function services()
    {
        return $this->belongsTo(Service::class);
    }

    public function timetables()
    {
        return $this->belongsTo(Timetable::class);
    }
}
