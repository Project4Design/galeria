<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Representante extends Model
{
	protected $primaryKey = "representante_id";

	protected $fillable = ['residencia'];

  public function user()
  {
    return $this->belongsTo('App\User','user_id');
  }

	public function estudiantes(){
		return $this->hasMany('App\Estudiante','representante_id');
	}
}
