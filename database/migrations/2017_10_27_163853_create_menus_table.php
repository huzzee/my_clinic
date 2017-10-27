<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('menu_name');
            $table->string('menu_slug')->nullable();
            $table->integer('parent_menu_id')->nullable();
            $table->string('menu_icon')->nullable();
            $table->string('menu_route')->nullable();
            $table->integer('sort_order');
            $table->integer('role_id')->unsigned()->nullable();
            $table->boolean('status');
            $table->boolean('hidden');
            $table->timestamps();
        });

        Schema::table('menus',function (Blueprint $table){

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
        Schema::dropIfExists('menus');
    }
}
