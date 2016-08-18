<?php

use Cuadrantes\Commons\ServiceSubstituteContract;
use Cuadrantes\Commons\DriverContract;
use Cuadrantes\Commons\PeriodContract;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceSubstitutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(ServiceSubstituteContract::TABLE_NAME, function (Blueprint $table) {
            $table->increments(ServiceSubstituteContract::ID);
            $table->unsignedInteger(ServiceSubstituteContract::PERIOD_ID);
            $table->unsignedInteger(ServiceSubstituteContract::SERVICE_GROUP);
            $table->unsignedInteger(ServiceSubstituteContract::DRIVER_ID);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign(ServiceSubstituteContract::PERIOD_ID)->references(PeriodContract::ID)->on(PeriodContract::TABLE_NAME);
            $table->foreign(ServiceSubstituteContract::DRIVER_ID)->references(DriverContract::ID)->on(DriverContract::TABLE_NAME);

            $table->unique( [ServiceSubstituteContract::PERIOD_ID, ServiceSubstituteContract::SERVICE_GROUP, ServiceSubstituteContract::DRIVER_ID] );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(ServiceSubstituteContract::TABLE_NAME);
    }
}
