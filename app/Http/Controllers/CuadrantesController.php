<?php

namespace Cuadrantes\Http\Controllers;

use Cuadrantes\Commons\ServiceGroupOrderContract;
use Cuadrantes\Entities\ServiceCondition;
use Cuadrantes\Repositories\ServiceConditionRepository;
use Cuadrantes\Repositories\ServiceGroupOrderRepository;
use Cuadrantes\Repositories\ServiceRepository;
use Cuadrantes\Repositories\ServiceSubstituteRepository;
use Cuadrantes\Repositories\WeekdayRepository;
use Cuadrantes\Http\Requests;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class CuadrantesController extends Controller
{
    private $serviceConditionRepository;
	private $serviceSubstituteRepository;
    private $serviceRepository;
    private $weekdayRepository;
    private $serviceGroupOrderRepository;
	private $substitutes;

    public function __construct(ServiceConditionRepository $serviceConditionRepository, ServiceRepository $serviceRepository,
                                WeekdayRepository $weekdayRepository, ServiceGroupOrderRepository $serviceGroupOrderRepository,
								ServiceSubstituteRepository $serviceSubstituteRepository)
    {
        $this->serviceConditionRepository  = $serviceConditionRepository;
        $this->serviceRepository = $serviceRepository;
        $this->weekdayRepository = $weekdayRepository;
        $this->serviceGroupOrderRepository = $serviceGroupOrderRepository;
	    $this->serviceSubstituteRepository = $serviceSubstituteRepository;
    }

    private function getConditions()
    {
        // Nos traemos ahora todas las condiciones de los servicios
        $servicesConditions = $this->serviceConditionRepository->getAll();

        // Lo ordenamos en un array que separará, por un lado, los periodos y, dentro de cada uno de ellos, las condiciones por grupos
        $orderedConditions = array();
        foreach ($servicesConditions as $serviceCondition) {
            $orderedConditions[$serviceCondition->period_id][$serviceCondition->service_group][] = $serviceCondition;
        }

        return $orderedConditions;
    }

    private function getSubstitutes()
    {
	    // Nos traemos ahora todas las sustituciones de los servicios
	    $servicesSubstitutes = $this->serviceSubstituteRepository->getAll();

	    // Lo ordenamos en un array que separará, por un lado, los periodos y, dentro de cada uno de ellos, las condiciones por grupos
	    $orderedSubstitutes = array();
	    foreach ($servicesSubstitutes as $serviceSubstitute) {
		    $orderedSubstitutes[$serviceSubstitute->period_id][$serviceSubstitute->service_group][] = $serviceSubstitute->driver;
	    }

	    return $orderedSubstitutes;
    }

    private function getServices()
    {
        // Nos traemos todos los servicios
        $services = $this->serviceRepository->getAll();

        // Lo ordenamos en un array que separará, por un lado, los periodos y, dentro de cada uno de ellos, los servicios por grupos
        $orderedServices = array();
        foreach ($services as $service) {
            $orderedServices[$service->period_id][$service->group][] = $service;
        }

        return $orderedServices;
    }

    private function getWeekdays()
    {
        $weekdays = $this->weekdayRepository->getAll();
        $orderedWeekdays = array();
        foreach ($weekdays as $weekday) {
            $orderedWeekdays[$weekday->period_id][] = $weekday;
        }

        return $orderedWeekdays;
    }

    private function getServiceGroupOrder()
    {
        $orders = $this->serviceGroupOrderRepository->getAll();
        $orderedOrders = array();
        foreach ($orders as $order) {
            $orderedOrders[$order->period_id][$order->driver_id][$order->normalized] = $order->service;
	        if ($order->driver_id == 39){

	        }
        }
        return $orderedOrders;
    }

    private function comprobaciones($services, $conditions)
    {
        // Comprobaciones
        $driversCount = 0;
        foreach ($conditions as $condition) {

        }

        // 1. El número de conductores debe de cuadrar con el número de servicios
        if (sizeof($services) != $driversCount) {
            return "El número de conductores no coincide con el número de servicios.";
        }
        // 2. El número de días de descanso dentro del periodo debe ser menor o igual que el número de conductores sustitutos

        // 3. No pueden coincidir las vacaciones de
        return true;
    }

    private function getSubstitute($today, $weekday)
    {
    	if ($this->substitutes === null || sizeof($this->substitutes) == 0) {
    		echo " No existen sustitutos o no quedan.";
    		return false;
	    }
	    shuffle($this->substitutes);

	    $substitute = array_pop($this->substitutes);
	    if ($substitute->isRestDay( $weekday, $substitute->restDays ) || $substitute->isInHolidays( $today, $substitute->holidays )) {
	    	echo " El sustituto {$substitute->getCompleteName()} está de vacaciones o de descanso para este día.";
	    	return $this->getSubstitute($today, $weekday);
	    }
	    return $substitute;
    }

    public function complexAlgorithm()
    {
        $servicesConditions = $this->getConditions();
	    $servicesSubstitutes = $this->getSubstitutes();
        $servicesOrdered = $this->getServices();
        $weekdays = $this->getWeekdays();
        $groupServiceOrders = $this->getServiceGroupOrder();

	    $cuadrantes = array();

        foreach ($servicesOrdered as $period => $groups) {
            foreach ($groups as $group => $services) {

				$substitutions = array(); //Este array almacenará las sustituciones que existan para cada grupo de servicios

	            $this->substitutes = null;
	            if (isset($servicesSubstitutes[$period][$group])) {
		            $this->substitutes = $servicesSubstitutes[$period][$group];
		            echo "Hay asignados ".sizeof($this->substitutes)." sustitutos para el grupo de servicios $group del periodo $period<br>";
	            }

                $now = new Carbon();
                $now = $now->startOfWeek();
                foreach ($weekdays[$period] as $weekday) {
                    echo "Miramos el día {$weekday->value}<br>";

	                if (!isset($servicesConditions[$period][$group])) {
		                echo "<b>No existe una condición para el servicio ".implode(',', $servicesOrdered[$period][$group])."</b>. Se puede asignar cualquier conductor.<br><br>";
		                $cuadrantes[$weekday->value][$servicesOrdered[$period][$group][0]->number] = false;
		                continue;
	                }
	                $conditions = $servicesConditions[$period][$group];

                    foreach ($conditions as $condition) {
                        $substitute = null;
	                    $driver = $condition->driver;
	                    if ( $driver->isInHolidays( $now, $driver->holidays ) ) {
		                    echo "El conductor {$driver->getCompleteName()} <b>está de vacaciones</b> este día. Buscamos sustituto.";
		                    if (!isset($substitutions[$driver->id])) {
			                    $substitutions[$driver->id] = $this->getSubstitute($now, $weekday);
		                    }
		                    $substitute = $substitutions[$driver->id];

	                    } else if ( $driver->isRestDay( $weekday, $driver->restDays ) ) {
		                    echo "El conductor {$driver->getCompleteName()} <b>descansa</b> este día. Buscamos sustituto.";
		                    if (!isset($substitutions[$driver->id])) {
			                    $substitutions[$driver->id] = $this->getSubstitute($now, $weekday);
		                    }
		                    $substitute = $substitutions[$driver->id];
	                    }

	                    $calculoNormalizado = intval(( $now->weekOfYear / sizeof( $services ) - floor( $now->weekOfYear / sizeof( $services ) ) ) * sizeof( $services ));
	                    //echo "CALCULO: $calculoNormalizado<br>";

	                    if ( isset( $groupServiceOrders[ $period ] [ $driver->id ][ $calculoNormalizado ] ) ) {
	                    	$service = $groupServiceOrders[ $period ] [ $driver->id ][ $calculoNormalizado ];
	                        if ($substitute === null) {
			                    echo "Servicio número {$service->number}: Conductor {$driver->getCompleteName()} <br>";
			                    $cuadrantes[$weekday->value][$service->number] = $driver;
		                    } else {
		                        if ($substitute === false) {
		                            echo "Servicio número {$service->number}: No existe conductor ni sustituto. Esperamos siguiente iteración.<br>";
				                    $cuadrantes[$weekday->value][$service->number] = false;
			                    } else {
				                    echo "Servicio número {$service->number}: Conductor {$substitute->getCompleteName()} <br>";
				                    $cuadrantes[$weekday->value][$service->number] = $substitute;
			                    }
		                    }
	                    } else {
		                    echo "No se ha asignado valor inicial para este tema $calculoNormalizado<br>";
	                    }
                    }
                    $now->addDay();
                    echo "<br>";
                }
            }
        }

        foreach ($cuadrantes as $weekday => $services) {
        	echo "<b>$weekday</b><br>";
        	ksort($services);
        	foreach ($services as $service => $driver) {
		        echo "Servicio $service;";
        		if ($driver === false) {
			        echo "Asignar sustituto;<br>";
		        } else {
			        echo "{$driver->getCompleteName()};<br>";
		        }
	        }
        }

    }
}
