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
            $table->string('nombres',50);
            $table->string('apellidos',50);
            $table->string('sexo',1);
            $table->string('edad',3);
            $table->string('residencia',150);
            $table->tinyInteger('alergico')->unsigned()->default('0');
            $table->string('tlf_personal',150)->nullable();
            $table->string('tlf_local',150)->nullable();
            $table->string('foto',55);
            $table->softDeletes();
            $table->timestamp()->nullable();
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
