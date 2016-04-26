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

    public static function getClass()
    {
        return get_class(new static);
    }
}