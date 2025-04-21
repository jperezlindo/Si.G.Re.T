<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turno_Dia extends Model
{
    protected $table='turnos_dias';
    protected $fillabled = ['dia_id', 'turno_id', 'activo'];


    public function dia()
    {
    	return $this->belongsTo('App\Dia');
    }

    public function turno()
    {
    	return $this->belongsTo('App\Turno');
    }
}
