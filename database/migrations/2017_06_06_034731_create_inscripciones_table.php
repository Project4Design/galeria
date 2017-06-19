<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInscripcionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
    	Schema::create('inscripciones', function (Blueprint $table) {
            $table->increments('inscripcion_id');
            $table->integer('periodo_id')->unsigned();
            $table->foreign('periodo_id')->references('periodo_id')->on('periodos')->onDelete('cascade');
            $table->integer('curso_id')->unsigned();
            $table->foreign('curso_id')->references('curso_id')->on('cursos')->onDelete('cascade');
            $table->integer('estudiante_id')->unsigned();
            $table->foreign('estudiante_id')->references('estudiante_id')->on('estudiantes')->onDelete('cascade');
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
        //
    	Schema::dropIfExists('inscripciones');
    }
}
