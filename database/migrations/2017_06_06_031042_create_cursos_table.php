<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
    	Schema::create('cursos', function (Blueprint $table) {
            $table->increments('curso_id');
            $table->string('titulo',120);
            $table->string('descripcion',500);
            $table->integer('limit')->unsigned();
            $table->string('foto',55);
            $table->integer('id_profesor')->unsigned();
            $table->foreign('id_profesor')->references('id')->on('profesores')->onDelete('cascade');
            $table->float('precio')->unsigned();
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
    	Schema::dropIfExists('cursos');
    }
}
