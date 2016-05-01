<?php

namespace Cuadrantes\Commons;

class DriverContract extends CuadrantesContract {
    const
        TABLE_NAME = 'drivers',
        FIRST_NAME = 'first_name',
        LAST_NAME  = 'last_name',
        DNI        = 'dni',
        TELEPHONE  = 'telephone',
        EXTENSION  = 'extension',
        EMAIL      = 'email',
        CAP        = 'cap',
        EXPIRATION = 'driver_expiration',
        ACTIVE     = 'active';

    public static $COLS = [DriverContract::FIRST_NAME, DriverContract::LAST_NAME, DriverContract::DNI, DriverContract::TELEPHONE,
                           DriverContract::EXTENSION,  DriverContract::EMAIL,     DriverContract::CAP, DriverContract::EXPIRATION,
                           DriverContract::ACTIVE];
}