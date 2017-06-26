<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profesores extends Model
{
  protected $table = 'profesores';

	protected $fillable = [
     'direccion',
     'profesion',
     'descripcion_perfil'
  ];

  public function user()
  {
    return $this->belongsTo('App\User','user_id');
  }

 	public function cursos()
  {
    return $this->hasMany('App\Curso','id_profesor');
  }

  public function inscripciones()
  {
  	return $this->hasMany('App\Curso','id_profesor')
  							->join('inscripciones','cursos.curso_id','=','inscripciones.curso_id')
  							->groupBy('cursos.curso_id')
  							->get();
  	;
  }

}
