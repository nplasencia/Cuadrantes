<?php

namespace Cuadrantes\Http\Controllers;

use Cuadrantes\Repositories\LineRepository;
use Cuadrantes\Repositories\RouteRepository;
use Illuminate\Http\Request;

use Cuadrantes\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class LinesController extends Controller
{
    protected $defaultPagination = 25;
    protected $iconClass = 'fa fa-car';
    protected $title = "Líneas";

    protected $lineRepository;
    protected $routeRepository;

    public function __construct(LineRepository $lineRepository, RouteRepository $routeRepository)
    {
        $this->lineRepository = $lineRepository;
        $this->routeRepository = $routeRepository;
    }

    protected function genericValidation(Request $request)
    {
        $this->validate($request, [
            'number'    => 'required|string',
            'name'      => 'required|string',
        ]);
    }

    private function resume($lines)
    {
        $title = $this->title;
        $iconClass = $this->iconClass;
        $paginationClass = $lines;
        $searchRoute = 'line.search';
        return view('pages.lines.resume', compact('lines', 'title', 'iconClass', 'searchRoute', 'paginationClass'));
    }

    public function create()
    {
        $title = 'Nueva línea';
        $iconClass = $this->iconClass;
        return view('pages.lines.details', compact('title', 'iconClass'));
    }

    public function all()
    {
        $lines = $this->lineRepository->getAllPaginated($this->defaultPagination);
        return $this->resume($lines);
    }

    public function store(Request $request)
    {
        $this->genericValidation($request);
        try {
            $line = $this->lineRepository->create($request->all());
            $addresses = explode('-', $request->get('name'));
            $origin = trim($addresses[0]);
            $destiny = trim(end($addresses));
            $this->routeRepository->create(['line_id' => $line->id, 'origin' => $origin, 'destiny' => $destiny, 'go' => true]);
            $this->routeRepository->create(['line_id' => $line->id, 'origin' => $destiny, 'destiny' => $origin, 'go' => false]);
            session()->flash('success', 'La línea '.$line->number.' de nombre '.$line->name.' ha sido creada exitosamente');
            return Redirect::route('line.details', $line->id);
        } catch (\PDOException $exception) {
            dd($exception);
            session()->flash('info', 'La línea '.$request->get('number').' ha sido creada con anterioridad.');
            return $this->all();
        }
    }

    public function details($id)
    {
        $line = $this->lineRepository->findOrFail($id);
        $title = 'Línea '.$line->number.': '.$line->name;
        $iconClass = $this->iconClass;
        return view('pages.lines.details', compact('line', 'title', 'iconClass'));
    }

    public function update(Request $request, $id)
    {
        $this->genericValidation($request);

        $line = $this->lineRepository->updateById($id, $request->get('number'), $request->get('name'));

        session()->flash('success', 'La línea '.$line->number.' de nombre '.$line->name.' ha sido actualizada exitosamente');
        return Redirect::route('line.details', $line->id);
    }

    public function destroy($id)
    {
        $line = $this->lineRepository->deleteById($id);
        session()->flash('success', 'La línea '.$line->number.' de nombre '.$line->name.' ha sido eliminada exitosamente');
        return $this->all();
    }

    public function search(Request $request)
    {
        if ($request->get('item') != '') {
            $lines = $this->lineRepository->searchPaginated($request->get('item'), $this->defaultPagination);

            if (sizeof($lines) != 0) {
                return $this->resume($lines);
            }
            session()->flash('info', 'No se han encontrado líneas que sigan este criterio de búsqueda');
        }
        return $this->all();

    }
}