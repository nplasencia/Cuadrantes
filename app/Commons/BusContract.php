<?php

namespace Cuadrantes\Commons;

class BusContract extends CuadrantesContract{
    const
        TABLE_NAME   = 'buses',
        BRAND_ID     = 'brand_id',
        LICENSE      = 'license',
        SEATS        = 'seats',
        STANDS       = 'stands',
        REGISTRATION = 'registration',
        ACTIVE       = 'active';

    public static $COLS = [BusContract::BRAND_ID, BusContract::LICENSE,      BusContract::SEATS,
                           BusContract::STANDS,   BusContract::REGISTRATION, BusContract::ACTIVE];
}