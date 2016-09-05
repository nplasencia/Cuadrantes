<?php

namespace Cuadrantes\Http\Controllers;

use Cuadrantes\Commons\ServiceTimetablesContract;
use Cuadrantes\Helpers\ColourHelper;
use Cuadrantes\Repositories\ServiceTimetableRepository;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

use Cuadrantes\Http\Requests;
use Cuadrantes\Repositories\ServiceRepository;
use Cuadrantes\Repositories\PeriodRepository;
use Cuadrantes\Repositories\RouteRepository;

class ServicesController extends Controller
{
    protected $iconClass = 'fa fa-tasks';
    protected $title = 'Servicios laborales';

    protected $serviceRepository;
    protected $periodRepository;
    protected $routeRepository;
    protected $serviceTimetableRepository;

    public function __construct(ServiceRepository $serviceRepository, PeriodRepository $periodRepository, 
                                RouteRepository $routeRepository, ServiceTimetableRepository $serviceTimetableRepository)
    {
        $this->serviceRepository = $serviceRepository;
        $this->periodRepository = $periodRepository;
        $this->routeRepository = $routeRepository;
        $this->serviceTimetableRepository = $serviceTimetableRepository;
    }

    protected function genericValidation(Request $request)
    {
        $this->validate($request, [
            'period_id' => 'required|numeric',
            'time'      => 'required|string',
            'number'    => 'required|numeric',
        ]);
    }

    private function resume($services)
    {
        $title = $this->title;
        $iconClass = $this->iconClass;
        $hours = array();
        $viewServices = array();


        foreach ($services as $service) {
        	if (!isset( $service->timetables) || sizeof($service->timetables) == 0) {
		        $viewServices[$service->time][$service->id][$service->number][] = array();
	        }
            foreach($service->timetables as $timetable) {
                $time = Carbon::createFromFormat('H:i:s', $timetable->time);
                $hours[$service->time][$time->hour] = $time->hour;
                if (!isset ($viewServices[$service->time][$service->number])) {
                    $viewServices[$service->time][$service->id][$service->number][$time->hour] = array();
                }

                $origin = $timetable->route->origin.$timetable->by;
                if ($timetable->pass) {
                    $origin = $timetable->by;
                } else {
                    if ($timetable->by != '') {
                        $origin = $timetable->route->origin.'<br>('.$timetable->by.')';
                    }
                }
                $backgroundColour = '#'.$timetable->pivot->colour;
                $textColour = '#000000';
                if (ColourHelper::isDark($backgroundColour)) {
                    $textColour = '#FFFFFF';
                }

                $viewServices[$service->time][$service->id][$service->number][$time->hour][] = ['colour' => $backgroundColour,
                                                                                  'time'   => $time->format('H:i'),
                                                                                  'origin' => $origin,
                                                                                  'line'   => $timetable->route->line->number,
                                                                                  'text'   => $textColour ];
            }
        }
        if (sizeof($viewServices) > 0) {
	        asort( $hours['afternoon'] );
	        asort( $hours['morning'] );
        }
        //dd($viewServices);
        return view('pages.services.resume', compact('viewServices', 'hours', 'title', 'iconClass'));
    }

    public function all($period_id)
    {
        $services = $this->serviceRepository->findByPeriod($period_id);
        switch ($period_id) {
            case 2:
                $this->title = "Servicios sábados";
                break;
            case 3:
                $this->title = "Servicios domingos";
                break;
	        case 4:
		        $this->title = "Servicios festivos";
		        break;
        }
        return $this->resume($services);
    }

    public function create()
    {
        $title = 'Nuevo servicio';
        $iconClass = $this->iconClass;
        $periods = $this->periodRepository->getAll();
        $times = ['morning', 'afternoon'];
        return view('pages.services.details', compact('periods', 'title', 'iconClass', 'times'));
    }

    public function store(Request $request)
    {
        $this->genericValidation($request);
        try {
            $service = $this->serviceRepository->create($request->all());
            session()->flash('success', 'Servicio creado correctamente.');
            return Redirect::route('service.details', $service->id);
        } catch (\PDOException $exception) {
            session()->flash('info', 'El servicio ya existe.');
            return $this->create();
        }
    }

    public function details($id)
    {
        $service = $this->serviceRepository->findOrFail($id);
        $title = 'Servicio '.$service->number;
        $iconClass = $this->iconClass;
        $periods = $this->periodRepository->getAll();
        $times = ['morning', 'afternoon'];
        $routes = $this->routeRepository->getByPeriodNoService($service->period_id);
        return view('pages.services.details', compact('periods', 'title', 'iconClass', 'times', 'service', 'routes'));
    }

    public function update($serviceId, Request $request)
    {
        $this->genericValidation($request);

        $service = $this->serviceRepository->updateById($serviceId, $request);

        session()->flash('success', 'El servicio '.$service->number.' ha sido actualizado exitosamente');
        return Redirect::route('service.details', $service->id);
    }

    public function destroy($serviceId)
    {
        $this->serviceTimetableRepository->deleteByServiceId($serviceId);
	    $service = $this->serviceRepository->deleteById($serviceId);

        session()->flash('success', 'El servicio ha sido eliminado exitosamente');
        return $this->all($service->period->id);
    }

    public function addTimetable($serviceId, Request $request)
    {
        $this->validate($request, [
            'timetable_id' => 'required|numeric',
        ]);

        $this->serviceTimetableRepository->create([ServiceTimetablesContract::SERVICE_ID   => $serviceId,
                                                   ServiceTimetablesContract::TIMETABLE_ID => $request->get('timetable_id'),
                                                   ServiceTimetablesContract::COLOUR       => str_replace('#', '', $request->get('colour'))]);
        session()->flash('success', 'Se ha añadido un nuevo horario al servicio exitosamente');
        return Redirect::route('service.details', $serviceId);
    }

    public function destroyTimetable($serviceId, $timetableId)
    {
        $this->serviceTimetableRepository->deleteByTimetableId($timetableId);
        session()->flash('success', 'Se ha eliminado el horario del servicio exitosamente');
        return Redirect::route('service.details', $serviceId);
    }
}
