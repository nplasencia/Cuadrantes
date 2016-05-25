<?php

use Illuminate\Database\Seeder;
use Cuadrantes\Entities\Route;

class RouteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $routes = [['1', 'Arrecife', 'Costa Teguise', true], ['1', 'Costa Teguise', 'Arrecife', false],
            ['2', 'Arrecife', 'Puerto del Carmen', true], ['2', 'Puerto del Carmen', 'Arrecife', false],
            ['3', 'Costa Teguise', 'Puerto del Carmen', true], ['3', 'Puerto del Carmen', 'Costa Teguise', false],
            ['4', 'Arrecife', 'Femés', true], ['4', 'Femés', 'Arrecife', false],
            ['5', 'Arrecife', 'Playa Blanca', true], ['5', 'Playa Blanca', 'Arrecife', false],
            ['6', 'Arrecife', 'Máguez', true], ['6', 'Máguez', 'Arrecife', false],
            ['7', 'Arrecife', 'Órzola', true], ['7', 'Órzola', 'Arrecife', false],
            ['8', 'Arrecife', 'Los Valles', true], ['8', 'Los Valles', 'Arrecife', false],
            ['9', 'Costa Teguise', 'Teguise Market', true], ['9', 'Teguise Market', 'Costa Teguise', false],
            ['10', 'Puerto del Carmen', 'Teguise Market', true], ['10', 'Teguise Market', 'Puerto del Carmen', false],
            ['11', 'Playa Blanca', 'Teguise Market', true], ['11', 'Teguise Market', 'Playa Blanca', false],
            ['12', 'Arrecife', 'Teguise Market', true], ['12', 'Teguise Market', 'Arrecife', false],
            ['13', 'Tinajo', 'Arrecife', true], ['13', 'Arrecife', 'Tinajo', false],
            ['14', 'Arrecife', 'La Santa', true], ['14', 'La Santa', 'Arrecife', false],
            ['15', 'Arrecife - Conil', 'La Asomada', true], ['15', 'La Asomada', 'Arrecife - Conil', false],
            ['16', 'Arrecife', 'Caleta de Famara', true], ['16', 'Caleta de Famara', 'Arrecife', false],
            ['17', 'Arrecife', 'Playa Honda', true], ['17', 'Playa Honda', 'Arrecife', false],
            ['18', 'Arrecife', 'Aeropuerto', true], ['18', 'Aeropuerto', 'Arrecife', false],
            ['19', 'Arrecife - Playa Honda', 'Aeropuerto', true], ['19', 'Aeropuerto', 'Arrecife - Playa Honda', false],
            ['20', 'Arrecife', 'Puerto Calero', true], ['20', 'Puerto Calero', 'Arrecife', false],
            ['21', 'Costa Teguise', 'Puerto Calero', true], ['21', 'Puerto Calero', 'Costa Teguise', false],
            ['22', 'Arrecife', 'Yé', true], ['22', 'Yé', 'Arrecife', false],
            ['23', '', 'Interior de Playa Blanca', true],
            ['24', 'Playa Honda - San Bartolomé', 'Arrecife', true], ['24', 'Arrecife', 'Playa Honda - San Bartolomé', false],
            ['25', 'Arrecife', 'Instituto de Yaiza', true], ['25', 'Instituto de Yaiza', 'Arrecife', false],
            ['26', 'La Santa', 'Los Valles', true], ['26', 'Los Valles', 'La Santa', false],
            ['27', 'La Santa', 'Teguise', true], ['27', 'Teguise', 'La Santa', false],
            ['28', 'Arrecife', 'Playa Blanca', true], ['28', 'Playa Blanca', 'Arrecife', false],
            ['29', 'Puerto del Carmen', 'Tías', true], ['29', 'Tías', 'Puerto del Carmen', false],
            ['30', 'Aeropuerto', 'Playa Blanca', true], ['30', 'Playa Blanca', 'Aeropuerto', false],
            ['31', '', 'Interior de Tías (hasta Mácher Bajo)', true],
            ['32', '', 'Interior de Tías', true],
            ['33', 'Aeropuerto', 'Playa Blanca', true], ['33', 'Playa Blanca', 'Aeropuerto', false],
            ['34', 'Costa Teguise - Teguise', 'Caleta de Famara', true], ['34', 'Caleta de Famara', 'Costa Teguise - Teguise', false],
            ['35', 'Costa Teguise - Teguise - Caleta de Famara', 'Muñique', true], ['35', 'Muñique', 'Costa Teguise - Teguise - Caleta de Famara', false],
            ['36', 'Playa Blanca', 'Aeropuerto', true], ['36', 'Aeropuerto', 'Playa Blanca', false]];

        foreach ($routes as $routeArray) {
            $route = new Route();
            $route->line_id = $routeArray[0];
            $route->origin  = $routeArray[1];
            $route->destiny = $routeArray[2];
            $route->go      = $routeArray[3];
            $route->save();
        }
    }
}
