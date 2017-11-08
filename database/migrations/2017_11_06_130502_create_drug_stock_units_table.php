<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrugStockUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drug_stock_units', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unit_name');
            $table->boolean('status')->default(1);
            $table->integer('entity_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('drug_stock_units', function (Blueprint $table) {
            $table->foreign('entity_id')->references('id')->on('entities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drug_stock_units');
    }
}
