<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepresentantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
    	Schema::create('representantes', function (Blueprint $table) {
            $table->increments('representante_id');
            $table->string('nombres',50);
            $table->string('apellidos',50);
            $table->string('sexo',1);
            $table->string('residencia',150);
            $table->string('tlf_personal',150)->nullable();
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
    	Schema::dropIfExists('representantes');
    }
}
