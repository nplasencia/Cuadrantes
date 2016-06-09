<?php

namespace Cuadrantes\Entities;

use Illuminate\Database\Eloquent\Model;
use Cuadrantes\Commons\ServiceContract;
use Cuadrantes\Commons\TimetableContract;

class Service extends Model
{
    protected $table = ServiceContract::TABLE_NAME;

    protected $fillable = [ServiceContract::PERIOD_ID, ServiceContract::TIME, ServiceContract::NUMBER, ServiceContract::AUX, ServiceContract::GROUP];

    public function period()
    {
        return $this->belongsTo(Period::class, TimetableContract::PERIOD_ID);
    }
}
