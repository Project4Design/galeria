<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('notas',function(Blueprint $table){
      	$table->increments('id');
      	$table->integer('inscripcion_id')->unsigned();
      	$table->foreign('inscripcion_id')->references('inscripcion_id')->on('inscripciones')->onDelete('cascade');
      	$table->string('nota')->nullable();
      	$table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('notas');
    }
}