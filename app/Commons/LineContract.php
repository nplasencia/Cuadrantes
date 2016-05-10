<?php

namespace Cuadrantes\Commons;

class LineContract extends CuadrantesContract {
    const
        TABLE_NAME = 'lines',
        NUMBER     = 'number',
        NAME       = 'name';

    public static $COLS = [LineContract::NUMBER, LineContract::NAME];
}