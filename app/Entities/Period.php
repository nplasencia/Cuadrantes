<?php

namespace Cuadrantes\Entities;

use Illuminate\Database\Eloquent\Model;
use Cuadrantes\Commons\PeriodContract;

class Period extends Model
{
    protected $table = PeriodContract::TABLE_NAME;

    protected $fillable = [PeriodContract::CODE, PeriodContract::VALUE];
}