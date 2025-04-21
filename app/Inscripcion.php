<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    protected $table='inscripciones';
    protected $fillabled = ['activo', 'torneo_id', 'user_empresa_id', 'equipo_id'];

    public function equipo(){

    	return $this->belongsTo('App\Equipo');

    }

    public function categoria_torneo(){

        return $this->belongsTo('App\Categoria_Torneo');
        
    }

    public function user_empresa (){

    	return $this->belongsTo('App\User_Empresa');

    }
}
