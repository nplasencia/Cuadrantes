<?php

namespace Cuadrantes\Http\Controllers;

use Cuadrantes\Entities\Cuadrante;
use Cuadrantes\Entities\Driver;
use Cuadrantes\Entities\Period;
use Cuadrantes\Entities\Weekday;
use Cuadrantes\Repositories\CuadranteRepository;
use Cuadrantes\Repositories\DriverRepository;
use Cuadrantes\Repositories\ServiceConditionRepository;
use Cuadrantes\Repositories\ServiceGroupOrderRepository;
use Cuadrantes\Repositories\ServiceRepository;
use Cuadrantes\Repositories\ServiceSubstituteRepository;
use Cuadrantes\Repositories\WeekdayRepository;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class CuadrantesController extends Controller
{
    private $serviceConditionRepository;
	private $serviceSubstituteRepository;
    private $serviceRepository;
    private $weekdayRepository;
    private $serviceGroupOrderRepository;
	private $driverRepository;
	private $substitutes;
	private $cuadranteRepository;

    public function __construct(ServiceConditionRepository $serviceConditionRepository, ServiceRepository $serviceRepository,
                                WeekdayRepository $weekdayRepository, ServiceGroupOrderRepository $serviceGroupOrderRepository,
								ServiceSubstituteRepository $serviceSubstituteRepository, DriverRepository $driverRepository,
								CuadranteRepository $cuadranteRepository)
    {
        $this->serviceConditionRepository  = $serviceConditionRepository;
        $this->serviceRepository = $serviceRepository;
        $this->weekdayRepository = $weekdayRepository;
        $this->serviceGroupOrderRepository = $serviceGroupOrderRepository;
	    $this->serviceSubstituteRepository = $serviceSubstituteRepository;
	    $this->driverRepository = $driverRepository;
	    $this->cuadranteRepository = $cuadranteRepository;
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

    private function getSubstitute($today, $weekday)
    {
    	if ($this->substitutes === null || sizeof($this->substitutes) == 0) {
    		echo " No existen sustitutos o no quedan.<br>";
    		return false;
	    }
	    shuffle($this->substitutes);

	    $substitute = array_pop($this->substitutes);
	    if ($substitute->isRestDay( $weekday, $substitute->restDays ) || $substitute->isInHolidays( $today, $substitute->holidays )) {
	    	echo " El sustituto {$substitute->completeName} está de vacaciones o de descanso para este día.";
	    	return $this->getSubstitute($today, $weekday);
	    }
	    return $substitute;
    }

    private function getServiceTime(Driver $driver, Carbon $date, Collection $driverRestDays = null)
	{
		// Siempre tengo que saber qué servicio realizó el conductor la semana anterior el primer día después del último día de descanso.
		$lastRestingDay = $driver->getLastRestingDay($driverRestDays);
		if ($lastRestingDay == null) {
			dd('ProblemaRestingDay', $driver);
		}
		$dayAfterRestWeekBefore = Carbon::create()->addWeeks(-1)->startOfWeek()->addDays($lastRestingDay->id);
		$lastCuadrante = $this->cuadranteRepository->getByServiceDateDriver($dayAfterRestWeekBefore, $driver);
		if($lastCuadrante == null) {
			$lastServiceTime = array_rand(['morning', 'afternoon']);
		} else {
			$lastServiceTime = $lastCuadrante->service->time;
		}

		if ($driver->isDayAfterResting($date, $driverRestDays)) {
			if ($lastServiceTime == 'morning') {
				return 'afternoon';
			}
			return 'morning';
		} else {
			return $lastServiceTime;
		}

	}

    private function getReplacements(Array $drivers,Carbon $today, $weekday, Array $horasTrabajadasSemana)
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
		    $newServiceTime = $this->getServiceTime($replacement, $today, $replacement->restDays);
		    $replacements[$newServiceTime][] = $replacement;
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

	    //Eliminamos todos aquellos servicios almacenados en la base de datos cuya fecha sea mayor a hoy
		$this->cuadranteRepository->deleteAllAfterDate(new Carbon());

	    for ($i=0; $i<8;$i++) {
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
					    if (!$now->isFuture()) {
					    	echo "No analizamos el día {$now->day} porque es pasado<br>";
						    continue;
					    }

					    if ( !isset( $servicesConditions[ $period ][ $group ] ) ) {
					    	if ($period == Period::SUNDAY && $services[0]->number == 13) {
							    echo "<b>Condición programada manualmente: Conductor que haga el servicio 13 el sábado.<br></b>";
							    $cuadrantes[ $now->toDateString() ][ "{$services[0]->id}-{$services[0]->time}" ] = null;
						    } elseif ($period == Period::SUNDAY && $services[0]->number == 28) {
							    echo "<b>Condición programada manualmente para servicios 28, 29, 30, 33 y 34: Conductor que haga servicio 3 durante la semana y libre sábado.<br></b>";
							    foreach ( $services as $service ) {
								    $cuadrantes[ $now->toDateString() ][ "{$service->id}-{$service->time}" ] = null;
							    }
						    } else {
							    foreach ( $services as $service ) {
								    echo "<b>No existe una condición para el servicio {$service->number}</b>. Se puede asignar cualquier conductor.<br><br>";
								    $cuadrantes[ $now->toDateString() ][ "{$service->id}-{$service->time}" ] = false;
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
							    echo "El conductor {$driver->completeName} <b>está de vacaciones</b> este día. Buscamos sustituto.";
							    if ( ! isset( $substitutions[ $driver->id ] ) ) {
								    $substitutions[ $driver->id ] = $this->getSubstitute( $now, $weekday );
							    }
							    $substitute = $substitutions[ $driver->id ];

						    } else if ( $driver->isRestDay( $weekday, $driver->restDays ) ) {
							    echo "El conductor {$driver->completeName} <b>descansa</b> este día. Buscamos sustituto.";
							    if ( ! isset( $substitutions[ $driver->id ] ) ) {
								    $substitutions[ $driver->id ] = $this->getSubstitute( $now, $weekday );
							    }
							    $substitute = $substitutions[ $driver->id ];
						    }

						    if ( isset( $groupServiceOrders[ $period ] [ $group ] [ $driver->id ][ $calculoNormalizado ] ) ) {
							    $service = $groupServiceOrders[ $period ] [ $group ] [ $driver->id ][ $calculoNormalizado ];
							    $serviciosAsignados[] = $service->id;
							    if ( $substitute === null ) {
								    echo "Servicio número {$service->number}: Conductor {$driver->completeName} <br>";
								    $cuadrantes[ $now->toDateString() ][ "{$service->id}-{$service->time}" ] = $driver;
							    } else {
								    if ( $substitute === false ) {
									    echo "Servicio número {$service->number}: No existe conductor ni sustituto. Esperamos siguiente iteración.<br>";
									    $cuadrantes[ $now->toDateString() ][ "{$service->id}-{$service->time}" ] = false;
								    } else {
									    echo "Servicio número {$service->number}: Conductor {$substitute->completeName} <br>";
									    $cuadrantes[ $now->toDateString() ][ "{$service->id}-{$service->time}" ] = $substitute;
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
									$cuadrantes[ $now->toDateString() ][ "{$service->id}-{$service->time}" ] = false;
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
				    //TODO: Esto tengo que arreglarlo sí o sí
				    $conductorServicio13Sabado = $cuadranteFinal[ $date->addDays(-1)->toDateString() ][ 75 ];
				    $date->addDay();
				    $drivers[] = $conductorServicio13Sabado->id;

				    // Tampoco podemos asignar como replacements a los 5 conductores que seleccionemos para los servicios 28, 29, 30, 33 y 34 del domingo
				    shuffle($conductoresLinea3Semana);
				    foreach ($conductoresLinea3Semana as $conductorLinea3) {
				    	if (!$conductorLinea3->isInHolidays( $date, $conductorLinea3->holidays ) && $horasTrabajadasSemana[$conductorLinea3->id] < 5) {
				    		$conductoresEspecialesDomingo[] = $conductorLinea3;
						    $drivers[] = $conductorLinea3->id;
						    //if (sizeof($conductoresEspecialesDomingo) == 5) break;
					    }
				    }
			    }

			    $replacements = $this->getReplacements($drivers, $date, $date->dayOfWeek, $horasTrabajadasSemana);

			    echo "<br>Sustitutos disponibles mañanas<br>";
			    echo "------------------------<br>";
			    foreach ($replacements['morning'] as $replacement) {
				    echo "{$replacement->completeName};";
				    if (isset($horasTrabajadasSemana[ $replacement->id ]))
				        echo "Días trabajados semana: {$horasTrabajadasSemana[ $replacement->id ]}";
				    else
					    echo "Días trabajados semana: 0";
				    echo "<br>";
			    }
			    echo "<br>Sustitutos disponibles tardes<br>";
			    echo "------------------------<br>";
			    foreach ($replacements['afternoon'] as $replacement) {
				    echo "{$replacement->completeName};";
				    if (isset($horasTrabajadasSemana[ $replacement->id ]))
					    echo "Días trabajados semana: {$horasTrabajadasSemana[ $replacement->id ]}";
				    else
					    echo "Días trabajados semana: 0";
				    echo "<br>";
			    }
			    echo "<br>Servicios asignados<br>";
			    echo "------------------------<br>";
			    foreach ( $services as $serviceAndTime => $driver ) {
			    	$service = explode('-',$serviceAndTime)[0];
				    $serviceTime = explode('-',$serviceAndTime)[1];
			    	$cuadrante = new Cuadrante();
				    $cuadrante->service_id = $service;
				    $cuadrante->date = $date;

			    	echo "Service $service;";
				    if ( $driver === false ) {
					    $otherServiceTime = 'morning';
				    	if ($serviceTime == 'morning') {
				    		$otherServiceTime = 'afternoon';
					    }
					    if ( sizeof( $replacements[$serviceTime] ) > 0 ) {
						    shuffle( $replacements[$serviceTime] );
						    $replacement = array_pop( $replacements[$serviceTime] );
						    echo "{$replacement->completeName};Sustituto;<br>";
						    $cuadranteFinal[ $date->toDateString() ][ $service ] = $replacement;
						    $cuadrante->driver_id = $replacement->id;
						    $cuadrante->substitute = true;
					    } else if ( sizeof( $replacements[$otherServiceTime] ) > 0) {
						    shuffle( $replacements[$otherServiceTime] );
						    $replacement = array_pop( $replacements[$otherServiceTime] );
						    echo "{$replacement->completeName};Sustituto;<br>";
						    $cuadranteFinal[ $date->toDateString() ][ $service ] = $replacement;
						    $cuadrante->driver_id = $replacement->id;
						    $cuadrante->substitute = true;
					    } else {
						    $cuadranteFinal[ $date->toDateString() ][ $service ] = false;
						    echo "No quedan sustitutos disponibles;<br>";
					    }
				    } elseif ($driver === null) {
				    	// El servicio 13 el domingo
				    	if ($service == 75) {
						    // Servicio 13 el domingo que ha de ser realizado por el que hizo el servicio 13 el sábado
						    echo "Ha de ser realizado por el del sábado anterior.";
						    $cuadranteFinal[ $date->toDateString() ][ $service ] = $conductorServicio13Sabado;
					    } else {
					    	// Servicios 28, 29, 30, 33 y 34 del domingo

						    if (!empty($conductoresEspecialesDomingo)) {
						    	$conductorSeleccionado = array_pop( $conductoresEspecialesDomingo );
							    $cuadranteFinal[ $date->toDateString() ][ $service ] = $conductorSeleccionado;
						    } else {
							    $cuadranteFinal[ $date->toDateString() ][ $service ] = false;
						    }
					    }
				    } else {
					    $cuadranteFinal[ $date->toDateString() ][ $service ] = $driver;
				    }
					$selectedDriver = $cuadranteFinal[ $date->toDateString() ][ $service ];
				    if ($selectedDriver !== false)
				        $cuadrante->driver_id = $selectedDriver->id;
				    else
					    $cuadrante->driver_id = null;

				    $cuadrante->save();

				    if (isset($selectedDriver) && $selectedDriver !== false ) {
				    	if ($driver !== false) {
						    echo "{$selectedDriver->completeName};<br>";
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

			    echo "<br>Sustitutos libres mañanas<br>";
			    echo "------------------------<br>";
			    foreach ($replacements['morning'] as $replacement) {
				    echo "{$replacement->completeName}<br>";
			    }

			    echo "<br>Sustitutos libres tardes<br>";
			    echo "------------------------<br>";
			    foreach ($replacements['afternoon'] as $replacement) {
				    echo "{$replacement->completeName}<br>";
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