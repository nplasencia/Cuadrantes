<?php

namespace Cuadrantes\Http\Controllers;

use Illuminate\Http\Request;

use Cuadrantes\Http\Requests;
use Cuadrantes\Http\Controllers\Controller;

class DriversController extends Controller
{
    public function getAll()
    {
        return view('pages.resume');
    }

    public function details($id)
    {
        dd('Obteniendo detalles del id '.$id);
    }
}
