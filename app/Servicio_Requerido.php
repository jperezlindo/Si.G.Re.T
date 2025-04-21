<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio_Requerido extends Model
{
    protected $table='servicios_requeridos';
    protected $fillabled = ['precio', 'cancha_servicio_id', 'detalle_reserva_id'];


    public function detalle_reserva()
    {
    	return $this->belongsTo('App\Detalle_Reserva');
    }

    public function cancha_servicio()
    {
    	return $this->belongsTo('App\Cancha_Servicio');
    }

}
