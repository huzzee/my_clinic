<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

            Schema::create('admins', function (Blueprint $table) {
                $table->increments('id');
                $table->string('full_name');
                $table->integer('user_id')->unsigned();
                $table->string('country');
                $table->integer('gender');
                $table->bigInteger('contact_no');
                $table->text('address');
                $table->string('account_no')->nullable();
                $table->boolean('status')->default(1);
                $table->timestamps();
            });

            Schema::table('admins',function (Blueprint $table){
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
