<?php

namespace Cuadrantes\Entities;

use Cuadrantes\Commons\ServiceTimetablesContract;
use Illuminate\Database\Eloquent\Model;
use Cuadrantes\Commons\TimetableContract;

class Timetable extends Model
{
    protected $table = TimetableContract::TABLE_NAME;

    protected $fillable = [TimetableContract::ROUTE_ID, TimetableContract::PERIOD_ID, TimetableContract::TIME, TimetableContract::BY, TimetableContract::PASS];

    public function route()
    {
        return $this->belongsTo(Route::class, TimetableContract::ROUTE_ID);
    }

    public function period()
    {
        return $this->belongsTo(Period::class, TimetableContract::PERIOD_ID);
    }

    public function service()
    {
        return $this->belongsToMany(Service::class, ServiceTimetablesContract::TABLE_NAME);
    }
}