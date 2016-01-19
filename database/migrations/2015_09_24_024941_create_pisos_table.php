<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePisosTable extends Migration
{

    public function up()
    {
        Schema::create('pisos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('numero')->unsigned();
            $table->integer('edificio_id')->unsigned();
            $table->foreign('edificio_id')->references('id')->on('edificios')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::drop('pisos');
    }
}
