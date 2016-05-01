<?php

use Cuadrantes\Commons\BrandContract;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(BrandContract::TABLE_NAME, function (Blueprint $table) {
            $table->increments(BrandContract::ID);
            $table->string(BrandContract::NAME);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(BrandContract::TABLE_NAME);
    }
}
