<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table='categorias';
    protected $fillabled = ['activo', 'c_categoria_id', 'c_etario_id', 'c_sexo_id' ];

    
    public function equipos(){

    	return $this->hasMany('App\Torneo');
    	
    }

    public function partidos(){

        return $this->hasMany('App\Partido');
        
    }

    public function c_categoria(){

        return $this->belongsTo('App\C_Categoria');
        
    }

    public function c_sexo(){

        return $this->belongsTo('App\C_Sexo');
        
    }
    
    public function c_etario(){

        return $this->belongsTo('App\C_Etario');
        
    }

}
