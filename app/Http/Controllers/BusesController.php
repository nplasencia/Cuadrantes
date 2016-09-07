<?php

namespace Cuadrantes\Http\Controllers;

use Cuadrantes\Entities\Bus;
use Cuadrantes\Repositories\BrandRepository;
use Cuadrantes\Repositories\BusRepository;
use Cuadrantes\Commons\BusContract;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Yajra\Datatables\Datatables;

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
            BusContract::BRAND_ID     => 'required|numeric',
            BusContract::LICENSE      => 'required|string',
            BusContract::SEATS        => 'required|numeric',
            BusContract::STANDS       => 'required|numeric',
            BusContract::REGISTRATION => 'required|date_format:d/m/Y'
        ]);
    }

    protected function getTableActionButtons(Bus $bus)
    {
        return '<div class="btn-group">
                    <div class="btn-group pull-right">
                            <a href="'.route('bus.details', $bus->id).'" data-toggle="tooltip" data-original-title="Editar" data-placement="bottom" class="btn btn-success btn-xs">
                                <i class="fa fa-edit"></i>
                            </a>
                        </div>
                    </div>
                    <div class="btn-group">
                        <div class="btn-group pull-right">
                            <a href="'.route('bus.destroy', $bus->id).'" data-toggle="tooltip" data-original-title="Eliminar" data-placement="bottom" class="btn btn-danger btn-xs btn-delete">
                                <i class="fa fa-trash-o"></i>
                            </a>
                        </div>
                    </div>
                </div>';
    }

    public function ajaxResume()
    {
        return Datatables::of($this->busRepository->getAll())
            ->addColumn('total', function(Bus $bus){
                return $bus->totalSeats;
            })
            ->editColumn('registration', function (Bus $bus){
                return $bus->registrationFormatted;
            })
            ->addColumn('actions', function (Bus $bus) {
                return $this->getTableActionButtons($bus);
            })
            ->make(true);
    }

    public function resume()
    {
	    $buses = $this->busRepository->getAllPaginated($this->defaultPagination);
        return view('pages.buses.resume', ['title' => $this->title, 'iconClass' => $this->iconClass, 'buses' => $buses]);
    }

    public function create()
    {
        $title = 'Nueva guagua';
        $brands = $this->brandRepository->getAll();
        return view('pages.buses.details', ['brands' => $brands, 'title' => $title, 'iconClass' => $this->iconClass]);
    }

    public function details($id)
    {
        $bus = $this->busRepository->findOrFail($id);
        $brands = $this->brandRepository->getAll();
        return view('pages.buses.details', ['bus' => $bus, 'brands' => $brands, 'title' => $bus->nameLicense, 'iconClass' => $this->iconClass]);
    }

    public function store(Request $request)
    {
        $this->genericValidation($request);
        try {
            $bus = $this->busRepository->insert($request);
            session()->flash('success', "La guagua {$bus->nameLicense} ha sido creada exitosamente");
            return Redirect::route('bus.details', $bus->id);
        } catch (\PDOException $exception) {
            session()->flash('info', "La guagua de matrícula {$request->get(BusContract::LICENSE)} ha sido creada con anterioridad.");
            return $this->resume();
        }
    }

    public function update(Request $request, $id)
    {
        $this->genericValidation($request);
        $bus = $this->busRepository->updateById($id, $request);
        session()->flash('success', "La guagua {$bus->nameLicense} ha sido actualizada exitosamente");
        return Redirect::route('bus.details', $bus->id);
    }

    public function destroy($id)
    {
        $bus = $this->busRepository->deleteById($id);
        session()->flash('success', "La guagua {$bus->nameLicense} ha sido eliminada exitosamente");
        return $this->resume();
    }
}