<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Cuadrantes\Commons\ServiceTimetablesContract;
use Cuadrantes\Commons\ServiceContract;
use Cuadrantes\Commons\TimetableContract;

class CreateServiceTimetablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(ServiceTimetablesContract::TABLE_NAME, function (Blueprint $table) {
            $table->increments(ServiceTimetablesContract::ID);
            $table->unsignedInteger(ServiceTimetablesContract::SERVICE_ID);
            $table->unsignedInteger(ServiceTimetablesContract::TIMETABLE_ID);
            $table->string(ServiceTimetablesContract::COLOUR, 6);

            $table->foreign(ServiceTimetablesContract::SERVICE_ID)->references(ServiceContract::ID)->on(ServiceContract::TABLE_NAME);
            $table->foreign(ServiceTimetablesContract::TIMETABLE_ID)->references(TimetableContract::ID)->on(TimetableContract::TABLE_NAME);

            $table->unique( [ServiceTimetablesContract::SERVICE_ID, ServiceTimetablesContract::TIMETABLE_ID] );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(ServiceTimetablesContract::TABLE_NAME);
    }
}
