<?php

namespace Cuadrantes\Entities;

use Cuadrantes\Commons\DriverContract;
use Cuadrantes\Commons\PairContract;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pair extends Entity
{
    use SoftDeletes;

    protected $table = PairContract::TABLE_NAME;

    protected $fillable = [PairContract::PAIR_ID, PairContract::DRIVER_ID];

	/*
	 * Relations
	 */

    public function driver()
    {
        return $this->belongsTo(Driver::class)->orderBy(DriverContract::FIRST_NAME)->orderBy(DriverContract::LAST_NAME);
    }

    /*
     * Functions
     */

}