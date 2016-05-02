<?php

namespace Cuadrantes\Entities;

use Cuadrantes\Commons\BusContract;

class Bus extends Entity
{
    protected $table = BusContract::TABLE_NAME;

    protected $fillable = [BusContract::LICENSE, BusContract::BRAND_ID, BusContract::SEATS, BusContract::STANDS, BusContract::REGISTRATION];

    public function brand()
    {
        return $this->belongsTo(Brand::class, BusContract::BRAND_ID);
    }
}