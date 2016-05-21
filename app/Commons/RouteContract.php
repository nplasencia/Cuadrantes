<?php

namespace Cuadrantes\Commons;

class RouteContract extends CuadrantesContract {
    const
        TABLE_NAME = 'routes',
        LINE_ID    = 'line_id',
        ORIGIN     = 'origin',
        DESTINY    = 'destiny',
        GO         = 'go',
        ACTIVE     = 'active';

    public static $COLS = [RouteContract::LINE_ID, RouteContract::ORIGIN, RouteContract::DESTINY, RouteContract::GO, RouteContract::ACTIVE];
}