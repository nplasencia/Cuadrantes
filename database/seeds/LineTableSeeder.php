<?php

use Illuminate\Database\Seeder;
use Cuadrantes\Entities\Line;

class LineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lines = ['1'=>'Arrecife - Costa Teguise','2'=>'Arrecife - Puerto del Carmen','3'=>'Costa Teguise - Puerto del Carmen',
                  '5'=>'Arrecife - Femés','6'=>'Arrecife - Playa Blanca','7'=>'Arrecife - Máguez','9'=>'Arrecife - Órzola',
                  '10'=>'Arrecife - Los Valles','11'=>'Costa Teguise - Teguise Market','12'=>'Puerto del Carmen - Teguise Market',
                  '13'=>'Playa Blanca - Teguise Market','14'=>'Arrecife - Teguise Market','15'=>'Tinajo - Arrecife','16'=>'Arrecife - La Santa',
                  '19'=>'Arrecife - Conil - La Asomada','20'=>'Arrecife - Caleta de Famara','21'=>'Arrecife - Playa Honda',
                  '22'=>'Arrecife - Aeropuerto','23'=>'Arrecife - Playa Honda - Aeropuerto','24'=>'Arrecife - Puerto Calero',
                  '25'=>'Costa Teguise - Puerto Calero','26'=>'Arrecife - Yé','30'=>'Interior de Playa Blanca','32'=>'Playa Honda - San Bartolomé - Arrecife',
                  '42'=>'Arrecife - Instituto de Yaiza','52'=>'La Santa - Los Valles','53'=>'La Santa - Teguise','60'=>'Arrecife - Playa Blanca',
                  '134'=>'Puerto del Carmen - Tías','161'=>'Aeropuerto - Playa Blanca','234'=>'Interior de Tías (hasta Mácher Bajo)',
                  '334'=>'Interior de Tías','61'=>'Aeropuerto - Playa Blanca','31'=>'Costa Teguise - Teguise - Caleta de Famara',
                  '33'=>'Costa Teguise - Teguise - Caleta de Famara - Muñique', '261'=>'Playa Blanca - Aeropuerto'];

        foreach ($lines as $number => $name) {
            $line = new Line();
            $line->number = $number;
            $line->name   = $name;
            $line->save();
        }
    }
}
