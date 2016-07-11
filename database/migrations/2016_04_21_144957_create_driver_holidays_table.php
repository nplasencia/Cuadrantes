<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Cuadrantes\Commons\DriverHolidayContract;
use Cuadrantes\Commons\DriverContract;

class CreateDriverHolidaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(DriverHolidayContract::TABLE_NAME, function (Blueprint $table) {
            $table->increments(DriverHolidayContract::ID);
            $table->unsignedInteger(DriverHolidayContract::DRIVER_ID);
            $table->date(DriverHolidayContract::FROM);
            $table->date(DriverHolidayContract::TO);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign(DriverHolidayContract::DRIVER_ID)->references(DriverContract::ID)->on(DriverContract::TABLE_NAME)->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(DriverHolidayContract::TABLE_NAME);
    }
}
