<?php

use Cuadrantes\Commons\PeriodContract;
use Cuadrantes\Commons\ServiceContract;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(ServiceContract::TABLE_NAME, function (Blueprint $table) {
            $table->increments(ServiceContract::ID);
            $table->unsignedInteger(ServiceContract::PERIOD_ID);
            $table->enum(ServiceContract::TIME, ['morning', 'afternoon']);
            $table->unsignedSmallInteger(ServiceContract::NUMBER);
            $table->unsignedSmallInteger(ServiceContract::GROUP);
            $table->boolean(ServiceContract::AUX);
            $table->timestamps();

            $table->foreign(ServiceContract::PERIOD_ID)->references(PeriodContract::ID)->on(PeriodContract::TABLE_NAME);

            $table->unique( [ServiceContract::PERIOD_ID, ServiceContract::TIME, ServiceContract::NUMBER] );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(ServiceContract::TABLE_NAME);
    }
}
