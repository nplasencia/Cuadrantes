<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Cuadrantes\Commons\ServiceExcludedPeriodContract;

class CreateServiceExcludedPeriodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create(ServiceExcludedPeriodContract::TABLE_NAME, function (Blueprint $table) {
		    $table->increments(ServiceExcludedPeriodContract::ID);
		    $table->string(ServiceExcludedPeriodContract::CODE);
		    $table->string(ServiceExcludedPeriodContract::VALUE);
		    $table->date(ServiceExcludedPeriodContract::FROM);
		    $table->date(ServiceExcludedPeriodContract::TO);
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::drop(ServiceExcludedPeriodContract::TABLE_NAME);
    }
}
