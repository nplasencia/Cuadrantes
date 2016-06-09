<?php

namespace Cuadrantes\Http\Controllers;

use Illuminate\Http\Request;

use Cuadrantes\Http\Requests;
use Cuadrantes\Http\Controllers\Controller;
use Cuadrantes\Repositories\ServiceRepository;
use Carbon\Carbon;

class ServicesController extends Controller
{
    protected $iconClass = 'fa fa-tasks';
    protected $title = 'Servicios';

    protected $serviceRepository;

    public function __construct(ServiceRepository $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
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

                $viewServices[$service->time][$service->number][$time->hour][] = ['colour' => '#'.$service->colour,
                                                                                  'time'   => $time->format('H:i'),
                                                                                  'origin' => $timetable->route->origin,
                                                                                  'line'   => $timetable->route->line->number];
            }
        }
        $hours = $hours['morning'];
        asort($hours);
        $viewServices = $viewServices['morning'];
        //dd($viewServices);
        return view('pages.services.resume', compact('viewServices', 'hours', 'title', 'iconClass'));
    }

    public function all()
    {
        $services = $this->serviceRepository->findByPeriod(1);
        return $this->resume($services);
    }
}
