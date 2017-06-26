<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{

    use Notifiable;
    //
	protected $primaryKey = "curso_id";

	protected $fillable = [
      'titulo',
      'descripcion',
      'foto',
      'precio',
      'limit',
      'id_profesor'
  ];

  public function profesor()
  {
    return $this->belongsTo('App\Profesores','id_profesor');
  }

  public function inscritos()
  {
  	return $this->hasMany('App\Inscripcion','curso_id')->count();
  }

  public function estudiantes()
  {
  	return $this->hasMany('App\Inscripcion','curso_id')->groupBy('estudiante_id')->get();
  }

  public function inscripcion()
  {
  	return $this->hasOne('App\Inscripcion','curso_id');
  }

  public function estudiantesByPeriodo($periodo)
  {
  	return $this->hasMany('App\Inscripcion','curso_id')->where('periodo_id',$periodo)->get();
  }
}
