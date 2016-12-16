<?php

namespace Cuadrantes\Entities;

use Carbon\Carbon;
use Cuadrantes\Commons\FestiveContract;
use Cuadrantes\Commons\Globals;

class Festive extends Entity
{

	protected $table = FestiveContract::TABLE_NAME;

	protected $fillable = [FestiveContract::DATE, FestiveContract::ALWAYS, FestiveContract::DESCRIPTION];

	/**
	 * Esta función devuelve la fecha completa de la clase mirando si el campo always es true y devolviendo la misma con
	 * el año correcto
	 */
	private function getCarbonDateAlways()
	{
		$date = new Carbon($this->date);
		if ($this->always) {
			return $date->year(Carbon::now()->year);
		}
		return $date;
	}

	/*
	 * Attributes
	 */

	public function getDateFormattedAttribute()
	{
		return $this->getCarbonDateAlways()->format( Globals::CARBON_VIEW_FORMAT );
	}

	/*
	 * Functions
	 */

	public function isFestive(Carbon $date)
	{
		return $date->isSameDay($this->getCarbonDateAlways());
	}
}
