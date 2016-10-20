<?php

namespace Cuadrantes\Entities;

use Cuadrantes\Commons\OffWorkContract;
use Illuminate\Database\Eloquent\SoftDeletes;

class OffWork extends Entity
{
	use SoftDeletes;

	protected $table = OffWorkContract::TABLE_NAME;

	protected $fillable = [OffWorkContract::DRIVER_ID, OffWorkContract::WHEN];

	/*
	 * Relations
	 */

	public function driver()
	{
		return $this->belongsTo(Driver::class, OffWorkContract::DRIVER_ID);
	}

	/*
	 * Attributes
	 */

	public function getDateFormattedAttribute()
	{
		return $this->getFormattedDate($this->when);
	}
}