<?php

namespace Cuadrantes\Commons;

class TimetableContract extends CuadrantesContract {
    const
        TABLE_NAME = 'timetables',
        ROUTE_ID   = 'route_id',
        PERIOD_ID  = 'period_id',
        TIME       = 'time',
        BY         = 'by',
        PASS       = 'pass', //Lo utilizamos para indicar que es un horario de paso
        ACTIVE     = 'active';

    public static $COLS = [TimetableContract::ROUTE_ID, TimetableContract::PERIOD_ID, TimetableContract::TIME,
                           TimetableContract::BY,       TimetableContract:: PASS,     TimetableContract::ACTIVE];
}