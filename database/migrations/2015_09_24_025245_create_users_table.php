<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{

    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->integer('rol_id')->unsigned();
            $table->foreign('rol_id')->references('id')->on('roles')->onDelete('cascade');
            $table->integer('admin_id')->unsigned()->nullable();
            $table->foreign('admin_id')->references('id')->on('administradores')->onDelete('cascade');
            //$table->integer('unidades_id')->unsigned()->nullable();
            //$table->foreign('unidades_id')->references('id')->on('unidades')->onDelete('cascade');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::drop('users');
    }
}