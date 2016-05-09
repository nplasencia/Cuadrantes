<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
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
            $table->string(WeekdayContract::CODE);
            $table->string(WeekdayContract::VALUE);
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
