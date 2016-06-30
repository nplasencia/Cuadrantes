<?php

namespace Cuadrantes\Entities;

use Cuadrantes\Commons\BusContract;

use Illuminate\Database\Eloquent\SoftDeletes;

class Bus extends Entity
{
    use SoftDeletes;

    protected $table = BusContract::TABLE_NAME;

    protected $fillable = [BusContract::LICENSE, BusContract::BRAND_ID, BusContract::SEATS, BusContract::STANDS, BusContract::REGISTRATION];

    public function brand()
    {
        return $this->belongsTo(Brand::class, BusContract::BRAND_ID);
    }
}