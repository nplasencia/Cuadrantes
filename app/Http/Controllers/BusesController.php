<?php

namespace Cuadrantes\Http\Controllers;

use Cuadrantes\Repositories\BrandRepository;
use Cuadrantes\Repositories\BusRepository;
use Illuminate\Auth\Guard;
use Illuminate\Http\Request;

use Cuadrantes\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class BusesController extends Controller
{
    protected $defaultPagination = 25;
    protected $iconClass = 'fa fa-car';
    protected $title = "Guaguas";
    
    private $busRepository;
    private $brandRepository;

    public function __construct(BusRepository $busRepository, BrandRepository $brandRepository)
    {
        $this->busRepository = $busRepository;
        $this->brandRepository = $brandRepository;
    }

    protected function genericValidation(Request $request)
    {
        $this->validate($request, [
            'brand_id'     => 'required|numeric',
            'license'      => 'required|string',
            'seats'        => 'required|numeric',
            'stands'       => 'required|numeric',
            'registration' => 'required|date'
        ]);
    }

    private function resume($buses)
    {
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
        $brands = $this->brandRepository->getAll();
        return view('pages.buses.details', compact('brands', 'title', 'iconClass'));
    }

    public function all()
    {
        $buses = $this->busRepository->getAllPaginated($this->defaultPagination);
        return $this->resume($buses);

    }

    public function details($id)
    {
        $bus = $this->busRepository->findOrFail($id);
        $brands = $this->brandRepository->getAll();
        $title = $bus->brand->name.' - Matrícula: '.$bus->license;
        $iconClass = $this->iconClass;
        return view('pages.buses.details', compact('bus', 'brands', 'title', 'iconClass'));
    }

    public function store(Request $request)
    {
        $this->genericValidation($request);
        try {
            $bus = $this->busRepository->create($request->all());
            session()->flash('success', 'La guagua '.$bus->brand->name.' de matrícula '.$bus->license.' ha sido creada exitosamente');
            return Redirect::route('bus.details', $bus->id);
        } catch (\PDOException $exception) {
            session()->flash('info', 'La guagua de matrícula '.$request->get('license').' ha sido creada con anterioridad.');
            return $this->all();
        }
    }

    public function update(Request $request, $id)
    {
        $this->genericValidation($request);

        $bus = $this->busRepository->updateById($id, $request->get('license'), $request->get('brand_id'),
                                                $request->get('seats'), $request->get('stands'), $request->get('registration'));
        
        session()->flash('success', 'La guagua '.$bus->brand->name.' de matrícula '.$bus->license.' ha sido actualizada exitosamente');
        return Redirect::route('bus.details', $bus->id);
    }

    public function destroy($id, Guard $auth, Request $request)
    {
        $bus = $this->busRepository->deleteById($id);

        $successMsg = 'La guagua '.$bus->brand->name.' de matrícula '.$bus->license.' ha sido eliminada exitosamente';
        session()->flash('success', $successMsg);
        return $this->all();
    }

    public function search(Request $request)
    {
        if ($request->get('item') != '') {
            $buses = $this->busRepository->searchByLicensePaginated($request->get('item'), $this->defaultPagination);

            if (sizeof($buses) != 0) {
                return $this->resume($buses);
            }
            session()->flash('info', 'No se han encontrado guaguas que sigan este criterio de búsqueda');
        }
        return $this->all();

    }
}