<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
    	Schema::create('pagos', function (Blueprint $table) {
          $table->increments('pago_id');
          $table->integer('inscripcion_id')->unsigned();
          $table->foreign('inscripcion_id')->references('inscripcion_id')->on('inscripciones')->onDelete('cascade');
          $table->string('tipo');
          $table->string('banco')->nullable();
          $table->string('referencia')->nullable();
          $table->decimal('monto',11,2)->unsigned();
          $table->string('fecha',10)->comment('Fecha en que se realizo el pago');
          $table->integer('status')->default(2);
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
    	Schema::dropIfExists('pagos');
    }
}
