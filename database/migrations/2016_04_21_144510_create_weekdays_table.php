<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Cuadrantes\Commons\PeriodContract;
use Cuadrantes\Commons\WeekdayContract;

class CreateWeekdaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(WeekdayContract::TABLE_NAME, function (Blueprint $table) {
            $table->increments(WeekdayContract::ID);
            $table->unsignedInteger(WeekdayContract::PERIOD_ID);
            $table->string(WeekdayContract::CODE);
            $table->string(WeekdayContract::VALUE);

            $table->foreign(WeekdayContract::PERIOD_ID)->references(PeriodContract::ID)->on(PeriodContract::TABLE_NAME)->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(WeekdayContract::TABLE_NAME);
    }
}
