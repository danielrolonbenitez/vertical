<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReclamosTable extends Migration
{

    public function up()
    {
        Schema::create('reclamos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo');
            $table->string('descripcion');
            $table->string('estado');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('edificio_id')->unsigned();
            $table->foreign('edificio_id')->references('id')->on('edificios')->onDelete('cascade');
            $table->integer('grupo_id')->unsigned();
            $table->foreign('grupo_id')->references('id')->on('roles')->onDelete('cascade');      
            $table->integer('unidad_id')->unsigned();
            $table->foreign('unidad_id')->references('id')->on('unidades')->onDelete('cascade');             
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::drop('reclamos');
    }
}
