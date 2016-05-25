<?php

namespace Cuadrantes\Entities;

use Illuminate\Database\Eloquent\Model;
use Cuadrantes\Commons\TimetableContract;

class Timetable extends Model
{
    protected $table = TimetableContract::TABLE_NAME;

    protected $fillable = [TimetableContract::ROUTE_ID, TimetableContract::PERIOD_ID, TimetableContract::TIME, TimetableContract::BY];

    public function route()
    {
        return $this->belongsTo(Route::class, TimetableContract::ROUTE_ID);
    }

    public function period()
    {
        return $this->belongsTo(Period::class, TimetableContract::PERIOD_ID);
    }
}
