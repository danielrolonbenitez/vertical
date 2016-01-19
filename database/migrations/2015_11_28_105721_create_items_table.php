<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{

    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->float('importe');
            $table->integer('expensa_id')->unsigned();
            $table->foreign('expensa_id')->references('id')->on('expensas')->onDelete('cascade');
            $table->integer('unidad_id')->unsigned();
            $table->foreign('unidad_id')->references('id')->on('unidades')->onDelete('cascade');  
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::drop('items');
    }
}
