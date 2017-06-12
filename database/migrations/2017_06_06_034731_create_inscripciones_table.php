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
            $table->integer('curso_id')->unsigned();
            $table->foreign('curso_id')->references('curso_id')->on('cursos')->onDelete('cascade');
            $table->integer('estudiante_id')->unsigned();
            $table->foreign('estudiante_id')->references('estudiante_id')->on('estudiantes')->onDelete('cascade');
            $table->integer('user_id')->unsigned()->comment('Quien realizo la inscripcion');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('status',20);
            $table->softDeletes();
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
