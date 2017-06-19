<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Periodo extends Model
{
    //
	protected $primaryKey = 'periodo_id';

	protected $fillable = [
		'periodo','status'
	];

	public function inscripcion(){
		return $this->hasOne('App\Inscripcion','periodo_id');
	}

	public function cursosPeriodo()
	{
		return $this->hasMany('App\Inscripcion','periodo_id')->groupBy('curso_id')->get();
	}

	public function estudiantesPeriodo()
	{
		return $this->hasMany('App\Inscripcion','periodo_id')->groupBy('estudiante_id')->get();
	}
}
