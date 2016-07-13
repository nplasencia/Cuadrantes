<?php

namespace Cuadrantes\Http\Controllers;

use Cuadrantes\Http\Requests;
use Cuadrantes\Repositories\DriverRepository;
use Cuadrantes\Repositories\PairRepository;

use Cuadrantes\Entities\Pair;

use Yajra\Datatables\Datatables;

class PairsController extends Controller
{
    protected $defaultPagination = 25;
    protected $iconClass = 'fa fa-users';
    protected $title = "Parejas";

    private $driverRepository;
    private $pairRepository;

    public function __construct(DriverRepository $driverRepository, PairRepository $pairRepository)
    {
        $this->driverRepository = $driverRepository;
        $this->pairRepository   = $pairRepository;
    }

    protected function getTableActionButtons(Pair $pair)
    {
        return '<div class="btn-group">
                    <a href="'.route('bus.details', $pair->pair_id).'" data-toggle="tooltip" data-original-title="Editar" data-placement="bottom" class="btn btn-success btn-xs">
                        <i class="fa fa-edit"></i>
                    </a>
                </div>
                <div class="btn-group">
                    <a href="'.route('bus.destroy', $pair->pair_id).'" data-toggle="tooltip" data-original-title="Eliminar" data-placement="bottom" class="btn btn-danger btn-xs btn-delete">
                        <i class="fa fa-trash-o"></i>
                    </a>
                </div>';
    }

    public function ajaxResume()
    {
        return Datatables::of($this->pairRepository->getAll())
            ->addColumn('actions', function (Pair $pair) {
                return $this->getTableActionButtons($pair);
            })
            ->make(true);
    }

    private function resume($pairs)
    {
        return view('pages.pairs.resume', ['title' => $this->title, 'iconClass' => $this->iconClass, 'pairs' => $pairs]);
    }
    
    public function all()
    {
        $pairs = $this->pairRepository->getAllPaginated($this->defaultPagination);
        return $this->resume($pairs);
    }
}