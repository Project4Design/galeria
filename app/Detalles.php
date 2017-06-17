<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalles extends Model
{
	protected $table = "detalles";

  protected $primaryKey = 'detalle_id';

  protected $fillable = [
  	'nombres','apellidos','cedula','tlf_personal','tlf_local','foto'
  	];

  public $timestamps = false;

  public function users(){
  	return $this->hasOne('App\User','detalle_id');
  }
}
