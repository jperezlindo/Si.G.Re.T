<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Empresa extends Model
{
    protected $table='user_empresa';
    protected $fillabled = ['user_id', 'empresa_id', 'rol_id', 'activo'];

    public function user(){

    	return $this->belongsTo('App\User');
    }

    public function empresa(){

    	return $this->belongsTo('App\Empresa');
    }

    public function rol(){

        return $this->belongsTo('App\Rol');
    }

   	public function reservas()
    {
        return $this->hasMany('App\Reserva');
    }

    public function turnos()
    {
        return $this->hasMany('App\Turno');
    }

    public function jugador()
    {
        return $this->hasMany('App\Jugador');
    }

    public function user_empresa_equipo()
    {
        return $this->hasOne('App\User_Empresa_Equipo');
    }

    public function inscripciones()
    {
        return $this->hasMany('App\Inscripcion');
    }

    public function ranking()
    {
        return $this->hasOne('App\Ranking');
    }

}
