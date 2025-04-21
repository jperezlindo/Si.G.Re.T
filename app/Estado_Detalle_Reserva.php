<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado_Detalle_Reserva extends Model
{
    protected $table='estado_detalle_reserva';
    protected $fillabled = ['estado_id', 'detalle_reserva_id', 'comentario'];

    public function estado()
    {
    	return $this->belongsTo('App\Estado');
    }

    public function detalle_reserva()
    {
    	return $this->belongsTo('App\Detalle_Reserva');
    }
}
