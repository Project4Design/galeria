<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Representante extends Model
{
    //

	protected $primaryKey = "representante_id";

	protected $fillable = [
	'nombres',
	'apellidos',
	'cedula',
	'email',
	'residencia',
	'tlf_personal',
	'tlf_local',
	'foto'
	];

	public function estudiantes(){
		return $this->hayMany('App\Estudiantes','representante_id');
	}
}
