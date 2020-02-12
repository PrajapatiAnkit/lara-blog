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
        Schema::create('lara_userss', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username',100);
            $table->string('password',100);
            $table->string('email',100);
            $table->string('contact',100);
            $table->string('profile',100);
            $table->integer('userType');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lara_userss');
    }
}
