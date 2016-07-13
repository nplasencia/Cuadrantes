<?php

namespace Cuadrantes\Entities;

use Cuadrantes\Commons\ServiceTimetablesContract;
use Cuadrantes\Commons\ServiceContract;
use Cuadrantes\Commons\TimetableContract;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;

    protected $table = ServiceContract::TABLE_NAME;

    protected $fillable = [ServiceContract::PERIOD_ID, ServiceContract::TIME, ServiceContract::NUMBER, ServiceContract::AUX];

    public function period()
    {
        return $this->belongsTo(Period::class, TimetableContract::PERIOD_ID);
    }

    public function timetables()
    {
        return $this->belongsToMany(Timetable::class, ServiceTimetablesContract::TABLE_NAME)->withPivot(ServiceTimetablesContract::COLOUR)->orderBy(TimetableContract::TIME);
    }
}