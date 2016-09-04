<?php

namespace Cuadrantes\Http\Controllers;

use Cuadrantes\Commons\ServiceGroupOrderContract;
use Cuadrantes\Entities\Period;
use Cuadrantes\Entities\Weekday;
use Cuadrantes\Entities\ServiceCondition;
use Cuadrantes\Repositories\DriverRepository;
use Cuadrantes\Repositories\ServiceConditionRepository;
use Cuadrantes\Repositories\ServiceGroupOrderRepository;
use Cuadrantes\Repositories\ServiceRepository;
use Cuadrantes\Repositories\ServiceSubstituteRepository;
use Cuadrantes\Repositories\WeekdayRepository;
use Cuadrantes\Http\Requests;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use spec\PhpSpec\Runner\MatcherManagerSpec;

class CuadrantesController extends Controller
{
    private $serviceConditionRepository;
	private $serviceSubstituteRepository;
    private $serviceRepository;
    private $weekdayRepository;
    private $serviceGroupOrderRepository;
	private $driverRepository;
	private $substitutes;

    public function __construct(ServiceConditionRepository $serviceConditionRepository, ServiceRepository $serviceRepository,
                                WeekdayRepository $weekdayRepository, ServiceGroupOrderRepository $serviceGroupOrderRepository,
								ServiceSubstituteRepository $serviceSubstituteRepository, DriverRepository $driverRepository)
    {
        $this->serviceConditionRepository  = $serviceConditionRepository;
        $this->serviceRepository = $serviceRepository;
        $this->weekdayRepository = $weekdayRepository;
        $this->serviceGroupOrderRepository = $serviceGroupOrderRepository;
	    $this->serviceSubstituteRepository = $serviceSubstituteRepository;
	    $this->driverRepository = $driverRepository;
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
            $orderedOrders[$order->period_id][$order->group][$order->driver_id][$order->normalized] = $order->service;
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
    		echo " No existen sustitutos o no quedan.<br>";
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

    private function getReplacements(Array $drivers, $today, $weekday, Array $horasTrabajadasSemana)
    {
		if ($weekday == Carbon::SUNDAY) {
			$weekday = 7;
		}
    	$weekday = $this->weekdayRepository->findOrFail($weekday);
	    foreach ($horasTrabajadasSemana as $conductorId => $dias) {
	    	if ($dias > 4) {
	    		$drivers[]=$conductorId;
		    }
	    }

    	$replacementsNotFiltered = $this->driverRepository->getDriversNotInArray($drivers);
	    $replacements = array();
	    foreach ($replacementsNotFiltered as $replacement) {
	    	if ($replacement->isRestDay( $weekday, $replacement->restDays ) || $replacement->isInHolidays( $today, $replacement->holidays )) {
	    		continue;
		    }
		    $replacements[] = $replacement;
	    }
	    return $replacements;
    }

    public function complexAlgorithm()
    {
        $servicesConditions = $this->getConditions();
	    $servicesSubstitutes = $this->getSubstitutes();
        $servicesOrdered = $this->getServices();
        $weekdays = $this->getWeekdays();
        $groupServiceOrders = $this->getServiceGroupOrder();

	    for ($i=0; $i<4;$i++) {

		    $cuadrantes = array();

		    foreach ( $servicesOrdered as $period => $groups ) {
			    foreach ( $groups as $group => $services ) {

				    $substitutions = array(); //Este array almacenará las sustituciones que existan para cada grupo de servicios

				    $this->substitutes = null;
				    if ( isset( $servicesSubstitutes[ $period ][ $group ] ) ) {
					    $this->substitutes = $servicesSubstitutes[ $period ][ $group ];
					    echo "Hay asignados " . sizeof( $this->substitutes ) . " sustitutos para el grupo de servicios $group del periodo $period<br>";
				    }

				    $now = new Carbon();

				    $now->addWeeks( $i );
				    foreach ( $weekdays[ $period ] as $weekday ) {
					    $now = $now->startOfWeek()->addDays( $weekday->id - 1 );
					    echo "Miramos el día {$weekday->value} {$now->day}<br>";

					    if ( !isset( $servicesConditions[ $period ][ $group ] ) ) {
					    	if ($period == Period::SUNDAY && $services[0]->number == 13) {
							    echo "<b>Condición programada manualmente: Conductor que haga el servicio 13 el sábado.<br></b>";
							    $cuadrantes[ $now->toDateString() ][ $services[0]->number ] = null;
						    } elseif ($period == Period::SUNDAY && $services[0]->number == 28) {
							    echo "<b>Condición programada manualmente para servicios 28, 29, 30, 33 y 34: Conductor que haga servicio 3 durante la semana y libre sábado.<br></b>";
							    foreach ( $services as $service ) {
								    $cuadrantes[ $now->toDateString() ][ $service->number ] = null;
							    }
						    } else {
							    foreach ( $services as $service ) {
								    echo "<b>No existe una condición para el servicio {$service->number}</b>. Se puede asignar cualquier conductor.<br><br>";
								    $cuadrantes[ $now->toDateString() ][ $service->number ] = false;
							    }
						    }
						    $now->addDay();
						    continue;
					    }
					    $conditions = $servicesConditions[ $period ][ $group ];

					    //$calculoNormalizado = intval( ( $now->weekOfYear / sizeof( $services ) - floor( $now->weekOfYear / sizeof( $services ) ) ) * sizeof( $services ) );
					    $aux = intval($now->weekOfYear / sizeof( $services ));
					    $calculoNormalizado = $now->weekOfYear - sizeof( $services ) * $aux;
					    //echo "CALCULO: $calculoNormalizado<br>";

					    if ($services[0]->number != 52) {
						    while ( sizeof( $conditions ) > sizeof( $services ) ) {
							    echo "Tenemos más condiciones que servicios<br>";
							    shuffle( $conditions );
							    array_pop( $conditions );
						    }
					    } else {
					    	// Para el servicio 52 tenemos asignados varios conductores. Debido a ello, debemos de encontrar la condición que esté preparada para
						    // el calculo normalizado
						    foreach ($conditions as $condition) {
						    	$driver = $condition->driver;
							    if (isset( $groupServiceOrders[ $period ] [ $group ] [ $driver->id ][ $calculoNormalizado ])) {
							    	$conditions = [$condition];
								    break;
							    }
						    }
					    }

					    $serviciosAsignados = array();

					    foreach ( $conditions as $condition ) {
						    $substitute = null;
						    $driver = $condition->driver;
						    if ( $driver->isInHolidays( $now, $driver->holidays ) ) {
							    echo "El conductor {$driver->getCompleteName()} <b>está de vacaciones</b> este día. Buscamos sustituto.";
							    if ( ! isset( $substitutions[ $driver->id ] ) ) {
								    $substitutions[ $driver->id ] = $this->getSubstitute( $now, $weekday );
							    }
							    $substitute = $substitutions[ $driver->id ];

						    } else if ( $driver->isRestDay( $weekday, $driver->restDays ) ) {
							    echo "El conductor {$driver->getCompleteName()} <b>descansa</b> este día. Buscamos sustituto.";
							    if ( ! isset( $substitutions[ $driver->id ] ) ) {
								    $substitutions[ $driver->id ] = $this->getSubstitute( $now, $weekday );
							    }
							    $substitute = $substitutions[ $driver->id ];
						    }

						    if ( isset( $groupServiceOrders[ $period ] [ $group ] [ $driver->id ][ $calculoNormalizado ] ) ) {
							    $service = $groupServiceOrders[ $period ] [ $group ] [ $driver->id ][ $calculoNormalizado ];
							    $serviciosAsignados[] = $service->id;
							    if ( $substitute === null ) {
								    echo "Servicio número {$service->number}: Conductor {$driver->getCompleteName()} <br>";
								    $cuadrantes[ $now->toDateString() ][ $service->number ] = $driver;
							    } else {
								    if ( $substitute === false ) {
									    echo "Servicio número {$service->number}: No existe conductor ni sustituto. Esperamos siguiente iteración.<br>";
									    $cuadrantes[ $now->toDateString() ][ $service->number ] = false;
								    } else {
									    echo "Servicio número {$service->number}: Conductor {$substitute->getCompleteName()} <br>";
									    $cuadrantes[ $now->toDateString() ][ $service->number ] = $substitute;
								    }
							    }
						    } else {
							    echo "No se ha asignado valor inicial para este tema $calculoNormalizado<br>";
						    }
					    }

					    // Por si hay servicios dentro de un grupo que no tienen condición. Suele ocurrir los sábados.
					    if ( sizeof($conditions) < sizeof($services) ) {
						    echo "<br>Tenemos menos condiciones que servicios<br><br>";
							foreach ($services as $service) {
								if (!in_array($service->id, $serviciosAsignados)) {
									echo "<b>No existe una condición para el servicio {$service->number}</b>. Se puede asignar cualquier conductor.<br><br>";
									$cuadrantes[ $now->toDateString() ][ $service->number ] = false;
								}
							}
					    }

					    $now->addDay();
					    echo "<br>";
				    }
			    }
		    }
		    
		    $horasTrabajadasSemana = array();
		    $cuadranteFinal = array();
		    $conductorServicio13Sabado = null;
		    $conductoresLinea3Semana = array();

		    foreach ( $cuadrantes as $day => $services ) {
			    echo "<br><br><b>$day</b><br>";
			    echo "<b>-------------------</b><br>";
			    $date = Carbon::createFromFormat('Y-m-d', $day)->setTime(0, 0, 0);
			    $drivers = array();

			    ksort( $services );
			    foreach ( $services as $service => $driver ) {
				    if (isset($driver) && $driver !== false ) {
					    $drivers[]=$driver->id;
				    }
			    }

			    $conductoresEspecialesDomingo = array();
			    if ($date->dayOfWeek == Carbon::SUNDAY) {
				    //No podemos asignar como replacement para el domingo al conductor que haya realizado el servicio 13 el sábado
				    $conductorServicio13Sabado = $cuadranteFinal[ $date->addDays(-1)->toDateString() ][ 13 ];
				    $drivers[] = $conductorServicio13Sabado->id;

				    // Tampoco podemos asignar como replacements a los 5 conductores que seleccionemos para los servicios 28, 29, 30, 33 y 34 del domingo
				    shuffle($conductoresLinea3Semana);
				    foreach ($conductoresLinea3Semana as $conductorLinea3) {
				    	if (!$conductorLinea3->isInHolidays( $date, $conductorLinea3->holidays ) && $horasTrabajadasSemana[$conductorLinea3->id] < 5) {
				    		$conductoresEspecialesDomingo[] = $conductorLinea3;
						    $drivers[] = $conductorLinea3->id;
						    if (sizeof($conductoresEspecialesDomingo) == 5) break;
					    }
				    }
			    }
			    $replacements = $this->getReplacements($drivers, $date, $date->dayOfWeek, $horasTrabajadasSemana);

			    echo "<br>Sustitutos disponibles<br>";
			    echo "------------------------<br>";
			    foreach ($replacements as $replacement) {
				    echo "{$replacement->getCompleteName()};";
				    if (isset($horasTrabajadasSemana[ $replacement->id ]))
				        echo "Días trabajados semana: {$horasTrabajadasSemana[ $replacement->id ]}";
				    else
					    echo "Días trabajados semana: 0";
				    echo "<br>";
			    }
			    echo "<br>Servicios asignados<br>";
			    echo "------------------------<br>";
			    foreach ( $services as $service => $driver ) {
			    	echo "Service $service;";
				    if ( $driver === false ) {
					    if ( sizeof( $replacements ) > 0 ) {
						    shuffle( $replacements );
						    $replacement = array_pop( $replacements );
						    echo "{$replacement->getCompleteName()};Sustituto;<br>";
						    $cuadranteFinal[ $date->toDateString() ][ $service ] = $replacement;
					    } else {
						    $cuadranteFinal[ $date->toDateString() ][ $service ] = false;
						    echo "No quedan sustitutos disponibles;<br>";
					    }
				    } elseif ($driver === null) {
				    	if ($service == 13) {
						    // Servicio 13 el domingo que ha de ser realizado por el que hizo el servicio 13 el sábado
						    echo "Ha de ser realizado por el del sábado anterior.";
						    $cuadranteFinal[ $date->toDateString() ][ $service ] = $conductorServicio13Sabado;
					    } else {
					    	// Servicios 28, 29, 30, 33 y 34 del domingo
						    if (sizeof($conductoresEspecialesDomingo > 0)) {
							    $cuadranteFinal[ $date->toDateString() ][ $service ] = array_pop( $conductoresEspecialesDomingo );
						    } else {
							    $cuadranteFinal[ $date->toDateString() ][ $service ] = false;
						    }
					    }
				    } else {
					    $cuadranteFinal[ $date->toDateString() ][ $service ] = $driver;
				    }
					$selectedDriver = $cuadranteFinal[ $date->toDateString() ][ $service ];

				    if (isset($selectedDriver) && $selectedDriver !== false ) {
				    	if ($driver !== false) {
						    echo "{$selectedDriver->getCompleteName()};<br>";
					    }
					    if ( isset( $horasTrabajadasSemana[ $selectedDriver->id ] ) ) {
						    $horasTrabajadasSemana[ $selectedDriver->id ] ++;
					    } else {
						    $horasTrabajadasSemana[ $selectedDriver->id ] = 1;
					    }

					    if ( ! $date->isWeekend() && $service > 36 && $service < 49 ) {
						    if ( $selectedDriver->isRestDay( Weekday::SATURDAY, $selectedDriver->weekdays ) ) {
							    $conductoresLinea3Semana[ $selectedDriver->id ] = $selectedDriver;
						    }
					    }
				    }
			    }

			    echo "<br>Sustitutos libres<br>";
			    echo "------------------------<br>";
			    foreach ($replacements as $replacement) {
				    echo "{$replacement->getCompleteName()}<br>";
			    }
		    }
		    echo "<br>Días trabajados<br>";
		    echo "------------------------<br>";
		    ksort( $horasTrabajadasSemana );
		    foreach ($horasTrabajadasSemana as $driverId => $diasTrabajados) {
			    echo "$driverId: $diasTrabajados días trabajados<br>";
		    }
	    }

    }
}