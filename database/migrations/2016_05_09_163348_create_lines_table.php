<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Cuadrantes\Commons\LineContract;

class CreateLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(LineContract::TABLE_NAME, function (Blueprint $table) {
            $table->increments(LineContract::ID);
            $table->unsignedSmallInteger(LineContract::NUMBER);
            $table->string(LineContract::NAME)->unique();
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
        Schema::drop(LineContract::TABLE_NAME);
    }
}
