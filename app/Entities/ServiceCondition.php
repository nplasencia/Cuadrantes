<?php

namespace Cuadrantes\Entities;

use Cuadrantes\Commons\ServiceConditionContract;

use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceCondition extends Entity
{
    use SoftDeletes;

    protected $table = ServiceConditionContract::TABLE_NAME;

    protected $fillable = [ServiceConditionContract::PERIOD_ID,     ServiceConditionContract::SERVICE_GROUP, ServiceConditionContract::PAIR_ID,
                           ServiceConditionContract::SUBSTITUTE_ID];

    public function period()
    {
        return $this->belongsTo(Period::class);
    }

    public function pair()
    {
        return $this->belongsTo(Pair::class);
    }

    public function substitute()
    {
        return $this->belongsTo(Pair::class, ServiceConditionContract::SUBSTITUTE_ID);
    }

    public function getDriversCount()
    {
        return sizeof($this->pair->drivers);
    }
}