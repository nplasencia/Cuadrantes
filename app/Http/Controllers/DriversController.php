<?php

namespace Cuadrantes\Http\Controllers;

use Cuadrantes\Entities\Driver;
use Cuadrantes\Entities\DriverRestDay;
use Cuadrantes\Entities\Weekday;
use Illuminate\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DriversController extends Controller
{
    protected $defaultPagination = 25;
    protected $iconClass = 'fa fa-users';
    protected $title = "Conductores";

    protected function genericValidation(Request $request) {
        $this->validate($request, [
            'lastName'  => 'required|max:250|string',
            'firstName' => 'required|max:250|string',
            'dni'       => 'required|string',
            'telephone' => 'required|digits:9',
            'extension' => 'required|digits_between:0,9999',
            'email'     => 'required|email',
            'cap'       => 'required|date',
            'license'   => 'required|date'
        ]);
    }

    private function resume($drivers) {
        $title = $this->title;
        $iconClass = $this->iconClass;
        return view('pages.drivers.resume', compact('drivers', 'title', 'iconClass'));
    }

    public function create()
    {
        $title = 'Nuevo conductor';
        $iconClass = $this->iconClass;
        $weekdays = Weekday::all();
        return view('pages.drivers.create', compact('weekdays', 'title', 'iconClass'));
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

        $driver = new Driver();
        $driver->last_name         = $request->get('lastName');
        $driver->first_name        = $request->get('firstName');
        $driver->dni               = $request->get('dni');
        $driver->telephone         = $request->get('telephone');
        $driver->extension         = $request->get('extension');
        $driver->email             = $request->get('email');
        $driver->cap               = $request->get('cap');
        $driver->driver_expiration = $request->get('license');
        $driver->active            = true;
        $driver->save();

        foreach ($request->get('restDays') as $weekday_id) {
            $driverRestDay = new DriverRestDay();
            $driverRestDay->driver_id = $driver->id;
            $driverRestDay->weekday_id = $weekday_id;
            $driverRestDay->active = true;
            $driverRestDay->save();
        }
        session()->flash('success', 'El conductor '.$driver->first_name.' '.$driver->last_name.' ha sido guardado exitosamente');
        return Redirect::route('driver.details', $driver->id);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'lastName'  => 'required|max:250|string',
            'firstName' => 'required|max:250|string',
            'dni'       => 'required',
            'telephone' => 'required|digits:9',
            'extension' => 'required|digits_between:0,9999',
            'email'     => 'required|email',
            'cap'       => 'required|date',
            'license'   => 'required|date'
        ]);

        $driver = Driver::findOrFail($id);
        $driver->last_name         = $request->get('lastName');
        $driver->first_name        = $request->get('firstName');
        $driver->dni               = $request->get('dni');
        $driver->telephone         = $request->get('telephone');
        $driver->extension         = $request->get('extension');
        $driver->email             = $request->get('email');
        $driver->cap               = $request->get('cap');
        $driver->driver_expiration = $request->get('license');
        $driver->active            = true;
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
                $driverRestDay->active = true;
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
        return Redirect::back();
    }
}