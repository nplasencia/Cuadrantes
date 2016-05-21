<?php

use Cuadrantes\Commons\RouteContract;
use Cuadrantes\Commons\LineContract;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(RouteContract::TABLE_NAME, function (Blueprint $table) {
            $table->increments(RouteContract::ID);
            $table->unsignedInteger(RouteContract::LINE_ID);
            $table->string(RouteContract::ORIGIN);
            $table->string(RouteContract::DESTINY);
            $table->boolean(RouteContract::ACTIVE);
            $table->timestamps();

            $table->foreign(RouteContract::LINE_ID)->references(LineContract::ID)->on(LineContract::TABLE_NAME)->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(RouteContract::TABLE_NAME);
    }
}
