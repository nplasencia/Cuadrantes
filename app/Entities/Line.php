<?php

namespace Cuadrantes\Entities;

use Illuminate\Database\Eloquent\Model;
use Cuadrantes\Commons\LineContract;

class Line extends Model
{
    protected $table = LineContract::TABLE_NAME;

    protected $fillable = [LineContract::NUMBER, LineContract::NAME, LineContract::ACTIVE];
}