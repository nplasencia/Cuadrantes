<?php

namespace Cuadrantes\Entities;

use Cuadrantes\Commons\ServiceGroupOrderContract;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceGroupOrder extends Entity
{
    use SoftDeletes;

    protected $table = ServiceGroupOrderContract::TABLE_NAME;

    protected $fillable = [ServiceGroupOrderContract::PERIOD_ID, ServiceGroupOrderContract::GROUP, ServiceGroupOrderContract::DRIVER_ID, ServiceGroupOrderContract::SERVICE_ID, ServiceGroupOrderContract::NORMALIZED];

	public function period()
	{
		return $this->belongsTo(Period::class);
	}

	public function driver()
	{
		return $this->belongsTo(Driver::class);
	}

	public function service()
	{
		return $this->belongsTo(Service::class);
	}
    
}