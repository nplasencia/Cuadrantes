<?php

namespace Cuadrantes\Entities;

use Illuminate\Database\Eloquent\Model;
use Cuadrantes\Commons\ServiceExcludedPeriodContract;

class ServiceExcludedPeriod extends Model
{
	public $timestamps = false;

	protected $table = ServiceExcludedPeriodContract::TABLE_NAME;

	protected $fillable = [ServiceExcludedPeriodContract::CODE, ServiceExcludedPeriodContract::VALUE, ServiceExcludedPeriodContract::FROM, ServiceExcludedPeriodContract::TO];

	public function services()
	{
		$this->hasMany(Service::class);
	}
}