<?php

namespace Cuadrantes\Entities;

class BusBrand extends Entity
{
    public function getBuses() {
        return $this->hasMany(Bus::getClass());
    }
}
