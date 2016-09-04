<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Cuadrantes\Commons\CuadranteContract;
use Cuadrantes\Commons\ServiceContract;
use Cuadrantes\Commons\DriverContract;
use Cuadrantes\Commons\BusContract;

class CreateCuadrantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(CuadranteContract::TABLE_NAME, function (Blueprint $table) {
            $table->increments(CuadranteContract::ID);
	        $table->unsignedInteger(CuadranteContract::SERVICE_ID);
	        $table->unsignedInteger(CuadranteContract::DRIVER_ID)->nullable()->default(null);
	        $table->unsignedInteger(CuadranteContract::BUS_ID)->nullable()->default(null);
	        $table->date(CuadranteContract::DATE);
	        $table->boolean(CuadranteContract::SUBSTITUTE)->default(false);
	        $table->softDeletes();
            $table->timestamps();

	        $table->foreign(CuadranteContract::SERVICE_ID)->references(ServiceContract::ID)->on(ServiceContract::TABLE_NAME);
	        $table->foreign(CuadranteContract::DRIVER_ID)->references(DriverContract::ID)->on(DriverContract::TABLE_NAME);
	        $table->foreign(CuadranteContract::BUS_ID)->references(BusContract::ID)->on(BusContract::TABLE_NAME);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(CuadranteContract::TABLE_NAME);
    }
}
