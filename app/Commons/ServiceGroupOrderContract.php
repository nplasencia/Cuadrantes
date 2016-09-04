<?php

namespace Cuadrantes\Commons;

class ServiceGroupOrderContract extends CuadrantesContract
{
    const
        TABLE_NAME   = 'service_group_order',
	    PERIOD_ID    = 'period_id',
	    GROUP        = 'group',
        DRIVER_ID    = 'driver_id',
        SERVICE_ID   = 'service_id',
        NORMALIZED   = 'normalized';
}