<?php

use Illuminate\Database\Seeder;
use Cuadrantes\Entities\Driver;

class DriverTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(Driver::class, 100)->create();
        
        $drivers = [['Fernandez Toribio','Marcial',680523539,2145,'2017-6-23','2021-6-28'],['Garcia Perez','Ana Maria',607846351,2106,'2016-6-2','2022-10-26'],['Garcia Macias','Blanca',690950144,2114,'2018-7-13','2022-10-15'],['Garcia Martin','Pedro Ramon',660332301,2158,'2019-6-3','2023-6-5'],['Dominguez De Leon','Jose',608939059,2133,'2016-6-2','2021-6-4'],['Rodriguez Madrona','Dolores',687842498,2148,'2020-8-28','2021-8-16'],['Soto Sanchez','Socorro',659417612,2163,'2016-6-2','2023-7-22'],['Toro  Alcaide','Jose Manuel',606357276,2135,'2019-6-27','2024-5-14'],['Santana Betancort','Margarita',699146792,2146,'2016-7-13','2020-10-6'],
                    ['Munoz Garcia','Aida',679643079,2140,'2019-8-27','2021-3-9'],['Pedraza Roda','Gerardo',666336416,2124,'2019-6-9','2025-5-7'],['Peraza Martin','Antonio Juan',628538500,2108,'2016-6-2','2022-1-18'],['Regueira Fernandez','Eugenia',644353280,2121,'2017-6-23','2023-4-26'],['Valdivia Coaquira','Jules Isaldo',629962649,2141,'2020-8-28','2018-1-25'],['Lopez Herrera','Ricardo',660020277,2137,'2017-6-23','2020-2-25'],['Robayna De Leon','Jesus Orlando',609251722,2157,'2019-8-27','2021-3-3'],['Perez Valido','Alexi',601182098,2104,'2019-1-31','2025-8-16'],['Garcia Moreno','Antonio',685648851,2107,'2020-8-28','2022-11-24'],
                    ['Hernandez Santos','Sergio',636552226,2169,'2016-4-13','2025-11-10'],['Marquez Morales','Soraya',657189906,2165,'2016-6-2','2025-3-16'],['Estevez Perez','Joaquin',637393861,2130,'2020-8-28','2020-11-11'],['Caraballo Nieves','Yasimara',699689912,2168,'2018-7-13','2021-1-24'],['Moreno Pablo','Juana',649036810,2154,'2018-9-2','2021-5-17'],['Calero Garcia','Aranzazu Del Pino',680147744,2110,'2016-6-2','2025-8-13'],['Reyes Dorta','Deysi',616776711,2117,'2019-6-3','2021-10-6'],['Barrios Benasco','Maria Auxiliadora',646603286,2147,'2017-6-23','2021-7-4'],['Sestayo Paris','Juan',691522354,2139,'2018-7-13','2022-3-23'],
                    ['Espino Delgado','Juan Jose',669083867,2138,'2019-6-27','2022-10-28'],['Gualupe Robayna','Nieves Mairena',696007534,2156,'2018-9-2','2022-7-27'],['Gonzalez Curbelo','Lourdes Maria',686644262,2142,'2018-7-13','2021-12-14'],['Benitez Moreno','Francisco',659417367,2112,'2018-7-13','2025-6-13'],['Solano Santolaria','Jose Manuel',619030262,2164,'2018-9-2','2017-5-4'],['Padron Hernandez','Nicolas Rafael',626366852,2155,'2020-8-28','2020-4-15'],['Pane Dullak','Martin Miguel',629834798,2150,'2018-9-2','2019-4-2'],['Hernandez Garcia','Ricardo',686581286,2159,'2017-6-23','2023-5-5'],['Caraballo Caraballo','Miguel',609546944,2153,'2018-9-2','2025-7-13'],
                    ['Riveiro Casais','Ernesto',646762176,2144,'2020-8-28','2022-2-28'],['Cedres Feo','Aquilino',637380857,2109,'2018-7-13','2022-6-6'],['Machin Feo','Eduardo',673346599,2119,'2016-6-3','2016-5-23'],['Perez Cabrera','Alexander',699582227,2103,'2019-6-3','2023-5-28'],['Laniella Cabo','Luis',618775811,2143,'2019-6-3','2022-8-24'],['El Karid','Abdesslam',651466722,2102,'2016-6-2','2021-4-1'],['Martinez Sanchez','Alonso',679780828,2105,'2018-7-13','2017-2-9'],['Brito Hernandez','Elisa',696900947,2120,'2016-10-8','2025-7-16'],['Diaz Ojeda','Francisco',680511638,2122,'2019-6-27','2021-7-28'],['Arias Fermin','Eddy Antonio',639982542,2118,'2016-10-8','2023-11-17'],
                    ['Benvindo','Albino',686182465,2113,'2016-6-2','2024-10-8'],['Curbelo','Jose Antonio',660297121,2132,'2016-10-8','2016-6-26'],['Cabrera Quintero','Miguel Angel',650435390,2152,'2020-8-28','2022-8-1'],['Parra Rodriguez','Wiliams',650681010,2167,'2016-10-8','2018-5-1'],['Robayna Tejera','Delia',639446734,2116,'2016-2-8','2020-12-20'],['Mendez Mendez','Irineo',639625765,2127,'2019-6-27','2021-7-8'],['Cid Camacho','Jorge A',687550803,2131,'2018-9-2','2021-10-24'],['Perez Garcia','Roberto Carlos',661752612,2160,'2016-10-4','2021-7-4'],['De La Cruz Quispe','Heder',639992637,2060,'2017-2-4','2021-9-23'],['Santana Bonilla','Daniel',616888325,2151,'2017-9-17','2021-4-18'],
                    ['Alvarez Martin','Victor',636242902,2136,'2018-9-13','2023-1-24'],['Arrocha Cabrera','Francisco',928815241,2149,'2018-1-11','2022-9-27'],['Hernandez Barrera','Manuel',609817018,2115,'2016-10-8','2021-5-27'],['Duran Manzano','Delia',609059760,2172,'2018-2-9','2021-3-22'],['Calero Rodriguez','Manuel',650430103,2128,'2018-7-12','2022-11-5'],['Gonzalez Morales','Ervigio Marcial','',2177,'2019-12-29','2020-1-21'],['Castellano Garcia','Clara Isabel',608219449,2180,'2019-1-9','2024-1-8'],['Fleitas Montesdeoca','Elionai',652502787,2175,'2017-8-14','2023-7-28'],['Martin Martin','Domingo Andres','',2181,'2016-11-28','2021-7-26'],
                    ['Taimal Caucali','Carlos Eduardo',622513411,2134,'2018-5-13','2022-11-12'],['Robayna Diaz','Francisco Miguel',620729204,2183,'2018-3-11','2022-4-17'],['Morales Rivera','Jesus Marcial',630104771,2184,'2020-2-8','2022-3-9'],['Tejerina Bandin','Hugo ',652239418,2125,'2017-11-30','2020-4-9'],['Mezu Ruiz','Ferney',669928981,2171,'2018-5-13','2023-7-1'],['De León Tabares','Antonio Silvestre',617443819,2174,'2020-1-13','2024-7-14'],['Fernánded Pedrero','Iván',686324908,2178,'2019-6-13','2020-5-11'],['Serrano Torres','Liliana',690826454,2179,'2017-10-31','2022-11-20'],['Suárez Armas','Luis',639724821,2173,'2016-7-27','2024-10-29'],
                    ['Álvarez Morales','Francisco Javier',609372234,2161,'2019-9-12','2024-4-25'],['Senande Caamaño','Jose Antonio',606637363,2111,'2019-12-18','2024-6-9'],['Hernández Hernández','Juan Fernando',620097462,2129,'2020-11-16','2025-9-22'],['Martín Da Cruz','Zorayda',686518069,2166,'2020-7-10','2025-3-23'],['Agudelo Vargas','Gustavo',636135328,2162,'2020-9-27','2025-3-23'],['Sierra Silgado','María Leonor',616045324,2131,'','2025-5-25'],['Carrasco Estévez','María José',670491826,2134,'2019-11-3','2024-2-3']
                   ];

        foreach ($drivers as $driverData) {
            $driver = new Driver();
            $driver->last_name         = $driverData[0];
            $driver->first_name        = $driverData[1];
            $driver->telephone         = $driverData[2];
            $driver->extension         = $driverData[3];
            $driver->cap               = $driverData[4];
            $driver->driver_expiration = $driverData[5];
            $driver->save();
        }
    }
}