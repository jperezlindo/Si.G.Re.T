<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Empresa_Equipo extends Model
{
    
    protected $table='user_empresa_equipo';
    protected $fillabled = ['user_empresa_id', 'equipo_id', 'activo'];

    public function equipo(){

    	return $this->belongsTo('App\Equipo');
    	
    }

    public function user_empresa(){

    	return $this->belongsTo('App\User_Empresa');
    	
    }
}
