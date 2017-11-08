<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClinicServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinic_services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('service_name');
            $table->double('rate',15,3)->default(0);
            $table->integer('entity_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('clinic_services',function(Blueprint $table){
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
        Schema::dropIfExists('clinic_services');
    }
}
