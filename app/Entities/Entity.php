<?php
/**
 * Created by PhpStorm.
 * User: auret
 * Date: 26/4/16
 * Time: 18:44
 */

namespace Cuadrantes\Entities;


use Illuminate\Database\Eloquent\Model;

class Entity extends Model {

    /**
     * Método utilizado por las entities para traer su clase. Sólo es necesario si nuestra versión de PHP es menor a la
     * 5.9.
     *
     * @return mixed
     */
    public static function getClass()
    {
        return get_class(new static);
    }
}