<?php

namespace Cuadrantes\Entities;

use Cuadrantes\Commons\LineContract;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Line extends Model
{
    use SoftDeletes;

    protected $table = LineContract::TABLE_NAME;

    protected $fillable = [LineContract::NUMBER, LineContract::NAME];

    public function routes()
    {
        return $this->hasMany(Route::class);
    }
    
    public function timetables()
    {
        return $this->hasManyThrough(Timetable::class, Route::class);
    }
}