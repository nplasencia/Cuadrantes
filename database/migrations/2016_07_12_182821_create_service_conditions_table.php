<?php

use Cuadrantes\Commons\ServiceConditionContract;
use Cuadrantes\Commons\DriverContract;
use Cuadrantes\Commons\PeriodContract;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceConditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(ServiceConditionContract::TABLE_NAME, function (Blueprint $table) {
            $table->increments(ServiceConditionContract::ID);
            $table->unsignedInteger(ServiceConditionContract::PERIOD_ID);
            $table->unsignedInteger(ServiceConditionContract::SERVICE_GROUP);
            $table->unsignedInteger(ServiceConditionContract::DRIVER_ID);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign(ServiceConditionContract::PERIOD_ID)->references(PeriodContract::ID)->on(PeriodContract::TABLE_NAME);
            $table->foreign(ServiceConditionContract::DRIVER_ID)->references(DriverContract::ID)->on(DriverContract::TABLE_NAME);

            $table->unique( [ServiceConditionContract::PERIOD_ID, ServiceConditionContract::SERVICE_GROUP, ServiceConditionContract::DRIVER_ID] );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(ServiceConditionContract::TABLE_NAME);
    }
}
