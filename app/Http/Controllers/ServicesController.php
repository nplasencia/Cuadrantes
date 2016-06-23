<?php

namespace Cuadrantes\Http\Controllers;

use Illuminate\Http\Request;

use Cuadrantes\Http\Requests;
use Cuadrantes\Repositories\ServiceRepository;
use Cuadrantes\Repositories\PeriodRepository;
use Carbon\Carbon;

class ServicesController extends Controller
{
    protected $iconClass = 'fa fa-tasks';
    protected $title = 'Servicios laborales';

    protected $serviceRepository;
    protected $periodRepository;

    public function __construct(ServiceRepository $serviceRepository, PeriodRepository $periodRepository)
    {
        $this->serviceRepository = $serviceRepository;
        $this->periodRepository = $periodRepository;
    }

    private function resume($services)
    {
        $title = $this->title;
        $iconClass = $this->iconClass;
        $hours = array();
        $viewServices = array();
        foreach ($services as $service) {
            foreach($service->timetables as $timetable) {
                $time = Carbon::createFromFormat('H:i:s', $timetable->time);
                $hours[$service->time][$time->hour] = $time->hour;
                if (!isset ($viewServices[$service->time][$service->number])) {
                    $viewServices[$service->time][$service->number][$time->hour] = array();
                }

                $origin = $timetable->route->origin.$timetable->by;
                if ($timetable->pass) {
                    $origin = $timetable->by;
                } else {
                    if ($timetable->by != '') {
                        $origin = $timetable->route->origin.'<br>('.$timetable->by.')';
                    }
                }
                $viewServices[$service->time][$service->number][$time->hour][] = ['colour' => '#'.$timetable->pivot->colour,
                                                                                  'time'   => $time->format('H:i'),
                                                                                  'origin' => $origin,
                                                                                  'line'   => $timetable->route->line->number];
            }
        }
        asort($hours);
        //dd($viewServices);
        return view('pages.services.resume', compact('viewServices', 'hours', 'title', 'iconClass'));
    }

    public function all()
    {
        $services = $this->serviceRepository->findByPeriod(1);
        return $this->resume($services);
    }

    public function create()
    {
        $title = 'Nuevo servicio';
        $iconClass = $this->iconClass;
        $periods = $this->periodRepository->getAll();
        return view('pages.buses.details', compact('periods', 'title', 'iconClass'));
    }
}
