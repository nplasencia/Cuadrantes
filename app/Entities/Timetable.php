<?php

namespace Cuadrantes\Entities;

use Carbon\Carbon;
use Cuadrantes\Commons\ServiceTimetablesContract;
use Cuadrantes\Helpers\ColourHelper;
use Illuminate\Database\Eloquent\Model;
use Cuadrantes\Commons\TimetableContract;
use Illuminate\Database\Eloquent\SoftDeletes;

class Timetable extends Model
{
    use SoftDeletes;

    protected $table = TimetableContract::TABLE_NAME;

    protected $fillable = [TimetableContract::ROUTE_ID, TimetableContract::PERIOD_ID, TimetableContract::TIME, TimetableContract::BY, TimetableContract::PASS];

    public function route()
    {
        return $this->belongsTo(Route::class, TimetableContract::ROUTE_ID);
    }

    public function period()
    {
        return $this->belongsTo(Period::class, TimetableContract::PERIOD_ID);
    }

    public function service()
    {
        return $this->belongsToMany(Service::class, ServiceTimetablesContract::TABLE_NAME)->withPivot(ServiceTimetablesContract::COLOUR)
	        ->whereNull('services.deleted_at');
    }

    /*
     * Attributes
     */

	public function getBackgroundColorAttribute()
	{
		return '#'.$this->pivot->colour;
	}

	public function getTextColorAttribute()
	{
		if (ColourHelper::isDark($this->getBackgroundColorAttribute())) {
			return '#FFFFFF';
		}
		return '#000000';
	}

	public function getFormattedTimeAttribute()
	{
		return Carbon::createFromFormat('H:i:s', $this->time)->format('H:i');
	}

	public function getOriginTitleAttribute()
	{
		$origin = $this->route->origin.$this->by;
		if ($this->pass) {
			return $this->by;
		} else {
			if ($this->by != '') {
				return $this->route->origin.'<br>('.$this->by.')';
			}
		}
		return $origin;
	}
}
