<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScheduleDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('schedule_id')->unsigned();
            $table->integer('type')->default(0);
            $table->string('days');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('tokens')->nullable();
            $table->timestamps();
        });

        Schema::table('schedule_details', function (Blueprint $table) {
            $table->foreign('schedule_id')->references('id')->on('schedules')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedule_details');
    }
}
