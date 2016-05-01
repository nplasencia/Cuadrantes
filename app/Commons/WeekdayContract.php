<?php

namespace Cuadrantes\Commons;

class WeekdayContract extends CuadrantesContract {
    const
        TABLE_NAME = 'weekdays',
        CODE       = 'code',
        VALUE      = 'value';

    public static $COLS = [WeekdayContract::CODE, WeekdayContract::VALUE];
}