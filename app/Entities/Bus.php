<?php

namespace Cuadrantes\Entities;

class Bus extends Entity
{
    public function getBrand() {
        return $this->belongsTo(BusBrand::getClass());
    }
}
