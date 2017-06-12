<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
	protected $primaryKey = "inscripcion_id";

	protected $fillable = [
		'curso_id',
		'estudiante_id',
		'estado'
	];

	public function pago(){
		return $this->hasOne('App\Pago');
	}
}
