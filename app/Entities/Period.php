<?php

namespace Cuadrantes\Entities;

use Illuminate\Database\Eloquent\Model;
use Cuadrantes\Commons\PeriodContract;
use Cuadrantes\Commons\TimetableContract;

class Period extends Model
{
	const WORK = 1;
	const SUNDAY = 3;

    public $timestamps = false;

    protected $table = PeriodContract::TABLE_NAME;

    protected $fillable = [PeriodContract::CODE, PeriodContract::VALUE];

    public function timetable()
    {
        return $this->belongsToMany(Period::class, TimetableContract::PERIOD_ID);
    }
}