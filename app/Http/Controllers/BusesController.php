<?php

namespace Cuadrantes\Http\Controllers;

use Cuadrantes\Entities\Bus;
use Cuadrantes\Entities\BusBrand;
use Illuminate\Http\Request;

use Cuadrantes\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class BusesController extends Controller
{
    public function create()
    {
        $title = 'Nueva guagua';
        $iconClass = 'fa fa-car';
        $busBrands = BusBrand::orderBy('name')->get();
        return view('pages.buses.create', compact('title', 'iconClass', 'busBrands'));
    }

    public function all()
    {
        $buses = Bus::orderBy('license', 'ASC')->paginate(20);
        $title = 'Guaguas';
        $iconClass = 'fa fa-car';
        return view('pages.buses.resume', compact('buses', 'title', 'iconClass'));
    }

    public function details($id)
    {
        $bus = Bus::findOrFail($id);
        $busBrands = BusBrand::orderBy('name')->get();
        $title = $bus->brand.' - Matrícula: '.$bus->license;
        $iconClass = 'fa fa-car';
        return view('pages.buses.details', compact('bus', 'title', 'iconClass', 'busBrands'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'busLicense'   => 'required|string',
            'brand'        => 'required|string',
            'seats'        => 'required|digits_between:0,100',
            'stands'       => 'required|digits_between:0,100',
            'registration' => 'required|date'
        ]);

        $bus = new Bus();
        $bus->license      = $request->get('busLicense');
        $bus->brand        = $request->get('brand');
        $bus->seats        = $request->get('seats');
        $bus->stands       = $request->get('stands');
        $bus->registration = $request->get('registration');
        $bus->active       = true;
        $bus->save();

        session()->flash('success', 'La guagua '.$bus->brand.' de matrícula '.$bus->license.' ha sido creada exitosamente');

        return Redirect::route('bus.details', $bus->id);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'busLicense'   => 'required|string',
            'brand'        => 'required|string',
            'seats'        => 'required|digits_between:0,100',
            'stands'       => 'required|digits_between:0,100',
            'registration' => 'required|date'
        ]);

        $bus = Bus::findOrFail($id);
        $bus->license      = $request->get('busLicense');
        $bus->brand        = $request->get('brand');
        $bus->seats        = $request->get('seats');
        $bus->stands       = $request->get('stands');
        $bus->registration = $request->get('registration');
        $bus->active       = true;
        $bus->save();

        session()->flash('success', 'La guagua '.$bus->brand.' de matrícula '.$bus->license.' ha sido actualizada exitosamente');
        return Redirect::route('bus.details', $bus->id);
    }

    public function destroy($id)
    {
        $bus = Bus::findOrFail($id);
        $bus->delete();
        session()->flash('success', 'La guagua '.$bus->brand.' de matrícula '.$bus->license.' ha sido eliminada exitosamente');
        return Redirect::back();
    }
}
