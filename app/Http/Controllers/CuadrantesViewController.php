<?php

namespace Cuadrantes\Http\Controllers;

use Carbon\Carbon;
use Cuadrantes\Repositories\BusRepository;
use Cuadrantes\Repositories\CuadranteRepository;
use Cuadrantes\Repositories\DriverRepository;
use Cuadrantes\Repositories\OffWorkRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class CuadrantesViewController extends Controller
{
	protected $defaultPagination = 25;
	protected $iconClass = 'fa fa-braille';
	protected $title = 'Cuadrantes';

	private $cuadranteRepository;
	private $driverRepository;
	private $offWorkRepository;
	private $busRepository;

	protected function genericValidation(Request $request) {
		$this->validate($request, [
			'date' => 'required|date_format:d/m/Y'
		]);
	}

	public function __construct(CuadranteRepository $cuadranteRepository, DriverRepository $driverRepository, OffWorkRepository $offWorkRepository, BusRepository $busRepository)
	{
		$this->cuadranteRepository = $cuadranteRepository;
		$this->driverRepository    = $driverRepository;
		$this->offWorkRepository   = $offWorkRepository;
		$this->busRepository       = $busRepository;
	}

	private function resume(Collection $cuadrantes, Carbon $date = null)
	{
		if (!isset($date)){ $date = Carbon::create();}
		$cuadrantes = $cuadrantes->sortBy(function ($item) {
			return $item->service->number;
		});

		$buses = $this->busRepository->getAll();
		$drivers = $this->driverRepository->getAll();
		$restingDrivers = $this->driverRepository->getRestingDriversByDate($date);
		$holidaysDrivers = $this->driverRepository->getHolidaysDriversByDate($date);
		$offWorkDrivers = $this->offWorkRepository->getDriversByDate($date);
		$downDrivers = new Collection();
		$title = $this->title;
		$iconClass = $this->iconClass;
		return view('pages.cuadrantes.resume', compact('title', 'iconClass', 'buses', 'drivers', 'cuadrantes', 'restingDrivers', 'holidaysDrivers', 'downDrivers', 'date', 'offWorkDrivers'));
	}

	public function allToday()
	{
		$cuadrantes = $this->cuadranteRepository->getAllByDate();
		return $this->resume($cuadrantes);
	}

	public function all(Request $request)
	{
		$this->genericValidation($request);
		$date = Carbon::createFromFormat('d/m/Y', $request->get('date'))->setTime(0, 0, 0);
		$cuadrantes = $this->cuadranteRepository->getAllByDate($date);
		return $this->resume($cuadrantes, $date);
	}

	public function update(Request $request)
	{
		$driversCuadrantes = explode(",", $request->get('selectedDrivers'));
		$busesCuadrantes = explode(",", $request->get('selectedBuses'));
		$date = Carbon::createFromFormat('d/m/Y', $request->get('date'))->setTime(0, 0, 0);

		foreach ($busesCuadrantes as $serviceId => $busId) {
			if (!empty($serviceId)) {
				$cuadrante         = $this->cuadranteRepository->getByDateServiceId( $date, $serviceId );
				if (empty($busId)) {
					$cuadrante->bus_id = NULL;
				} else {
					$cuadrante->bus_id = $busId;
				}

				$cuadrante->save();
			}
		}

		/*foreach ($driversCuadrantes as $serviceId => $driverId) {
			if (!empty($serviceId)) {
				$cuadrante            = $this->cuadranteRepository->getByDateServiceId( $date, $serviceId );
				if (empty($driverId)) {
					$cuadrante->driver_id = NULL;
				} else {
					$cuadrante->driver_id = $driverId;
				}
				$cuadrante->save();
			}
		}*/

		return back();
	}
}
