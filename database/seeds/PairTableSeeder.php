<?php

use Illuminate\Database\Seeder;

use Cuadrantes\Entities\Pair;
use Cuadrantes\Commons\PairContract;

class PairTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pairsData = [[1,10],[1,24],[2,49],[2,40],[3,9],[3,16],[4,3],[4,25],[5,43],[5,30],[6,17],[6,12],[7,8],[7,52],[8,41],[8,39],
                      [9,18],[9,47],[10,46],[10,14],[11,5],[11,6],[11,2],[12,4],[12,37],[13,36],[13,38],[14,44],[14,28],[15,48],[15,1],
	                  [16,11],[16,45],[17,58],[17,59],[18,20],[18,22],[19,29],[19,7],[20,32],[20,27],[21,31],[21,15],[22,19],[22,13],[23,55],[23,35],
                      [24,53],[24,67],[25,61],[25,72],[26,33],[26,34],[27,50],[27,74],[28,69],[28,71],[29,73],[29,78],[30,21],[30,54],
                      [31,51],[31,80],[32,77],[32,57],[33,64],[33,66],[34,56],[34,75],[35,68],[35,62],
                      ];
        
        foreach ($pairsData as $pairData) {
            $pair = new Pair([PairContract::PAIR_ID => $pairData[0], PairContract::DRIVER_ID => $pairData[1]]);
            $pair->save();
        }
    }
}