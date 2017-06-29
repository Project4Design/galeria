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
    'monto',
    'status'
  ];

  public function inscripcion()
  {
  	return $this->belongsTo('App\Inscripcion','inscripcion_id');
  }

  public function byEstudiante($estudiante)
  {
  	return $this->join('Inscripciones','inscripciones.inscripcion_id','=','pagos.inscripcion_id')
  							->where('inscripciones.estudiante_id',$estudiante)
  							->get();
  }

  public  function fechaBetween($desde,$hasta)
  {
      return $this->whereBetween('fecha',[$desde,$hasta])->get();
  }

  public function status()
  {
  	switch ($this->attributes['status']) {
  		case 0:
  			$estado = '<span class="label label-danger">Rechazado</span>';
			break;
			case 1:
				$estado = '<span class="label label-success">Aprovado</span>';
			break;
			case 2:
				$estado = '<span class="label label-warning">Pendiente</span>';
			break;
  	}
  	return $estado;
  }
}
