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
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('representante_id')->unsigned()->nullable();
            $table->foreign('representante_id')->references('representante_id')->on('representantes')->onDelete('cascade');
            $table->string('sexo',1);
            $table->string('nacimiento',11);
            $table->string('residencia',150);
            $table->string('alergia')->nullable();
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
