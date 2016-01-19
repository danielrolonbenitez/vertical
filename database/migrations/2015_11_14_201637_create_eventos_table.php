<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo');
            //$table->date('dia');
            //$table->time('hora');
            //$table->time('duracion');
            $table->dateTime('inicio');
            $table->dateTime('fin');
            $table->string('descripcion')->nullable();
            $table->integer('edificio_id')->unsigned();
            $table->foreign('edificio_id')->references('id')->on('edificios')->onDelete('cascade');
            $table->integer('amenitie_id')->unsigned()->nullable();
            $table->foreign('amenitie_id')->references('id')->on('amenities')->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('eventos');
    }
}
