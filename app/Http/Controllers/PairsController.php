<?php

namespace Cuadrantes\Http\Controllers;

use Cuadrantes\Commons\PairContract;
use Cuadrantes\Entities\Pair;
use Cuadrantes\Repositories\DriverRepository;
use Cuadrantes\Repositories\PairRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PairsController extends Controller
{
    protected $defaultPagination = 25;
    protected $iconClass = 'fa fa-users';
	protected $title = 'Parejas';

    private $driverRepository;
    private $pairRepository;

    public function __construct(DriverRepository $driverRepository, PairRepository $pairRepository)
    {
        $this->driverRepository = $driverRepository;
        $this->pairRepository   = $pairRepository;
    }

	/**
	 * En el caso de este resume, se devuelven todos los registros. No existen llamadas Ajax.
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function resume()
    {
    	$pairs = $this->pairRepository->getAllForResumeView();
        return view('pages.pairs.resume', ['title' => $this->title, 'iconClass' => $this->iconClass, 'pairs' => $pairs]);
    }

	public function create()
	{
		$newPairNumber = $this->pairRepository->getNewPairNumber();
		return $this->details($newPairNumber);
	}

	public function details($pairNumber)
	{
		$driversWithoutPair = $this->driverRepository->getDriversWithoutPair();
		$pairs = $this->pairRepository->getByPairNumber($pairNumber);
		return view( 'pages.pairs.details', ['title' => "Pareja número $pairNumber", 'iconClass' => $this->iconClass,
		                                     'driversWithoutPair' => $driversWithoutPair, 'pairs' => $pairs, 'pairNumber' => $pairNumber ] );
	}

	public function driverAdd (Request $request, $pairNumber) {
		Pair::create([PairContract::PAIR_ID => $pairNumber, PairContract::DRIVER_ID => $request->get(PairContract::DRIVER_ID)]);
		return Redirect::route('pair.details', $pairNumber);
	}

	public function driverDestroy ($pairNumber, $driverId) {
		$this->pairRepository->deleteByDriverId($driverId);
		return Redirect::route('pair.details', $pairNumber);
	}

	public function destroy($pairNumber)
	{
		$this->pairRepository->deleteByPairNumber($pairNumber);
		session()->flash( 'success', "La pareja $pairNumber ha sido eliminada exitosamente" );
		return Redirect::route('pair.resume');
	}
}