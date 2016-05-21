<?php

namespace Cuadrantes;

use Illuminate\Database\Eloquent\Model;
use Cuadrantes\Commons\RouteContract;

class Route extends Model
{
    protected $table = RouteContract::TABLE_NAME;

    protected $fillable = [RouteContract::LINE_ID, RouteContract::ORIGIN, RouteContract::DESTINY, RouteContract::GO];
}
