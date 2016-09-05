<?php

return array (

    'items' => array (
        'Principal'   => array('link' => 'driver.resume', 'icon' => 'fa fa-dashboard', 'subMenu' => []),
        'Conductores' => array('link' => 'driver.resume', 'icon' => 'fa fa-user',      'subMenu' => []),
        'Parejas'     => array('link' => 'pairs.resume',  'icon' => 'fa fa-users',     'subMenu' => []),
        'Guaguas'     => array('link' => 'bus.resume',    'icon' => 'fa fa-car',       'subMenu' => []),
        'Líneas'      => array('link' => 'line.resume',   'icon' => 'fa fa-bus',       'subMenu' => []),
        'Servicios'   => array('link' => null,            'icon' => 'fa fa-tasks',     'subMenu' => [
            'Laborales'    => '/services/1',
            'Sábados'      => '/services/2',
            'Dom/Festivos' => '/services/3',
        ]),
        'Cuadrantes'  => array('link' => 'cuadrantes.resume', 'icon' => 'fa fa-braille', 'subMenu' => []),
    )
);