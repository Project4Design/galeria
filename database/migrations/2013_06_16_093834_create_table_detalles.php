<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDetalles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('detalles',function(Blueprint $table){
        $table->increments('detalle_id');
        $table->string('nombres');
        $table->string('apellidos');
        $table->string('cedula');
        $table->string('tlf_personal');
        $table->string('tlf_local')->nullable();
        $table->string('foto')->nullable();
        $table->softDeletes();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('detalles');
    }
}
