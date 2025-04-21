<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva_Torneo extends Model
{
    protected $table='reservas_torneo';
    protected $fillabled = ['activo', 'torneo_id', 'detalle_reserva_id'];



    public function torneo(){

    	return $this->belongsTo('App\Torneo');
    }

    public function detalle_reserva(){

    	return $this->belongsTo('App\Detalle_reserva');
    }
}
