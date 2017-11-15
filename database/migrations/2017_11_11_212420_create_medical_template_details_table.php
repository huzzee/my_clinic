<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalTemplateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_template_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('medical_template_id')->unsigned();
            $table->string('question');
            $table->integer('type');
            $table->json('answers')->nullable();
            $table->timestamps();
        });

        Schema::table('medical_template_details', function (Blueprint $table) {
            $table->foreign('medical_template_id')->references('id')
                ->on('medical_templates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_template_details');
    }
}
