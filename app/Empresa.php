<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table='empresas';
    protected $fillabled = ['name, razon_social, cuit, tel, cel, email, direccion, rubro, logo, ciudad_id'];

    
    public function user_empresa()
    {
        return $this->hasOne('App\User_Empresa');
    }

    public function ciudad()
    {
        return $this->belongsTo('App\Ciudad');
    }

    public function canchas()
    {
        return $this->hasMany('App\Cancha');
    }

    public function servicios()
    {
        return $this->hasMany('App\Servicio');
    }
}
