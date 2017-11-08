<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('entity_id')->unsigned();
            $table->integer('doctor_id')->unsigned();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        Schema::table('schedules', function (Blueprint $table) {
            $table->foreign('entity_id')->references('id')->on('entities')->onDelete('cascade');
            $table->foreign('doctor_id')->references('id')->on('user_informations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
