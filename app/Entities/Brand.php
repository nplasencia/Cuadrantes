<?php

namespace Cuadrantes\Entities;

use Cuadrantes\Commons\BrandContract;

class Brand extends Entity
{
    protected $table = BrandContract::TABLE_NAME;

    protected $fillable = [BrandContract::NAME];

    public function buses()
    {
        return $this->hasMany(Bus::class);
    }
}