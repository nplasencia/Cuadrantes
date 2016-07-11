<?php

namespace Cuadrantes\Commons;

class DriverHolidayContract extends CuadrantesContract {
    const
        TABLE_NAME = 'driver_holidays',
        DRIVER_ID  = 'driver_id',
        FROM       = 'date_from',
        TO         = 'date_to';
}