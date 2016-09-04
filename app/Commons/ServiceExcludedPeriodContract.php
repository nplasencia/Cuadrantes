<?php

namespace Cuadrantes\Commons;

class ServiceExcludedPeriodContract extends CuadrantesContract
{
    const
        TABLE_NAME = 'service_excluded_periods',
        CODE       = 'code',
        VALUE      = 'value',
		FROM       = 'date_from',
		TO         = 'date_to';
}