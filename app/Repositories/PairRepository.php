<?php

namespace Cuadrantes\Repositories;

use Cuadrantes\Commons\DriverContract;
use Cuadrantes\Commons\PairContract;
use Cuadrantes\Entities\Pair;
use Illuminate\Database\Eloquent\Collection;
use Mockery\CountValidator\Exception;
use PhpParser\Node\Expr\Cast\Array_;

class PairRepository extends BaseRepository
{
    public function getEntity()
    {
        return new Pair();
    }

	public function getAllForResumeView()
	{
		$res = array();
		$pairs = $this->getAll();
		foreach ($pairs as $pair) {
			// Devolvemos los nombres de dicho número de pareja separados por guión
				if ( isset ( $res[ $pair->pair_id ] ) ) {
					$res[ $pair->pair_id ] .= " - {$pair->driver->completeName}";
				} else {
					$res[ $pair->pair_id ] = $pair->driver->completeName;
				}
		}
		return $res;
	}

    public function getAll()
    {
        return $this->newQuery()->orderBy(PairContract::PAIR_ID)->with('driver')->get();
    }

    public function getAllPaginated($numberOfElements)
    {
        return $this->newQuery()->orderBy(PairContract::PAIR_ID)->with('driver')->paginate($numberOfElements);
    }

	/**
	 * Este método devuelve el siguiente número válido para las parejas. Ten en cuenta que, si existe un número intermedio
	 * que actualmente no está siendo usado, va a devolver ese número
	 *
	 * @return mixed
	 */
    public function getNewPairNumber()
    {
    	$pairs = $this->newQuery()->orderBy(PairContract::PAIR_ID)->select(PairContract::PAIR_ID)->groupBy(PairContract::PAIR_ID)->get();
	    if ($pairs[0]->pair_id > 1) {
	    	return $pairs[0]->pair_id - 1;
	    }
	    for ($i=0; $i < $pairs->count(); $i++) {
	    	$actualPairNumber = $pairs[$i]->pair_id;
		    if (!isset($pairs[$i+1])) {
		    	break;
		    }
		    $nextPairNumber   = $pairs[$i+1]->pair_id;
			if (($actualPairNumber + 1) < $nextPairNumber) {
				return $actualPairNumber + 1;
			}
	    }
	    return ($pairs->last())->pair_id + 1;
    }

	public function getByPairNumber($pairNumber)
	{
		return $this->newQuery()->where(PairContract::PAIR_ID, $pairNumber)->with('driver')->get();
	}

	// Estos 2 métodos debíamos hacerlos eliminar físicamente los registros (softDelete no válido) porque se cumplía la constraint unique en algunos casos.
	// TODO: Eliminar la constraint cuando la app esté caminando correctamente
	public function deleteByDriverId($driverId)
	{
		return $this->newQuery()->where(PairContract::DRIVER_ID, $driverId)->forceDelete();
	}

	public function deleteByPairNumber($pairNumber)
	{
		return $this->newQuery()->where(PairContract::PAIR_ID, $pairNumber)->forceDelete();
	}
}