<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    //
	protected $primaryKey = 'periodo_id';

	protected $fillable = [
		'periodo','status'
	];
}
