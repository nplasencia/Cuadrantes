<?php

namespace Cuadrantes\Entities;

use Cuadrantes\Commons\WeekdayContract;

class Weekday extends Entity
{
    public $timestamps = false;

    protected $table = WeekdayContract::TABLE_NAME;

    protected $fillable = [WeekdayContract::CODE, WeekdayContract::VALUE];
}