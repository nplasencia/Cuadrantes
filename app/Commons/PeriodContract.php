<?php

namespace Cuadrantes\Commons;

class PeriodContract extends CuadrantesContract {
    const
        TABLE_NAME = 'periods',
        CODE       = 'code',
        VALUE      = 'value';

    public static $COLS = [PeriodContract::CODE, PeriodContract::VALUE];
}