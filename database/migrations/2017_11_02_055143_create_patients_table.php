<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('patient_code')->unique();
            $table->integer('creator_id')->unsigned()->nullable();
            $table->json('patient_info');
            $table->json('drug_allergy')->nullable();
            $table->json('medical_info')->nullable();
            $table->integer('entity_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('patients', function (Blueprint $table) {
            $table->foreign('creator_id')->references('id')->on('users');
            $table->foreign('entity_id')->references('id')->on('entities')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
