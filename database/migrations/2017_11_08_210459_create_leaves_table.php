<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('doctor_id');
            $table->unsignedInteger('entity_id');
            $table->integer('leave_type')->nullable();
            $table->json('leave_length')->nullable();
            $table->boolean('approved')->nullable();
            $table->text('reason')->nullable();
            $table->timestamps();
        });

        Schema::table('leaves', function (Blueprint $table) {
            $table->foreign('doctor_id')->references('id')->on('user_informations')->onDelete('cascade');
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
        Schema::dropIfExists('leaves');
    }
}
