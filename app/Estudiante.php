<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    //

	protected $primaryKey = 'estudiante_id';

	protected $fillable = [
		'representante_id',
		'nombres',
		'apellidos',
		'email',
		'sexo',
		'nacimiento',
		'residencia',
		'alergico',
		'tlf_personal',
		'tlf_local',
		'foto',
	];

	public function representantes(){
		return $this->belongsTo('App\Representantes','representantes_id');
	}
}
