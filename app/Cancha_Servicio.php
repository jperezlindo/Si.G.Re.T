<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cancha_Servicio extends Model
{
    protected $table = 'cancha_servicio';
    protected $fillabled = ['cancha_id', 'servicio_id', 'precio', 'requerido', 'activo'];


    public function cancha()
    {
    	return $this->belongsTo('App\Cancha');
    }

    public function servicio()
    {
    	return $this->belongsTo('App\Servicio');
    }

    public function servicio_requerido()
    {
      return $this->hasOne('App\Servicio_Requerido');
    }
}
