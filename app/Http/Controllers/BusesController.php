<?php

namespace Cuadrantes\Http\Controllers;

use Cuadrantes\Commons\BrandContract;
use Cuadrantes\Commons\BusContract;
use Cuadrantes\Entities\Bus;
use Cuadrantes\Entities\Brand;
use Illuminate\Http\Request;

use Cuadrantes\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class BusesController extends Controller
{
    protected $defaultPagination = 25;
    protected $iconClass = 'fa fa-car';
    protected $title = "Guaguas";

    protected function genericValidation(Request $request) {
        $this->validate($request, [
            'brand_id'     => 'required|numeric',
            'license'      => 'required|string',
            'seats'        => 'required|numeric',
            'stands'       => 'required|numeric',
            'registration' => 'required|date'
        ]);
    }

    private function resume($buses) {
        $title = $this->title;
        $iconClass = $this->iconClass;
        $paginationClass = $buses;
        $searchRoute = 'bus.search';
        return view('pages.buses.resume', compact('buses', 'title', 'iconClass', 'searchRoute', 'paginationClass'));
    }

    public function create()
    {
        $title = 'Nueva guagua';
        $iconClass = $this->iconClass;
        $brands = Brand::orderBy(BrandContract::NAME)->get();
        return view('pages.buses.details', compact('brands', 'title', 'iconClass'));
    }

    public function all()
    {
        $buses = Bus::orderBy(BusContract::LICENSE, 'ASC')->with('brand')->paginate($this->defaultPagination);
        return $this->resume($buses);

    }

    public function details($id)
    {
        $bus = Bus::findOrFail($id);
        $brands = Brand::orderBy(BrandContract::NAME)->get();
        $title = $bus->brand->name.' - Matrícula: '.$bus->license;
        $iconClass = $this->iconClass;
        return view('pages.buses.details', compact('bus', 'brands', 'title', 'iconClass'));
    }

    public function store(Request $request)
    {
        $this->genericValidation($request);
        $bus = new Bus($request->all());
        $bus->save();

        session()->flash('success', 'La guagua '.$bus->brand->name.' de matrícula '.$bus->license.' ha sido creada exitosamente');

        return Redirect::route('bus.details', $bus->id);
    }

    public function update(Request $request, $id)
    {
        $this->genericValidation($request);

        $bus = Bus::findOrFail($id);
        $bus->license      = $request->get('license');
        $bus->brand_id     = $request->get('brand_id');
        $bus->seats        = $request->get('seats');
        $bus->stands       = $request->get('stands');
        $bus->registration = $request->get('registration');
        $bus->active       = true;
        $bus->save();

        session()->flash('success', 'La guagua '.$bus->brand->name.' de matrícula '.$bus->license.' ha sido actualizada exitosamente');
        return Redirect::route('bus.details', $bus->id);
    }

    public function destroy($id)
    {
        $bus = Bus::findOrFail($id);
        $bus->delete();
        session()->flash('success', 'La guagua '.$bus->brand->name.' de matrícula '.$bus->license.' ha sido eliminada exitosamente');
        return $this->all();
    }

    public function search(Request $request)
    {
        if ($request->get('item') != '') {
            $buses = Bus::where(BusContract::LICENSE, 'LIKE', '%'.$request->get('item').'%')
                          ->orderBy(BusContract::LICENSE, 'ASC')
                          ->paginate($this->defaultPagination);

            if (sizeof($buses) != 0) {
                return $this->resume($buses);
            }
            session()->flash('info', 'No se han encontrado guaguas que sigan este criterio de búsqueda');
        }
        return $this->all();

    }
}