<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnidadesTable extends Migration
{

    public function up()
    {
        Schema::create('unidades', function (Blueprint $table) {
            $table->increments('id');
            $table->char('letra', 1);
            $table->integer('porcentaje');
            $table->integer('metros');
            $table->integer('inquilino_id')->unsigned()->nullable();
            $table->foreign('inquilino_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('propietario_id')->unsigned()->nullable();
            $table->foreign('propietario_id')->references('id')->on('users')->onDelete('cascade');  
            $table->integer('piso_id')->unsigned();
            $table->foreign('piso_id')->references('id')->on('pisos')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::drop('unidades');
    }
}
