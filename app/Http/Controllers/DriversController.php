<?php

namespace Cuadrantes\Http\Controllers;

use Cuadrantes\Commons\DriverContract;
use Cuadrantes\Entities\Driver;
use Cuadrantes\Entities\DriverRestDay;
use Cuadrantes\Entities\Weekday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DriversController extends Controller
{
    protected $defaultPagination = 25;
    protected $iconClass = 'fa fa-users';
    protected $title = "Conductores";

    protected function genericValidation(Request $request) {
        $this->validate($request, [
            'last_name'         => 'required|max:250|string',
            'first_name'        => 'required|max:250|string',
            'dni'               => 'required|string',
            'telephone'         => 'required|digits:9',
            'extension'         => 'required|digits_between:0,9999',
            'email'             => 'required|email',
            'cap'               => 'required|date',
            'driver_expiration' => 'required|date'
        ]);
    }

    private function resume($drivers) {
        $title = $this->title;
        $iconClass = $this->iconClass;
        $paginationClass = $drivers;
        $searchRoute = 'driver.search';
        return view('pages.drivers.resume', compact('drivers', 'title', 'iconClass', 'searchRoute', 'paginationClass'));
    }

    public function create()
    {
        $title = 'Nuevo conductor';
        $iconClass = $this->iconClass;
        $weekdays = Weekday::all();
        return view('pages.drivers.details', compact('weekdays', 'title', 'iconClass'));
    }

    public function all()
    {
        $drivers = Driver::orderBy('last_name', 'ASC')->orderBy('first_name', 'ASC')->paginate($this->defaultPagination);
        return $this->resume($drivers);
    }

    public function details($id)
    {
        $driver = Driver::findOrFail($id);
        $weekdays = Weekday::all();
        $title = $driver->last_name . ', ' . $driver->first_name;
        $iconClass = 'fa fa-user';
        return view('pages.drivers.details', compact('driver', 'weekdays', 'title', 'iconClass'));
    }

    public function store(Request $request)
    {
        $this->genericValidation($request);

        $driver = new Driver($request->all(), true);
        $driver->save();

        if ($request->get('restDays') !== null) {
            foreach ($request->get('restDays') as $weekday_id) {
                $driverRestDay = new DriverRestDay();
                $driverRestDay->driver_id  = $driver->id;
                $driverRestDay->weekday_id = $weekday_id;
                $driverRestDay->save();
            }
        }
        session()->flash('success', 'El conductor '.$driver->first_name.' '.$driver->last_name.' ha sido guardado exitosamente');
        return Redirect::route('driver.details', $driver->id);
    }

    public function update(Request $request, $id)
    {
        $this->genericValidation($request);

        $driver = Driver::findOrFail($id);
        $driver->last_name         = $request->get('last_name');
        $driver->first_name        = $request->get('first_name');
        $driver->dni               = $request->get('dni');
        $driver->telephone         = $request->get('telephone');
        $driver->extension         = $request->get('extension');
        $driver->email             = $request->get('email');
        $driver->cap               = $request->get('cap');
        $driver->driver_expiration = $request->get('driver_expiration');
        $driver->save();
        
        $driverRestDays = DriverRestDay::where('driver_id', $driver->id)->get();
        foreach ($driverRestDays as $driverRestDay) {
            $driverRestDay->delete();
        }

        //TODO: Probar método implementado en Driver
        $restdays = $request->get('restDays');
        if ($restdays != null) {
            foreach ($restdays as $weekday_id) {
                $driverRestDay = new DriverRestDay();
                $driverRestDay->driver_id = $driver->id;
                $driverRestDay->weekday_id = $weekday_id;
                $driverRestDay->save();
            }
        }
        session()->flash('success', 'El conductor '.$driver->first_name.' '.$driver->last_name.' ha sido actualizado exitosamente');
        return Redirect::route('driver.details', $driver->id);
    }

    public function destroy($id)
    {
        $driver = Driver::findOrFail($id);
        $driver->delete();

        session()->flash('success', 'El conductor '.$driver->first_name.' '.$driver->last_name.' ha sido eliminado exitosamente');
        return $this->all();
    }

    public function search(Request $request)
    {
        if ($request->get('item') != '') {
            $buses = Driver::where(DriverContract::FIRST_NAME,    'LIKE', '%'.$request->get('item').'%')
                             ->orWhere(DriverContract::LAST_NAME, 'LIKE', '%'.$request->get('item').'%')
                             ->orWhere(DriverContract::DNI,       'LIKE', '%'.$request->get('item').'%')
                             ->orWhere(DriverContract::EMAIL,     'LIKE', '%'.$request->get('item').'%')
                             ->orderBy('last_name', 'ASC')->orderBy('first_name', 'ASC')
                             ->paginate($this->defaultPagination);

            if (sizeof($buses) != 0) {
                return $this->resume($buses);
            }
            session()->flash('info', 'No se han encontrado conductores que sigan este criterio de búsqueda');
        }
        return $this->all();

    }
}