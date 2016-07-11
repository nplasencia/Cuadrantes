<?php

namespace Cuadrantes\Commons;

class DriverRestdayContract extends CuadrantesContract {
    const
        TABLE_NAME = 'driver_rest_days',
        DRIVER_ID  = 'driver_id',
        WEEKDAY_ID = 'weekday_id';

    public static $COLS = [DriverRestdayContract::DRIVER_ID, DriverRestdayContract::WEEKDAY_ID];
}