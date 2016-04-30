<?php

namespace Cuadrantes\Entities;

class Bus extends Entity
{
    protected $table = 'buses';

    protected $fillable = ['license', 'brand_id', 'seats', 'stands', 'registration'];

    public function brand()
    {
        return $this->belongsTo(Brand::getClass(), 'brand_id');
    }
}