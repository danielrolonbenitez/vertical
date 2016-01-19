<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminTable extends Migration
{

    /* Se utilizan los mismos atributos que utiliza el portal web de la ciudad de Buenos Aires
    http://www.buenosaires.gob.ar/defensaconsumidor/listado-de-administradores-de-consorcios */

    public function up()
    {
        Schema::create('administradores', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('cuit')->unique();
            $table->string('razon_social');
            $table->string('domicilio');
            $table->string('provincia');
            $table->string('localidad');
            $table->string('cp');
            $table->string('email');
            $table->string('telefono');
            $table->string('situacion_fiscal');
            $table->string('rpa');
            $table->boolean('estado');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::drop('administradores');
    }
}