<?php

namespace Cuadrantes\Commons;

class TimetableContract extends CuadrantesContract {
    const
        TABLE_NAME = 'timetables',
        LINE_ID    = 'line_id',
        PERIOD_ID  = 'period_id',
        TIME       = 'time',
        DESTINY    = 'destiny',
        ACTIVE     = 'active';

    public static $COLS = [TimetableContract::LINE_ID, TimetableContract::PERIOD_ID, TimetableContract::TIME, TimetableContract::DESTINY, TimetableContract::ACTIVE];
}