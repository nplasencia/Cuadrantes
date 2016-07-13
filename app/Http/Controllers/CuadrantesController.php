<?php

namespace Cuadrantes\Http\Controllers;

use Cuadrantes\Commons\ServiceGroupOrderContract;
use Cuadrantes\Entities\ServiceCondition;
use Cuadrantes\Repositories\ServiceConditionRepository;
use Cuadrantes\Repositories\ServiceGroupOrderRepository;
use Cuadrantes\Repositories\ServiceRepository;
use Cuadrantes\Repositories\WeekdayRepository;
use Cuadrantes\Http\Requests;

use Carbon\Carbon;

class CuadrantesController extends Controller
{
    private $serviceConditionRepository;
    private $serviceRepository;
    private $weekdayRepository;
    private $serviceGroupOrderRepository;

    public function __construct(ServiceConditionRepository $serviceConditionRepository, ServiceRepository $serviceRepository,
                                WeekdayRepository $weekdayRepository, ServiceGroupOrderRepository $serviceGroupOrderRepository)
    {
        $this->serviceConditionRepository  = $serviceConditionRepository;
        $this->serviceRepository = $serviceRepository;
        $this->weekdayRepository = $weekdayRepository;
        $this->serviceGroupOrderRepository = $serviceGroupOrderRepository;
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
            $orderedOrders[$order->driver_id][$order->normalized] = $order->service_id;
        }
        return $orderedOrders;
    }

    private function comprobaciones($services, $conditions)
    {
        // Comprobaciones
        $driversCount = 0;
        foreach ($conditions as $condition) {
            $driversCount += $condition->getDriversCount();
        }

        // 1. El número de conductores debe de cuadrar con el número de servicios
        if (sizeof($services) != $driversCount) {
            return "El número de conductores no coincide con el número de servicios.";
        }
        // 2. El número de días de descanso dentro del periodo debe ser menor o igual que el número de conductores sustitutos

        // 3. No pueden coincidir las vacaciones de
        return true;
    }

    private function getLastWeekData()
    {
        return false;
    }

    public function complexAlgorithm()
    {
        $servicesConditions = $this->getConditions();
        $services = $this->getServices();
        $weekdays = $this->getWeekdays();
        $groupServiceOrders = $this->getServiceGroupOrder();

        foreach ($services as $period => $groups) {
            foreach ($groups as $group => $services) {
                if (!isset($servicesConditions[$period][$group])) {
                    continue;
                }
                $conditions = $servicesConditions[$period][$group];

                $now = new Carbon();
                $now = $now->startOfWeek();
                foreach ($weekdays[$period] as $weekday) {
                    echo "Miramos el día {$weekday->value}<br>";

                    foreach ($conditions as $condition) {
                        foreach ($condition->pair->drivers as $driver) {

                            if ($driver->isInHolidays($now, $driver->holidays)) {
                                echo "El conductor {$driver->getCompleteName()} <b>está de vacaciones</b> este día.
                                      Hacemos uso de un sustituto mirando si el servicio era de mañana o tarde<br>";
                            } else if ($driver->isRestDay($weekday, $driver->restDays)) {
                                echo "El conductor {$driver->getCompleteName()} <b>descansa</b> este día.<br>";
                            } else {
                                $calculoNormalizado = ($now->weekOfYear/sizeof($services) - floor($now->weekOfYear/sizeof($services)))*sizeof($services);
                                if( isset($groupServiceOrders[$driver->id][$calculoNormalizado])) {
                                    echo "El conductor {$driver->getCompleteName()} se asigna al servicio número {$groupServiceOrders[$driver->id][$calculoNormalizado]}<br>";
                                } else {
                                    echo "No se ha asignado valor inicial para este tema<br>";
                                }
                            }

                        }
                    }
                    $now->addDay();
                    echo "<br>";
                }
            }
        }


    }
}
