<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{  
  public $table = "estudiantes";

	protected $primaryKey = 'estudiante_id';

	protected $fillable = [
		'representante_id',
		'sexo',
		'nacimiento',
		'residencia',
		'alergico'
	];

  public function user()
  {
    return $this->belongsTo('App\User','user_id','id');
  }

	public function representante(){
		return $this->belongsTo('App\Representante','representante_id','representante_id');
	}

	public function edad()
	{
    $hoy = date('d-m-Y');
    $x = explode("-",$this->nacimiento);
    $fecha = $x[1]."-".$x[0]."-".$x[2];
    $date = date_diff(date_create(date('d-m-Y',strtotime($fecha))),date_create($hoy));
    $edad = $date->format('%y');

    return $edad;
	}

	public function cursos()
	{
		return $this->hasMany('App\Inscripcion','estudiante_id')->groupBy('curso_id','periodo_id')->get();
	}
}
