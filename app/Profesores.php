<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profesores extends Model
{
    protected $table = 'profesores';

	protected $fillable = [
     'cedula',
     'nombre',
     'apellido',
     'direccion',
     'profesion',
     'descripcion_perfil',
     'foto'
  ];

   public function curso()
    {
        return $this->hasOne('App\Curso','id_profesor');
    }
}
