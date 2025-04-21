<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    protected $table='partidos';
    protected $fillabled = ['name', 'fecha', 'hr_ini', 'hr_fin', 'activo', 'finalizado', 'categoria_torneo_id' ];

    protected $dates = [
        'fecha'
    ];

    public function categoria_torneo(){

    	return $this->belongsTo('App\Categoria_Torneo');
    }
    
    public function instancia(){

        return $this->belongsTo('App\Instancia');
    }

    public function detalle_partido(){

    	return $this->hasMany('App\Detalle_Partido');
    }
}
