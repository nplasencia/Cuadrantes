<?php

namespace Cuadrantes\Http\Controllers;

use Carbon\Carbon;
use Cuadrantes\Repositories\CuadranteRepository;
use Cuadrantes\Repositories\DriverRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class CuadrantesViewController extends Controller
{
	protected $defaultPagination = 25;
	protected $iconClass = 'fa fa-braille';
	protected $title = 'Cuadrantes';

	private $cuadranteRepository;
	private $driverRepository;

	protected function genericValidation(Request $request) {
		$this->validate($request, [
			'date' => 'required|date_format:d/m/Y'
		]);
	}

	public function __construct(CuadranteRepository $cuadranteRepository, DriverRepository $driverRepository)
	{
		$this->cuadranteRepository = $cuadranteRepository;
		$this->driverRepository = $driverRepository;
	}

	private function resume(Collection $cuadrantes, Carbon $date = null)
	{
		if (!isset($date)){ $date = Carbon::create();}
		$cuadrantes = $cuadrantes->sortBy(function ($item) {
			return $item->service->number;
		});

		$restingDrivers = $this->driverRepository->getRestingDriversByDate($date);
		$holidaysDrivers = $this->driverRepository->getHolidaysDriversByDate($date);
		$downDrivers = new Collection();
		$title = $this->title;
		$iconClass = $this->iconClass;
		return view('pages.cuadrantes.resume', compact('title', 'iconClass', 'cuadrantes', 'restingDrivers', 'holidaysDrivers', 'downDrivers', 'date'));
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
}
