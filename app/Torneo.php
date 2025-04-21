<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Torneo extends Model
{
    protected $table='torneos';
    protected $fillabled = ['name', 'f_desde', 'f_hasta', 'hora', 'ini_ins', 'fin_ins', 'descripcion', 
                            'activo', 'finalizado', 'winn', 'user_empresa_id'];

    protected $dates = ['f_desde', 'f_hasta', 'ini_ins', 'fin_ins'];


    public function categorias_torneo(){

    	return $this->hasMany('App\Categoria_Torneo');
    	
    }

    public function user_empresa(){

    	return $this->belongsTo('App\User_Empresa');
    	
    }

    public function tipo_torneo(){

        return $this->belongsTo('App\Tipo_Torneo');
        
    }

    public function reservas_torneo(){

        return $this->hasMany('App\Reserva_Torneo');
        
    }

}

