<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_records', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('entity_id');
            $table->unsignedInteger('doctor_id');
            $table->unsignedInteger('patient_id');
            $table->json('health_info')->nullable();
            $table->mediumText('image_url')->nullable();
            $table->mediumText('typing_Note')->nullable();
            $table->json('upload_file')->nullable();
            $table->json('template')->nullable();
            $table->json('diagnose')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
        Schema::table('medical_records', function (Blueprint $table) {
            $table->foreign('entity_id')->references('id')->on('entities')->onDelete('cascade');
            $table->foreign('doctor_id')->references('id')->on('user_informations');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_records');
    }
}
