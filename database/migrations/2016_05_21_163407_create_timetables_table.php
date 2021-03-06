<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Cuadrantes\Commons\TimetableContract;
use Cuadrantes\Commons\PeriodContract;
use Cuadrantes\Commons\RouteContract;

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
            $table->unsignedInteger(TimetableContract::ROUTE_ID);
            $table->unsignedInteger(TimetableContract::PERIOD_ID);
            $table->time(TimetableContract::TIME);
            $table->string(TimetableContract::BY);
            $table->boolean(TimetableContract::PASS)->default(false);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign(TimetableContract::ROUTE_ID)->references(RouteContract::ID)->on(RouteContract::TABLE_NAME)->onDelete('cascade');
            $table->foreign(TimetableContract::PERIOD_ID)->references(PeriodContract::ID)->on(PeriodContract::TABLE_NAME);

            $table->unique( [TimetableContract::ROUTE_ID, TimetableContract::PERIOD_ID, TimetableContract::TIME, TimetableContract::PASS] );
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
