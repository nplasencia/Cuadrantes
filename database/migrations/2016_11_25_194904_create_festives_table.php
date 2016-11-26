<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Cuadrantes\Commons\FestiveContract;

class CreateFestivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create(FestiveContract::TABLE_NAME, function (Blueprint $table) {
		    $table->increments(FestiveContract::ID);
		    $table->date(FestiveContract::DATE);
		    $table->boolean(FestiveContract::ALWAYS);
		    $table->string(FestiveContract::DESCRIPTION);
		    $table->timestamps();

		    $table->unique( FestiveContract::DATE );

	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::drop(FestiveContract::TABLE_NAME);
    }
}
