<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jugador extends Model
{
    protected $table='jugadores';
    protected $fillabled = ['detalle_reserva_id', 'user_empresa_id', 'confirmo'];


    public function user_empresa(){

    	return $this->belongsTo('App\User_Empresa');
    }

    public function detalle_reserva(){

    	return $this->belongsTo('App\Detalle_Reserva');
    }
}
