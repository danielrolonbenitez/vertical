<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactosTable extends Migration
{

    public function up()
    {
        Schema::create('contactos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('email');
            $table->string('mensaje');
            $table->string('estate')->default("No Leido");
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('contactos');
    }
}
