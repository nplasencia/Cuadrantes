<?php

namespace Cuadrantes\Entities;

use Illuminate\Database\Eloquent\Model;
use Cuadrantes\Commons\TimetableContract;

class Timetable extends Model
{
    protected $table = TimetableContract::TABLE_NAME;

    protected $fillable = [TimetableContract::ROUTE_ID, TimetableContract::PERIOD_ID, TimetableContract::TIME, TimetableContract::BY];
}
