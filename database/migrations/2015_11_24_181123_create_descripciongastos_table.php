<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDescripciongastosTable extends Migration
{

    public function up()
    {
        Schema::create('descripciongastos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion');
            $table->integer('admin_id')->unsigned();
            $table->foreign('admin_id')->references('id')->on('administradores')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::drop('descripciongastos');
    }
}
