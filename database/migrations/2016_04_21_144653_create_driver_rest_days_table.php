<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Cuadrantes\Commons\DriverRestdayContract;
use Cuadrantes\Commons\DriverContract;
use Cuadrantes\Commons\WeekdayContract;

class CreateDriverRestDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(DriverRestdayContract::TABLE_NAME, function (Blueprint $table) {
            $table->increments(DriverRestdayContract::ID);
            $table->unsignedInteger(DriverRestdayContract::DRIVER_ID);
            $table->unsignedInteger(DriverRestdayContract::WEEKDAY_ID);
            $table->boolean(DriverRestdayContract::ACTIVE)->default(true);
            $table->timestamps();

            $table->foreign(DriverRestdayContract::DRIVER_ID)->references(DriverContract::ID)->on(DriverContract::TABLE_NAME)->onDelete('cascade');
            $table->foreign(DriverRestdayContract::WEEKDAY_ID)->references(WeekdayContract::ID)->on(WeekdayContract::TABLE_NAME);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(DriverRestdayContract::TABLE_NAME);
    }
}
