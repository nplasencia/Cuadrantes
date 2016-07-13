<?php

use Cuadrantes\Commons\PairContract;
use Cuadrantes\Commons\DriverContract;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(PairContract::TABLE_NAME, function (Blueprint $table) {
            $table->increments(PairContract::ID);
            $table->unsignedInteger(PairContract::PAIR_ID);
            $table->unsignedInteger(PairContract::DRIVER_ID);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign(PairContract::DRIVER_ID)->references(DriverContract::ID)->on(DriverContract::TABLE_NAME);

            $table->unique( [PairContract::PAIR_ID, PairContract::DRIVER_ID] );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(PairContract::TABLE_NAME);
    }
}
