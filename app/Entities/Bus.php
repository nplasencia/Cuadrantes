<?php

namespace Cuadrantes\Entities;

use Carbon\Carbon;
use Cuadrantes\Commons\BusContract;

use Cuadrantes\Commons\Globals;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bus extends Entity
{
    use SoftDeletes;

    protected $table = BusContract::TABLE_NAME;

    protected $fillable = [BusContract::LICENSE, BusContract::BRAND_ID, BusContract::SEATS, BusContract::STANDS, BusContract::REGISTRATION];

	/*
	 * Relations
	 */

    public function brand()
    {
        return $this->belongsTo(Brand::class, BusContract::BRAND_ID);
    }

    /*
     * Attributes
     */

    public function getNameLicenseAttribute()
    {
	    return "{$this->brand->name} (Matrícula: {$this->license})";
    }

    public function getRegistrationFormattedAttribute()
    {
	    return $this->getFormattedDate($this->registration);
    }

    public function getTotalSeatsAttribute()
    {
    	return ($this->seats + $this->stands);
    }
}