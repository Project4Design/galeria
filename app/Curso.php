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
      'id_profesor'
  ];

  public function profesor()
  {
      return $this->belongsTo('App\Profesores','id_profesor');
  }
}
