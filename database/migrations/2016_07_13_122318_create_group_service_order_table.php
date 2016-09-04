<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Cuadrantes\Commons\ServiceGroupOrderContract;
use Cuadrantes\Commons\ServiceContract;
use Cuadrantes\Commons\DriverContract;
use Cuadrantes\Commons\PeriodContract;

class CreateGroupServiceOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(ServiceGroupOrderContract::TABLE_NAME, function (Blueprint $table) {
            $table->increments(ServiceGroupOrderContract::ID);
	        $table->unsignedInteger(ServiceGroupOrderContract::PERIOD_ID);
	        $table->unsignedInteger(ServiceGroupOrderContract::GROUP);
            $table->unsignedInteger(ServiceGroupOrderContract::DRIVER_ID);
            $table->unsignedInteger(ServiceGroupOrderContract::SERVICE_ID);
            $table->unsignedInteger(ServiceGroupOrderContract::NORMALIZED);
            $table->softDeletes();
            $table->timestamps();

	        $table->foreign(ServiceGroupOrderContract::PERIOD_ID)->references(PeriodContract::ID)->on(PeriodContract::TABLE_NAME);
            $table->foreign(ServiceGroupOrderContract::SERVICE_ID)->references(ServiceContract::ID)->on(ServiceContract::TABLE_NAME);
            $table->foreign(ServiceGroupOrderContract::DRIVER_ID)->references(DriverContract::ID)->on(DriverContract::TABLE_NAME);

            $table->unique([ServiceGroupOrderContract::DRIVER_ID, ServiceGroupOrderContract::SERVICE_ID, ServiceGroupOrderContract::NORMALIZED]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(ServiceGroupOrderContract::TABLE_NAME);
    }
}
