<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Servicio_Requerido;
use App\Reserva;

class Detalle_Reserva extends Model
{
    protected $table='detalles_reserva';
    protected $fillabled = ['hora_reservada', 'cant_hs', 'monto', 'activo', 'reserva_id'];
    
    protected $dates = [
        'fecha_reservada',
    ];

    public function servicios_requeridos()
    {
    	return $this->hasMany('App\Servicio_Requerido');
    }

    public function reserva()
    {
    	return $this->belongsTo('App\Reserva');
    }

    public function estado_detalle()
    {
      return $this->hasMany('App\Estado_Detalle_Reserva');
    }

    public function jugadores()
    {
        return $this->hasMany('App\Jugador');
    }

    public function reserva_torneo()
    {
        return $this->hasOne('App\Reserva_Torneo');
    }

    public function scopeExisteReserva($query, $fecha, $hora, $cancha){

        return $query ->whereDate('fecha_reservada', $fecha)
                        ->where([['hr_reservada', $hora], ['ca', $cancha], ['activo', 1],['confirmada', 1],])
                            ->get();
    }

    public function scopeExisteReservaUsuario($query, $fecha, $hora, $cancha){

        return $query ->whereDate('fecha_reservada', $fecha)
                        ->where([['hr_reservada', $hora], ['ca', $cancha], ['activo', 1], ['confirmada', 0],])
                            ->get();
    }


    //obtiene el valor del detalle anterior y elimina los servicios contratados
    public function getMontoDetalle($id_dr){
        
        $dr = Detalle_Reserva::find($id_dr);
        $total_old = 0;
        $ssrr = Servicio_Requerido::where('detalle_reserva_id', $dr->id)->get();
        foreach ($ssrr as $sr) {
          if ($sr->cancha_servicio->xhr){
            $total_old += ($sr->precio * $dr->cant_hs) ;
          }else{
            $total_old += $sr->precio;
          }
          $sr->delete();
        }

        return $total_old;
    }

}
