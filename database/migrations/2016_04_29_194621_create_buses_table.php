<?php

use Cuadrantes\Commons\BusContract;
use Cuadrantes\Commons\BrandContract;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(BusContract::TABLE_NAME, function (Blueprint $table) {
            $table->increments(BusContract::ID);
            $table->unsignedInteger(BusContract::BRAND_ID);
            $table->string(BusContract::LICENSE);
            $table->unsignedSmallInteger(BusContract::SEATS);
            $table->unsignedSmallInteger(BusContract::STANDS);
            $table->date(BusContract::REGISTRATION);
            $table->boolean(BusContract::ACTIVE);
            $table->timestamps();

            $table->foreign(BusContract::BRAND_ID)->references(BrandContract::ID)->on(BrandContract::TABLE_NAME)->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(BusContract::TABLE_NAME);
    }
}
