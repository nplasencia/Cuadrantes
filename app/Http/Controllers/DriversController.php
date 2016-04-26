<?php

namespace Cuadrantes\Http\Controllers;

use Cuadrantes\Entities\Driver;
use Cuadrantes\Entities\Weekday;
use Cuadrantes\Http\Requests;

class DriversController extends Controller
{
    public function getAll()
    {
        $drivers = Driver::orderBy('last_name', 'ASC')->orderBy('first_name', 'ASC')->paginate(20);
        $title = 'Conductores';
        $iconClass = 'fa fa-users';
        return view('pages.resume', compact('drivers', 'title', 'iconClass'));
    }

    public function details($id)
    {
        $driver = Driver::findOrFail($id);
        $weekdays = Weekday::all();
        $title = $driver->last_name.', '.$driver->first_name;
        $iconClass = 'fa fa-user';
        return view('pages.details', compact('driver', 'title', 'iconClass', 'weekdays'));
    }
}