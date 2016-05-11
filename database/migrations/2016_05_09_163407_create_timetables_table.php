<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Cuadrantes\Commons\TimetableContract;
use Cuadrantes\Commons\LineContract;
use Cuadrantes\Commons\PeriodContract;

class CreateTimetablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(TimetableContract::TABLE_NAME, function (Blueprint $table) {
            $table->increments(TimetableContract::ID);
            $table->unsignedInteger(TimetableContract::LINE_ID);
            $table->unsignedInteger(TimetableContract::PERIOD_ID);
            $table->time(TimetableContract::TIME);
            $table->string(TimetableContract::DESTINY);
            $table->boolean(TimetableContract::ACTIVE)->default(true);
            $table->timestamps();

            $table->foreign(TimetableContract::LINE_ID)->references(LineContract::ID)->on(LineContract::TABLE_NAME)->onDelete('cascade');
            $table->foreign(TimetableContract::PERIOD_ID)->references(PeriodContract::ID)->on(PeriodContract::TABLE_NAME);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(TimetableContract::TABLE_NAME);
    }
}
