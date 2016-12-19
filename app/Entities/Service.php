<?php

namespace Cuadrantes\Entities;

use Carbon\Carbon;
use Cuadrantes\Commons\ServiceContract;
use Cuadrantes\Commons\ServiceTimetablesContract;
use Cuadrantes\Commons\TimetableContract;
use Cuadrantes\Helpers\ColourHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;

    protected $table = ServiceContract::TABLE_NAME;

    protected $fillable = [ServiceContract::PERIOD_ID, ServiceContract::TIME, ServiceContract::NUMBER, ServiceContract::AUX];

    /*
     * Relations
     */

    public function period()
    {
        return $this->belongsTo(Period::class, TimetableContract::PERIOD_ID);
    }

    public function timetables()
    {
        return $this->belongsToMany(Timetable::class, ServiceTimetablesContract::TABLE_NAME)->withPivot(ServiceTimetablesContract::COLOUR)->orderBy(TimetableContract::TIME)
	        ->whereNull('timetables.deleted_at');
    }

    public function excludedPeriod()
    {
    	return $this->belongsTo(ServiceExcludedPeriod::class);
    }

    public function cuadrantes()
    {
    	return $this->hasMany(Cuadrante::class);
    }

	/*
	 * Functions
	 */

    public function isExcluded()
    {
    	if ($this->excludedPeriod != null) {
    		$now = Carbon::now();
		    $excludedFrom = Carbon::createFromFormat('Y-m-d', $this->excludedPeriod->date_from)->setTime(0, 0, 0)->year($now->year);
		    $excludedTo = Carbon::createFromFormat('Y-m-d', $this->excludedPeriod->date_to)->setTime(23, 59, 59)->year($now->year);
		    if( $now->between($excludedFrom, $excludedTo, true)) {
			    return true;
		    }
	    }
	    return false;
    }

    public function getOrderedTimetablesAttribute()
    {
	    if ($this->timetables->count() > 1) {
		    $lastElement     = $this->timetables->pop();
		    $lastElementTime = Carbon::createFromFormat( 'H:i:s', $lastElement->time );
		    $previousLastElementTime = Carbon::createFromFormat( 'H:i:s', $this->timetables->last()->time );

		    if ( $lastElementTime > $previousLastElementTime->addHours( 12 ) ) {
			    $this->timetables->prepend( $lastElement );
		    } else {
			    $this->timetables->push( $lastElement );
		    }
	    }
	    return $this->timetables;
    }
}