<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
  protected $primaryKey = "pago_id";

  protected $fillable = [
    'inscripcion_id',
    'tipo',
    'fecha',
    'banco',
    'referencia',
    'monto'
  ];

  public function inscripcion()
  {
  	return $this->belongsTo('App\Inscripcion','inscripcion_id');
  }

  public function byEstudiante($estudiante)
  {
  	return $this->Join('Inscripciones','inscripciones.inscripcion_id','=','pagos.inscripcion_id')
  							->where('inscripciones.estudiante_id',$estudiante)
  							->get();
  }

  public  function fechaBetween($desde,$hasta)
  {
      return $this->whereBetween('fecha',[$desde,$hasta])->get();
  }
}
