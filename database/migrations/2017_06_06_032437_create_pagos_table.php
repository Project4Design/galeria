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
            $table->string('inscripcion_id',11);
            $table->string('tipo',1);
            $table->decimal('monto',9,2)->unsigned();
            $table->string('fecha',10);
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
