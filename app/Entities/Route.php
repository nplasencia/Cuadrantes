<?php

namespace Cuadrantes\Entities;

use Illuminate\Database\Eloquent\Model;
use Cuadrantes\Commons\RouteContract;
use Illuminate\Database\Eloquent\SoftDeletes;

class Route extends Model
{
    use SoftDeletes;

    protected $table = RouteContract::TABLE_NAME;

    protected $fillable = [RouteContract::LINE_ID, RouteContract::ORIGIN, RouteContract::DESTINY, RouteContract::GO];

    public function line()
    {
        return $this->belongsTo(Line::class, RouteContract::LINE_ID);
    }

    public function timetables()
    {
        return $this->hasMany(Timetable::class);
    }
}
