<?php

namespace Cuadrantes\Entities;

use Cuadrantes\Commons\PairContract;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pair extends Entity
{
    use SoftDeletes;

    protected $table = PairContract::TABLE_NAME;

    protected $fillable = [PairContract::PAIR_ID, PairContract::DRIVER_ID];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function drivers()
    {
        return $this->belongsToMany(Driver::class, PairContract::TABLE_NAME);
    }
}