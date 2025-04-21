<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    protected $table='equipos';
    protected $fillabled = ['name', 'descripcion', 'activo', 'categoria_id'];


    public function categoria(){

    	return $this->belongsTo('App\Categoria');
    	
    }

    public function user_empresa_equipo(){

    	return $this->hasMany('App\User_Empresa_Equipo');
    	
    }

    public function inscripciones(){

        return $this->hasMany('App\Inscripcion');
    }

    public function detalles_partido(){

        return $this->hasMany('App\Detalles_Partido');
    }
}

