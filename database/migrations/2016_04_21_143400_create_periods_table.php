<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Cuadrantes\Commons\PeriodContract;

class CreatePeriodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(PeriodContract::TABLE_NAME, function (Blueprint $table) {
            $table->increments(PeriodContract::ID);
            $table->string(PeriodContract::CODE);
            $table->string(PeriodContract::VALUE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(PeriodContract::TABLE_NAME);
    }
}
