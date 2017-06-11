<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Galeria extends Model
{

	protected $table = 'galeria';
	protected $fillable = [
      'titulo','descripcion', 'foto'
  ];
}
