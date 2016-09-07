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
            'brand_id'     => 'required|numeric',
            'license'      => 'required|string',
            'seats'        => 'required|numeric',
            'stands'       => 'required|numeric',
            'registration' => 'required|date_format:d/m/Y'
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
                return with($bus->seats + $bus->stands);
            })
            ->editColumn('registration', function (Bus $bus){
                return with(new Carbon($bus->registration))->format('d-m-Y');
            })
            ->addColumn('actions', function (Bus $bus) {
                return $this->getTableActionButtons($bus);
            })
            ->make(true);
    }

    private function resume($buses)
    {
        $title = $this->title;
        $iconClass = $this->iconClass;
        return view('pages.buses.resume', compact('title', 'iconClass', 'buses'));
    }

    public function all()
    {
        $buses = $this->busRepository->getAllPaginated($this->defaultPagination);
        return $this->resume($buses);
    }

    public function create()
    {
        $title = 'Nueva guagua';
        $iconClass = $this->iconClass;
        $brands = $this->brandRepository->getAll();
        return view('pages.buses.details', compact('brands', 'title', 'iconClass'));
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
            $bus = $this->busRepository->insert($request);
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
		$registration = Carbon::createFromFormat('d/m/Y', $request->get(BusContract::REGISTRATION))->format('Y-m-d');
        $bus = $this->busRepository->updateById($id, $request->get('license'), $request->get('brand_id'),
                                                $request->get('seats'), $request->get('stands'), $registration);
        
        session()->flash('success', 'La guagua '.$bus->brand->name.' de matrícula '.$bus->license.' ha sido actualizada exitosamente');
        return Redirect::route('bus.details', $bus->id);
    }

    public function destroy($id)
    {
        $bus = $this->busRepository->deleteById($id);

        $successMsg = 'La guagua '.$bus->brand->name.' de matrícula '.$bus->license.' ha sido eliminada exitosamente';
        session()->flash('success', $successMsg);
        return $this->all();
    }
}