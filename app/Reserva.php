<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use App\Servicio;
use App\Cancha_Servicio;
use App\Detalle_Reserva;
use App\Servicio_Requerido;

class Reserva extends Model
{
    protected $table='reservas';
    protected $fillabled = ['fecha_reservacion', 'fecha_reservada', 'fija', 'dia', 'activo'];

    protected $dates = [
        'fecha_reservada',
        'fecha_reservacion',
    ];

    public function scopeSearch($query, $buscar){
        
        if (trim($buscar) != '')
        {
          return $query
          ->Where('fecha_reservada', 'like', '%' .$buscar. '%');

        }   
    }

    public function user_empresa(){

    	return $this->belongsTo('App\User_Empresa');
    }

    public function detalles_reserva()
    {
        return $this->hasMany('App\Detalle_Reserva');
    }

    public function getCanchas_alquiladas ($fecha)
    {

        $ddrr = Detalle_Reserva::where('fecha_reservada', $fecha)->get();
        $servicio = Servicio::where('name', 'ALQUILER')->first();
        $ccss = Cancha_Servicio::all()->where('servicio_id', $servicio->id);
        $requeridos = new Collection();
        //obtiene el servicio alquiler de cada cancha para la fecha
        foreach ($ccss as $cs) {
          foreach ($ddrr as $dr) {
            $ssrr = Servicio_Requerido::all()
            ->where('detalle_reserva_id', $dr->id)->where('cancha_servicio_id', $cs->id);
            foreach ($ssrr as $sr) {
              $requeridos->push($sr);
            }  
          }
        }
        
        return $requeridos;
    }

}
