<?php

namespace Cuadrantes\Http\Controllers;

use Carbon\Carbon;
use Cuadrantes\Commons\DriverContract;
use Cuadrantes\Entities\Driver;
use Cuadrantes\Entities\DriverHoliday;
use Cuadrantes\Entities\DriverRestDay;
use Cuadrantes\Entities\Weekday;
use Cuadrantes\Repositories\DriverHolidayRepository;
use Cuadrantes\Repositories\DriverRepository;
use Cuadrantes\Repositories\WeekdayRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\Datatables\Datatables;

class DriversController extends Controller
{
    protected $defaultPagination = 25;
    protected $iconClass = 'fa fa-users';
    protected $title = "Conductores";

    private $driverRepository;
    private $holidayRepository;
    private $weekdayRepository;

    public function __construct(DriverRepository $driverRepository, DriverHolidayRepository $holidayRepository, WeekdayRepository $weekdayRepository)
    {

        $this->driverRepository = $driverRepository;
        $this->holidayRepository = $holidayRepository;
        $this->weekdayRepository = $weekdayRepository;
    }

    protected function genericValidation(Request $request) {
        $this->validate($request, [
            'last_name'         => 'required|max:250|string',
            'first_name'        => 'required|max:250|string',
            'dni'               => 'required|string',
            'telephone'         => 'required|digits:9',
            'extension'         => 'required|digits_between:0,9999',
            'email'             => 'required|email',
            'cap'               => 'required|date',
            'driver_expiration' => 'required|date'
        ]);
    }

    protected function getTableActionButtons(Driver $driver)
    {
        return '<div class="btn-group">
                    <a href="'.route('driver.details', $driver->id).'" data-toggle="tooltip" data-original-title="Editar" data-placement="bottom" class="btn btn-success btn-xs">
                        <i class="fa fa-edit"></i>
                    </a>
                </div>
                <div class="btn-group">
                    <a href="'.route('driver.destroy', $driver->id).'" data-toggle="tooltip" data-original-title="Eliminar" data-placement="bottom" class="btn btn-danger btn-xs btn-delete">
                        <i class="fa fa-trash-o"></i>
                    </a>
                </div>';
    }

    public function ajaxResume()
    {
        return Datatables::of($this->driverRepository->getAll())
            ->editColumn('cap', function (Driver $driver){
                return with(new Carbon($driver->cap))->format('d-m-Y');
            })
            ->editColumn('driver_expiration', function (Driver $driver){
                return with(new Carbon($driver->driver_expiration))->format('d-m-Y');
            })
            ->addColumn('actions', function (Driver $driver) {
                return $this->getTableActionButtons($driver);
            })
            ->make(true);
    }

    private function saveRestdays($restdays, $driver) {
        if ($restdays !== null) {
            foreach ($restdays as $weekday_id) {
                $driverRestDay = new DriverRestDay();
                $driverRestDay->driver_id  = $driver->id;
                $driverRestDay->weekday_id = $weekday_id;
                $driverRestDay->save();
            }
            return true;
        }
        return false;
    }

    private function saveHolidays($holidaysRaw, $driver) {
        if (!isset($holidaysRaw) || $holidaysRaw == null || $holidaysRaw == '') {
            return false;
        }
        $holidays = str_split(str_replace(' - ', '', $holidaysRaw),strpos($holidaysRaw, ' - '));
        $driverHoliday = new DriverHoliday();
        $driverHoliday->driver_id  = $driver->id;
        $driverHoliday->date_from = date_create_from_format('d/m/Y', $holidays[0]);
        $driverHoliday->date_to = date_create_from_format('d/m/Y', $holidays[1]);
        $driverHoliday->active = true;
        $driverHoliday->save();
        return true;

    }

    private function generateUserHolidays($holidays) {
        $from = date("d/m/Y", strtotime($holidays->date_from));
        $to = date("d/m/Y", strtotime($holidays->date_to));
        return $from.' - '.$to;
    }

    private function resume($drivers) {
        $title = $this->title;
        $iconClass = $this->iconClass;
        $paginationClass = $drivers;
        $searchRoute = 'driver.search';
        return view('pages.drivers.resume', compact('drivers', 'title', 'iconClass', 'searchRoute', 'paginationClass'));
    }

    public function create()
    {
        $title = 'Nuevo conductor';
        $iconClass = $this->iconClass;
        $weekdays = Weekday::all();
        return view('pages.drivers.details', compact('weekdays', 'title', 'iconClass'));
    }

    public function all()
    {
        $drivers = $this->driverRepository->getAllPaginated($this->defaultPagination);
        return $this->resume($drivers);
    }

    public function details($id)
    {
        $driver = Driver::findOrFail($id);
        $holidays = $driver->holidays;
        $holidays1='';
        $holidays2='';
        if (isset($holidays[0])) {
            $holidays1 = $this->generateUserHolidays($holidays[0]);
        }
        if (isset($holidays[1])) {
            $holidays2 = $this->generateUserHolidays($holidays[1]);
        }
        $weekdays = Weekday::all();
        $title = $driver->last_name . ', ' . $driver->first_name;
        $iconClass = 'fa fa-user';
        return view('pages.drivers.details', compact('driver', 'holidays1', 'holidays2', 'weekdays', 'title', 'iconClass'));
    }

    //TODO: Try catch en caso de que ya exista el conductor
    public function store(Request $request)
    {
        $this->genericValidation($request);

        $driver = new Driver($request->all(), true);
        $driver->save();

        $this->saveRestdays($request->get('restDays'), $driver);
        $this->saveHolidays($request->get('holidays1'), $driver);
        $this->saveHolidays($request->get('holidays2'), $driver);

        session()->flash('success', 'El conductor '.$driver->first_name.' '.$driver->last_name.' ha sido guardado exitosamente');
        return Redirect::route('driver.details', $driver->id);
    }

    public function update(Request $request, $id)
    {
        $this->genericValidation($request);

        $driver = Driver::findOrFail($id);
        $driver->last_name         = $request->get('last_name');
        $driver->first_name        = $request->get('first_name');
        $driver->dni               = $request->get('dni');
        $driver->telephone         = $request->get('telephone');
        $driver->extension         = $request->get('extension');
        $driver->email             = $request->get('email');
        $driver->cap               = $request->get('cap');
        $driver->driver_expiration = $request->get('driver_expiration');
        $driver->save();
        
        $driverRestDays = DriverRestDay::where('driver_id', $driver->id)->get();
        foreach ($driverRestDays as $driverRestDay) {
            $driverRestDay->delete();
        }

        $driverHolidays = DriverHoliday::where('driver_id', $driver->id)->get();
        foreach ($driverHolidays as $driverHoliday) {
            $driverHoliday->delete();
        }
        
        $this->saveRestdays($request->get('restDays'), $driver);
        $this->saveHolidays($request->get('holidays1'), $driver);
        $this->saveHolidays($request->get('holidays2'), $driver);

        session()->flash('success', 'El conductor '.$driver->first_name.' '.$driver->last_name.' ha sido actualizado exitosamente');
        return Redirect::route('driver.details', $driver->id);
    }

    public function destroy($id)
    {
        $driver = $this->driverRepository->deleteById($id);

        session()->flash('success', 'El conductor '.$driver->first_name.' '.$driver->last_name.' ha sido eliminado exitosamente');
        return Redirect::route('driver.resume');
    }
}