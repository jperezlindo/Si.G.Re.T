<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_Torneo extends Model
{
    protected $table='tipos_torneo';
    protected $fillabled = ['cod', 'name', 'algoritmo_1', 'algoritmo_2', 'algoritmo_3', 'descripcion', 'activo'];


    public function torneos(){

    	return $this->hasMany('App\Torneo');
    	
    }
}
