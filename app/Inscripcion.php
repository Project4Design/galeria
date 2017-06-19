<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
	protected $table = "inscripciones";
	protected $primaryKey = "inscripcion_id";

	protected $fillable = [
		'curso_id',
		'estudiante_id'
	];

	public function periodo()
	{
		return $this->belongsTo('App\Periodo','periodo_id','periodo_id');
	}

	public function curso()
	{
		return $this->belongsTo('App\Curso','curso_id');
	}

	public function estudiante()
	{
		return $this->belongsTo('App\Estudiante','estudiante_id');
	}

	public function pago()
	{
		return $this->hasOne('App\Pago');
	}

	//Verificar limite de inscripciones por curso
  public function verificarLimite($periodo,$curso){
  	return $this->where([['periodo_id',$periodo],['curso_id',$curso]])->count();
  }

  //Verificar que el estudiante no se encuentre inscrito
  public function verificarRepetido($periodo,$curso,$estudiante){
  	return $this->where([['periodo_id',$periodo],['curso_id',$curso],['estudiante_id',$estudiante]])->count();
  }
}
