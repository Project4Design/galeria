<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email','password','nivel'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function detalles()
    {
      return $this->belongsTo('App\Detalles','detalle_id');
    }

    public function nivel()
    {
        switch ($this->nivel) {
            case 1: $r = 'Administrador'; break;
            case 2: $r = 'Profesor'; break;
            case 3: $r = 'Representante'; break;
            case 4: $r = 'Estudiante'; break;
        }
        return $r;
    }

    public function profesor(){
        return $this->hasOne('App\Profesores','user_id');
    }

    public function estudiante(){
        return $this->hasOne('App\Estudiante','user_id');
    }

    public function representante(){
    		return $this->hasOne('App\Representante','user_id');
    }
}
