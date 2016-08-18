<?php

namespace Cuadrantes\Entities;

use Cuadrantes\Commons\ServiceConditionContract;

use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceCondition extends Entity
{
    use SoftDeletes;

    protected $table = ServiceConditionContract::TABLE_NAME;

    protected $fillable = [ServiceConditionContract::PERIOD_ID, ServiceConditionContract::SERVICE_GROUP, ServiceConditionContract::DRIVER_ID];

    public function period()
    {
        return $this->belongsTo(Period::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}