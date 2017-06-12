<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
    	Schema::create('estudiantes', function (Blueprint $table) {
            $table->increments('estudiante_id');
            $table->integer('representante_id')->unsigned()->nullable();
            $table->foreign('representante_id')->references('representante_id')->on('representantes')->onDelete('cascade');
            $table->string('nombres',50);
            $table->string('apellidos',50);
            $table->string('email',50);
            $table->string('sexo',1);
            $table->string('nacimiento',11);
            $table->string('residencia',150);
            $table->tinyInteger('alergico')->unsigned();
            $table->string('tlf_personal',150);
            $table->string('tlf_local',150)->nullable();
            $table->string('foto',55);
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
    	Schema::dropIfExists('estudiantes');
    }
}
