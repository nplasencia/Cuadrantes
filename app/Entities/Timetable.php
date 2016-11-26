<?php

namespace Cuadrantes\Entities;

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
	        ->whereNull('services.deleted_at');;
    }

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
}