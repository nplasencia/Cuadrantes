<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Cuadrantes\Commons\DriverContract;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(DriverContract::TABLE_NAME, function (Blueprint $table) {
            $table->increments(DriverContract::ID);
            $table->string(DriverContract::FIRST_NAME);
            $table->string(DriverContract::LAST_NAME);
            $table->string(DriverContract::DNI);
            $table->string(DriverContract::TELEPHONE);
            $table->unsignedSmallInteger(DriverContract::EXTENSION);
            $table->string(DriverContract::EMAIL);
            $table->date(DriverContract::CAP);
            $table->date(DriverContract::EXPIRATION);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(DriverContract::TABLE_NAME);
    }
}
