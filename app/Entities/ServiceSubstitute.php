<?php

namespace Cuadrantes\Entities;

use Cuadrantes\Commons\ServiceSubstituteContract;

use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceSubstitute extends Entity
{
    use SoftDeletes;

    protected $table = ServiceSubstituteContract::TABLE_NAME;

    protected $fillable = [ServiceSubstituteContract::PERIOD_ID, ServiceSubstituteContract::SERVICE_GROUP, ServiceSubstituteContract::DRIVER_ID];

    public function period()
    {
        return $this->belongsTo(Period::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}