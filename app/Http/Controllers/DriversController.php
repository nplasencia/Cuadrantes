<?php

namespace Cuadrantes\Http\Controllers;

use Carbon\Carbon;
use Cuadrantes\Commons\DriverContract;
use Cuadrantes\Commons\Globals;
use Cuadrantes\Entities\Driver;
use Cuadrantes\Entities\DriverHoliday;
use Cuadrantes\Entities\DriverRestDay;
use Cuadrantes\Entities\Weekday;
use Cuadrantes\Repositories\DriverHolidayRepository;
use Cuadrantes\Repositories\DriverRepository;
use Cuadrantes\Repositories\PairRepository;
use Cuadrantes\Repositories\WeekdayRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\Datatables\Datatables;

class DriversController extends Controller {
	protected $defaultPagination = 25;
	protected $iconClass = 'fa fa-user';
	protected $title = "Conductores";

	private $driverRepository;
	private $holidayRepository;
	private $pairRepository;
	private $weekdayRepository;

	public function __construct( DriverRepository $driverRepository, DriverHolidayRepository $holidayRepository, WeekdayRepository $weekdayRepository, PairRepository $pairRepository ) {
		$this->driverRepository  = $driverRepository;
		$this->holidayRepository = $holidayRepository;
		$this->pairRepository    = $pairRepository;
		$this->weekdayRepository = $weekdayRepository;
	}

	protected function genericValidation( Request $request ) {
		$this->validate( $request, [
			DriverContract::LAST_NAME  => 'required|max:250|string',
			DriverContract::FIRST_NAME => 'required|max:250|string',
			//DriverContract::DNI        => 'required|string',
			DriverContract::TELEPHONE  => 'required|digits:9',
			DriverContract::EXTENSION  => 'required|digits_between:0,9999',
			//DriverContract::EMAIL      => 'required|email',
			DriverContract::CAP        => 'required|date_format:d/m/Y',
			DriverContract::EXPIRATION => 'required|date_format:d/m/Y'
		] );
	}

	protected function getTableActionButtons( Driver $driver ) {
		return '<div class="btn-group">
                    <a href="' . route( 'driver.details', $driver->id ) . '" data-toggle="tooltip" data-original-title="Editar" data-placement="bottom" class="btn btn-success btn-xs">
                        <i class="fa fa-edit"></i>
                    </a>
                </div>
                <div class="btn-group">
                    <a href="' . route( 'driver.destroy', $driver->id ) . '" data-toggle="tooltip" data-original-title="Eliminar" data-placement="bottom" class="btn btn-danger btn-xs btn-delete">
                        <i class="fa fa-trash-o"></i>
                    </a>
                </div>';
	}

	public function ajaxResume() {
		return Datatables::of( $this->driverRepository->getAll() )
						->editColumn( 'cap', function ( Driver $driver ) {
							if ( isset( $driver->cap ) ) {
								return $driver->capFormatted;
							} else {
								return "";
							}
						} )
						->editColumn( 'driver_expiration', function ( Driver $driver ) {
							if ( isset( $driver->driver_expiration ) ) {
								return $driver->expirationFormatted;
							} else {
								return "";
							}
						} )
						->addColumn( 'actions', function ( Driver $driver ) {
							return $this->getTableActionButtons( $driver );
						} )
						->make( true );
	}

	public function resume()
	{
		$drivers = $this->driverRepository->getAll();
		$problemDrivers = new Collection();
		foreach ($drivers as $driver) {
			if (!$driver->isRestDaysAssigned() || !$driver->isHolidaysAssigned()) {
				$problemDrivers->add($driver->formalCompleteName);
			}
		}
		if ($problemDrivers->count() > 0 ) {
			session()->flash( 'info', "Revisar a los siguientes conductores:" );
			session()->flash( 'info_complementary', $problemDrivers);
		}

		return view( 'pages.drivers.resume', ['drivers' => $drivers->take($this->defaultPagination), 'title' => $this->title, 'iconClass' => $this->iconClass] );
	}

	public function create()
	{
		return view( 'pages.drivers.details', ['weekdays' => Weekday::all(), 'title' => 'Nuevo conductor', 'iconClass' => $this->iconClass ] );
	}

	public function details( $id )
	{
		$driver    = $this->driverRepository->findById( $id );
		return view( 'pages.drivers.details', [ 'driver' => $driver, 'weekdays' => Weekday::all(), 'title' => $driver->formalCompleteName, 'iconClass' => $this->iconClass ]);
	}

	public function store( Request $request )
	{
		$this->genericValidation( $request );

		try {
			$driver = $this->driverRepository->store( $request );
			session()->flash( 'success', "El conductor {$driver->completeName} ha sido guardado exitosamente" );
			return Redirect::route( 'driver.details', $driver->id );

		} catch ( \PDOException $exception ) {
			session()->flash( 'info', "El conductor {$request->get(DriverContract::FIRST_NAME)} {$request->get(DriverContract::LAST_NAME)} ha sido creado con anterioridad" );
			return $this->resume();
		}
	}

	public function update( Request $request, $id )
	{
		$this->genericValidation( $request );
		$driver = $this->driverRepository->updateById( $id, $request );

		session()->flash( 'success', "El conductor {$driver->completeName} ha sido actualizado exitosamente" );
		return Redirect::route( 'driver.details', $driver->id );
	}

	public function destroy( $id )
	{
		$this->pairRepository->deleteByDriverId($id);
		$driver = $this->driverRepository->deleteById( $id );
		session()->flash( 'success', "El conductor {$driver->completeName} ha sido eliminado exitosamente" );
		return Redirect::route( 'driver.resume' );
	}
}