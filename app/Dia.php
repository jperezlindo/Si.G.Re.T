<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dia extends Model
{
    protected $table='dias';
    protected $fillabled = ['name', 'activo'];


    public function turnos_dias()
    {
    	return $this->hasMany('App\Turno_Dia');
    }


  public function get_nombre_dia($fecha){
        $fechats = strtotime($fecha); //pasamos a timestamp

    //el parametro w en la funcion date indica que queremos el dia de la semana
    //lo devuelve en numero, 1 lunes,....
    switch (date('w', $fechats)){
        case 0: return "DOMINGO"; break;
        case 1: return "LUNES"; break;
        case 2: return "MARTES"; break;
        case 3: return "MIERCOLES"; break;
        case 4: return "JUEVES"; break;
        case 5: return "VIERNES"; break;
        case 6: return "SABADO"; break;
        
    }
  }


}
