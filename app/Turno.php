<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    protected $table='turnos';
    protected $fillabled = ['name', 'hr_ini', 'hr_fin', 'activo', 'empresa_id'];


    public function turnos_dias()
    {
    	return $this->hasMany('App\Turno_Dia');
    }

    public function empresa()
    {
    	return $this->belongsTo('App\Empresa');
    }
}
