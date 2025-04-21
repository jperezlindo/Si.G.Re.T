<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria_Torneo extends Model
{
    protected $table='categorias_torneo';
    protected $fillabled = [ 'categoria_id', 'torneo_id' ];

    
    public function torneo(){

    	return $this->belongsTo('App\Torneo');
    	
    }

    public function categoria(){

    	return $this->belongsTo('App\Categoria');
    	
    }

    public function partidos(){

        return $this->hasMany('App\Partido');
        
    }

    public function inscripciones(){

        return $this->hasMany('App\Inscripcion');

    }

}
