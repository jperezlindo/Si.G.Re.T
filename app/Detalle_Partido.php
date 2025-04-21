<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;
use App\Detalle_Partido;


class Detalle_Partido extends Model
{
    protected $table='detalle_partido';
    protected $fillabled = ['activo', 'set_1', 'set_2', 'set_3', 'comentario', 'isWinn', 'partido_id', 'equipo_id'];

    public function partido(){

    	return $this->belongsTo('App\Partido');
    }

    public function equipo(){

    	return $this->belongsTo('App\Equipo');
    }

    public function newDetalle_Partido($id_equipo, $id_partido){

		$dp = new Detalle_Partido();
        $dp->comentario = '.';
        $dp->isWinn     = 0;
        $dp->set_01     = 0;
        $dp->set_02     = 0;
        $dp->set_03     = 0;
        $dp->activo     = 1;
		$dp->au         = Auth::user()->user_empresa->id;
		$dp->equipo_id  = $id_equipo;
		$dp->partido_id = $id_partido;
		
		return $dp;
    }
}
