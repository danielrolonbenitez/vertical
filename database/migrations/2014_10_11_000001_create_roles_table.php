<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{

    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('nombre');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::drop('roles');
    }
}