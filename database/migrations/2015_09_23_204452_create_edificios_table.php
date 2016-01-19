<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEdificiosTable extends Migration
{

    public function up()
    {
        Schema::create('edificios', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('razon_social');
            $table->string('cuit');
            $table->string('suterh');
            $table->string('direccion');
            $table->integer('admin_id')->unsigned();
            $table->foreign('admin_id')->references('id')->on('administradores')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::drop('edificios');
    }
}