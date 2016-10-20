<?php

use Cuadrantes\Commons\DriverContract;
use Cuadrantes\Commons\OffWorkContract;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create(OffWorkContract::TABLE_NAME, function (Blueprint $table) {
		    $table->increments(OffWorkContract::ID);
		    $table->unsignedInteger(OffWorkContract::DRIVER_ID);
		    $table->date(OffWorkContract::WHEN);
		    $table->softDeletes();
		    $table->timestamps();

		    $table->foreign(OffWorkContract::DRIVER_ID)->references(DriverContract::ID)->on(DriverContract::TABLE_NAME)->onDelete('cascade');

		    $table->unique( [OffWorkContract::DRIVER_ID, OffWorkContract::WHEN] );

	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::drop(OffWorkContract::TABLE_NAME);
    }
}
