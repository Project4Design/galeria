<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
  protected $primaryKey = "pago_id";

  protected $fillable = [
    'inscripcion_id',
    'metodo',
    'fecha',
    'banco',
    'referencia',
    'monto'
  ];

  public function inscripcion(){
  	return $this->belongsTo('App\inscripcion');
  }
}
