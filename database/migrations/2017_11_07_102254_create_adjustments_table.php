<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdjustmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adjustments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('medicine_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->double('bought_qnt',15,3)->nulllable();
            $table->boolean('adjust');
            $table->timestamps();
        });

        Schema::table('adjustments', function (Blueprint $table) {
            $table->foreign('medicine_id')->references('id')->on('medicines')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adjustments');
    }
}
