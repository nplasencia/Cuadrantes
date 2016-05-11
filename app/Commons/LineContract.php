<?php

namespace Cuadrantes\Commons;

class LineContract extends CuadrantesContract {
    const
        TABLE_NAME = 'lines',
        NUMBER     = 'number',
        NAME       = 'name',
        ACTIVE     = 'active';

    public static $COLS = [LineContract::NUMBER, LineContract::NAME, LineContract::ACTIVE];
}