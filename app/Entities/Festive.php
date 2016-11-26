<?php

namespace Cuadrantes\Entities;

use Carbon\Carbon;
use Cuadrantes\Commons\FestiveContract;
use Cuadrantes\Commons\Globals;

class Festive extends Entity
{

	protected $table = FestiveContract::TABLE_NAME;

	protected $fillable = [FestiveContract::DATE, FestiveContract::ALWAYS, FestiveContract::DESCRIPTION];

	/*
	 * Attributes
	 */

	public function getDateFormattedAttribute()
	{
		if ($this->always) {
			$date = new Carbon($this->date);
			return $date->year(Carbon::now()->year)->format( Globals::CARBON_VIEW_FORMAT );
		}
		return $this->getFormattedDate($this->date);
	}
}
