<?php

namespace Cuadrantes\Entities;

use Cuadrantes\Commons\CuadranteContract;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cuadrante extends Entity
{
	use SoftDeletes;

	protected $table = CuadranteContract::TABLE_NAME;

	protected $fillable = [CuadranteContract::SERVICE_ID, CuadranteContract::DRIVER_ID, CuadranteContract::DATE, CuadranteContract::SUBSTITUTE];

	protected $dates = [CuadranteContract::DATE];

	protected function service()
	{
		return $this->belongsTo(Service::class);
	}

	protected function driver()
	{
		return $this->belongsTo(Driver::class);
	}

	protected function bus()
	{
		return $this->belongsTo(Bus::class);
	}
}
