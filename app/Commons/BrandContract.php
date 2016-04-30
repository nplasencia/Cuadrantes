<?php

namespace Cuadrantes\Commons;

class BusContract {
    const
        TABLE_NAME          = 'buses',
        COLUMN_ID           = 'id',
        COLUMN_BRAND_ID     = 'brand_id',
        COLUMN_LICENSE      = 'license',
        COLUMN_SEATS        = 'seats',
        COLUMN_STANDS       = 'stands',
        COLUMN_REGISTRATION = 'registration',
        COLUMN_ACTIVE       = 'active';

    public static $COLS = [BusContract::COLUMN_ID,     BusContract::COLUMN_BRAND_ID,     BusContract::COLUMN_LICENSE, BusContract::COLUMN_SEATS,
                           BusContract::COLUMN_STANDS, BusContract::COLUMN_REGISTRATION, BusContract::COLUMN_ACTIVE];
}