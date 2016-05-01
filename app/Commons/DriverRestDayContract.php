<?php

namespace Cuadrantes\Commons;

class DriverRestdayContract extends CuadrantesContract {
    const
        TABLE_NAME = 'driver_restdays',
        DRIVER_ID  = 'driver_id',
        WEEKDAY_ID = 'weekday_id',
        ACTIVE     = 'active';

    public static $COLS = [DriverRestdayContract::DRIVER_ID, DriverRestdayContract::WEEKDAY_ID, DriverRestdayContract::ACTIVE];
}