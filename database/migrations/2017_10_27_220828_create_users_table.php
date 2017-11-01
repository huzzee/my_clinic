<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('entity_id')->unsigned()->nullable();
            $table->integer('role_id')->unsigned()->nullable();
            $table->boolean('status')->default(1);
            $table->string('profile_image')->default('avatar.png')->nullable();
            $table->boolean('approved')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('users',function(Blueprint $table){
            $table->foreign('entity_id')->references('id')->on('entities');
            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
