<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{

	public $table = 'bitacora';
	
    protected $fillable = [
    'usuario',
    'modulo',
    'accion'];
}
