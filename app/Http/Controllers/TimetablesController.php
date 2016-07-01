<?php

namespace Cuadrantes\Http\Controllers;

use Carbon\Carbon;
use Cuadrantes\Repositories\LineRepository;

use Cuadrantes\Http\Requests;
use Cuadrantes\Repositories\PeriodRepository;
use Cuadrantes\Repositories\RouteRepository;
use Cuadrantes\Repositories\TimetableRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TimetablesController extends Controller
{
    protected $iconClass = 'glyphicon glyphicon-time';
    protected $title = "Horarios";

    protected $lineRepository;
    protected $timetableRepository;
    protected $periodRepository;
    protected $routeRepository;

    public function __construct(LineRepository $lineRepository, TimetableRepository $timetableRepository, PeriodRepository $periodRepository, RouteRepository $routeRepository)
    {
        $this->lineRepository = $lineRepository;
        $this->timetableRepository = $timetableRepository;
        $this->periodRepository = $periodRepository;
        $this->routeRepository = $routeRepository;
    }

    protected function genericValidation(Request $request)
    {
        $this->validate($request, [
            'period_id' => 'required|numeric',
            'route_id'  => 'required|numeric',
            'time'      => 'required|string',
            'by'        => 'string',
        ]);
    }

    public function resume($line_id)
    {
        $timetables = $this->lineRepository->getTimetables($line_id);
        $periods = $this->periodRepository->getAll();
        $routes = $this->routeRepository->findByLineId($line_id);
        $timeArray = array();
        foreach ($timetables as $timetable) {

            if (!isset($timeArray[$timetable->period_id])) {
                $timeArray[$timetable->period_id] = [
                    'id'     => $timetable->period->id,
                    'period' => $timetable->period->code,
                    'routes' => array(),
                ];
            }
            if (!isset($timeArray[$timetable->period_id]['routes'][$timetable->route->id])) {
                $timeArray[$timetable->period_id]['routes'][$timetable->route->id]= [
                    'id'      => $timetable->route->id,
                    'destiny' => $timetable->route->destiny,
                    'times'   => array(),
                ];
            }
            $timeArray[$timetable->period_id]['routes'][$timetable->route->id]['times'][] = $timetable;
        }
        $line = $this->lineRepository->findOrFail($line_id);
        $title = 'Horarios de la línea '.$line->number.': '.$line->name;
        $iconClass = $this->iconClass;
        return view('pages.timetables.details', compact('line', 'periods', 'routes', 'timeArray', 'title', 'iconClass'));
    }

    public function store(Request $request, $line_id)
    {
        $this->genericValidation($request);
        try {
            $this->timetableRepository->create($request->all());
            session()->flash('success', 'Horario creado correctamente.');
        } catch (\PDOException $exception) {
            session()->flash('info', 'El horario ya existe.');
        } finally {
            return $this->resume($line_id);
        }
    }

    public function destroy($line_id, $id)
    {
        $this->timetableRepository->deleteById($id);
        session()->flash('success', 'El horario ha sido eliminado exitosamente');
        return $this->resume($line_id);
    }

    public function getByRouteNoServices($route_id, Request $request)
    {
        $timetables = $this->timetableRepository->getByRouteNoService($route_id, $request->get('period_id'));

        if ($request->ajax()) {
            $ajaxResponse = array();
            foreach ($timetables as $timetable) {
                $time = Carbon::createFromFormat('H:i:s', $timetable->time);
                $extraText = "";
                if($timetable->pass == true) {
                    $extraText = '(Horario de paso - ' . $timetable->by .')';
                } elseif(isset($timetable->by) && $timetable->by!='') {
                    $extraText = $timetable->by;
                }
                $ajaxResponse[] = [$timetable->id, $time->format('H:i').' '.$extraText];
            }
            return response()->json($ajaxResponse);
        }

        dd($timetables);
    }
}
