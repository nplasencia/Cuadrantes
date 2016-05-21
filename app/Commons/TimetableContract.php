<?php

namespace Cuadrantes\Commons;

class TimetableContract extends CuadrantesContract {
    const
        TABLE_NAME = 'timetables',
        ROUTE_ID   = 'route_id',
        PERIOD_ID  = 'period_id',
        TIME       = 'time',
        BY         = 'by',
        ACTIVE     = 'active';

    public static $COLS = [TimetableContract::ROUTE_ID, TimetableContract::PERIOD_ID, TimetableContract::TIME, TimetableContract::BY, TimetableContract::ACTIVE];
}