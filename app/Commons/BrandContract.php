<?php

namespace Cuadrantes\Commons;

class BrandContract extends CuadrantesContract {
    const
        TABLE_NAME = 'brands',
        NAME       = 'name';

    public static $COLS = [BrandContract::NAME];
}