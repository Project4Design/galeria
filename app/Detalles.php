<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detalles extends Model
{
  use SoftDeletes;

  protected $dates = ['deleted_at'];
  
	protected $table = "detalles";

  protected $primaryKey = 'detalle_id';

  protected $fillable = [
  	'nombres','apellidos','cedula','tlf_personal','tlf_local','foto'
  	];

  public $timestamps = false;

  public function users(){
  	return $this->hasOne('App\User','detalle_id');
  }

  public static function boot()
	{
    Detalles::deleting(function($detalles) {
    		foreach ($detalles->users->estudiante->inscripciones() as $inscripciones){
    			$inscripciones->pago()->delete();
    			$inscripciones->delete();
    		}
    		$detalles->users->estudiante->representante()->delete();
        $detalles->users->estudiante()->delete();
        $detalles->users()->delete();
    });
	}
}
