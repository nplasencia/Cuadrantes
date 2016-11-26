<?php

return array (

    'items' => array (
        'Principal'   => array('link' => 'driver.resume',  'icon' => 'fa fa-dashboard',  'subMenu' => []),
        'Conductores' => array('link' => 'driver.resume',  'icon' => 'fa fa-user',       'subMenu' => []),
        'Bajas'       => array('link' => 'offWork.resume', 'icon' => 'fa fa-user-times', 'subMenu' => []),
        'Parejas'     => array('link' => 'pair.resume',    'icon' => 'fa fa-users',      'subMenu' => []),
        'Guaguas'     => array('link' => 'bus.resume',     'icon' => 'fa fa-car',        'subMenu' => []),
        'Festivos'    => array('link' => 'festive.resume', 'icon' => 'fa fa-calendar',   'subMenu' => []),
        'Líneas'      => array('link' => 'line.resume',    'icon' => 'fa fa-bus',        'subMenu' => []),
        'Servicios'   => array('link' => null,             'icon' => 'fa fa-tasks',      'subMenu' => [
            'Laborales' => '/services/1',
            'Sábados'   => '/services/2',
            'Domingos'  => '/services/3',
            'Festivos'  => '/services/4',
        ]),
        'Cuadrantes'  => array('link' => 'cuadrantes.resume', 'icon' => 'fa fa-braille', 'subMenu' => []),
    )
);