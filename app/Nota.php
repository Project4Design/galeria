<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
  //
  protected $table = 'notas';
  protected $fillable = ['inscripcion_id','nota'];

  public function inscripcion(){
  	return $this->belongsTo('App\Inscripcion','inscripcion_id');
  }
}
