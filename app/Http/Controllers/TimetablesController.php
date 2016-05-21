<?php

namespace Cuadrantes\Http\Controllers;

use Cuadrantes\Repositories\TimetableRepository;

use Cuadrantes\Http\Requests;

class TimetablesController extends Controller
{

    protected $timetableRepository;

    public function __construct(TimetableRepository $timetableRepository)
    {
        $this->timetableRepository = $timetableRepository;
    }

    public function resume($line_id)
    {
        $timetables = $this->timetableRepository->getAllByLine($line_id);
        $timeArray = array();
        foreach ($timetables as $timetable) {
            // Crear array y enviarlo a la vista
            $timeArray[$timetable->period_id] = [
                'date' => $timetable->date;
                '' 
            ];
        }
    }
}
