<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instancia extends Model
{
    protected $table='instancias';
    protected $fillabled = ['name', 'activo', 'descripcion'];

    public function partidos(){

    	return $this->hasMany('App\Partido');
    }
}
