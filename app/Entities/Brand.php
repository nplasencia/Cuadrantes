<?php

namespace Cuadrantes\Entities;

class Brand extends Entity
{
    protected $table = 'brands';

    public function buses()
    {
        return $this->hasMany(Bus::getClass());
    }
}
