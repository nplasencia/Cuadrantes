<?php

namespace Cuadrantes\Http\Controllers;

use Cuadrantes\Commons\OffWorkContract;
use Cuadrantes\Entities\OffWork;
use Cuadrantes\Repositories\DriverRepository;
use Cuadrantes\Repositories\OffWorkRepository;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class OffWorkController extends Controller
{
	protected $defaultPagination = 25;
	protected $iconClass = 'fa fa-user-times';
	protected $title = "Bajas";

	private $driverRepository;
	private $offWorkRepository;

	public function __construct(DriverRepository $driverRepository, OffWorkRepository $offWorkRepository)
	{
		$this->driverRepository  = $driverRepository;
		$this->offWorkRepository = $offWorkRepository;
	}

	protected function genericValidation(Request $request)
	{
		$this->validate($request, [
			OffWorkContract::DRIVER_ID => 'required|numeric',
			OffWorkContract::WHEN      => 'required|date_format:d/m/Y'
		]);
	}

	protected function getTableActionButtons(OffWork $offWork)
	{
		return '<div class="btn-group">
                    <div class="btn-group">
                        <div class="btn-group pull-right">
                            <a href="'.route('offWork.destroy', $offWork->id).'" data-toggle="tooltip" data-original-title="Eliminar" data-placement="bottom" class="btn btn-danger btn-xs btn-delete">
                                <i class="fa fa-remove"></i>
                            </a>
                        </div>
                    </div>
                </div>';
	}

	public function ajaxResume()
	{
		return Datatables::of($this->offWorkRepository->getAll())
						 ->editColumn('driverName', function (OffWork $offWork) {
							 return $offWork->driver->completeName;
						 })
						 ->editColumn('date', function (OffWork $offWork) {
						 	 return $offWork->dateFormatted;
						 })
		                 ->addColumn('actions', function (OffWork $offWork) {
			                 return $this->getTableActionButtons($offWork);
		                 })->make(true);
	}

	public function resume()
	{
		$offWorks = $this->offWorkRepository->getAllPaginated($this->defaultPagination);
		$drivers = $this->driverRepository->getAll();
		return view('pages.off_works.resume', ['title' => $this->title, 'iconClass' => $this->iconClass, 'offWorks' => $offWorks, 'drivers' => $drivers]);
	}

	public function store (Request $request)
	{
		$this->genericValidation($request);
		try {
			$offWork = $this->offWorkRepository->store($request);
			session()->flash('success', "Se ha añadido una baja para el conductor {$offWork->driver->completeName} correctamente");
			$driver = $offWork->driver;
			if ($driver->isOffWork($request->get('when'))) {
				dd("Correcto");
			}
		} catch (\PDOException $exception) {
			session()->flash('info', "Esta baja ya ha sido creada con anterioridad");

		} finally {
			return redirect()->back();
		}
	}

	public function destroy ($id)
	{
		$offWork = $this->offWorkRepository->forceDeleteById($id);
		session()->flash('success', "La baja para el día {$offWork->dateFormatted} del conductor {$offWork->driver->completeName} ha sido eliminada correctamente");
		return redirect()->back();
	}
}
