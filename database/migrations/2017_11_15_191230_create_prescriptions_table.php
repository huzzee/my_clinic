<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('entity_id');
            $table->unsignedInteger('doctor_id');
            $table->unsignedInteger('patient_id');
            $table->unsignedInteger('queue_id');
            $table->json('prescriptions');
            $table->timestamps();
        });
        Schema::table('prescriptions', function (Blueprint $table) {
            $table->foreign('entity_id')->references('id')->on('entities')->onDelete('cascade');
            $table->foreign('doctor_id')->references('id')->on('user_informations');
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->foreign('queue_id')->references('id')->on('queues')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prescriptions');
    }
}
