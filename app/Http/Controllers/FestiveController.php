<?php

namespace Cuadrantes\Http\Controllers;

use Cuadrantes\Commons\FestiveContract;
use Cuadrantes\Entities\Festive;
use Cuadrantes\Repositories\FestiveRepository;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class FestiveController extends Controller
{
	protected $defaultPagination = 25;
	protected $iconClass = 'fa fa-calendar';
	protected $title = "Días festivos";

	private $festiveRepository;

	public function __construct(FestiveRepository $festiveRepository)
	{
		$this->festiveRepository  = $festiveRepository;
	}

	protected function genericValidation(Request $request)
	{
		$this->validate($request, [
			FestiveContract::DATE => 'required|date_format:d/m/Y',
		]);
	}

	protected function getTableActionButtons(Festive $festive)
	{
		return '<div class="btn-group">
                    <div class="btn-group">
                        <div class="btn-group pull-right">
                            <a href="'.route('festive.destroy', $festive->id).'" data-toggle="tooltip" data-original-title="Eliminar" data-placement="bottom" class="btn btn-danger btn-xs btn-delete">
                                <i class="fa fa-remove"></i>
                            </a>
                        </div>
                    </div>
                </div>';
	}

	public function ajaxResume()
	{
		return Datatables::of($this->festiveRepository->getAllByYear())
							->editColumn('festiveDate', function (Festive $festive) {
								return $festive->getDateFormattedAttribute();
							})
							->editColumn('always', function (Festive $festive) {
								$checked = $festive->always ? 'checked' : '';
								return "<input class='uniform' type='checkbox' $checked disabled>";
							})
							->addColumn('actions', function (Festive $festive) {
								return $this->getTableActionButtons($festive);
							})->make(true);
	}

	public function resume()
	{
		$festives = $this->festiveRepository->getAllByYearPaginated($this->defaultPagination);
		return view('pages.festives.resume', ['title' => $this->title, 'iconClass' => $this->iconClass, 'festives' => $festives]);
	}

	public function store (Request $request)
	{
		$this->genericValidation($request);
		//try {
			$festive = $this->festiveRepository->store($request);
			session()->flash('success', "Se ha añadido el día festivo {$festive->dateFormatted} correctamente");
		/*} catch (\PDOException $exception) {
			session()->flash('info', "Este día festivo ha sido creado con anterioridad");

		} finally {*/
			return redirect()->back();
		//}
	}

	public function destroy ($id)
	{
		$festive = $this->festiveRepository->forceDeleteById($id);
		session()->flash('success', "El día {$festive->dateFormatted} ha sido eliminado de los días festivos");
		return redirect()->back();
	}
}
