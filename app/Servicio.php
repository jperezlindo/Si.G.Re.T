<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $table='servicios';
    protected $fillabled = ['name', 'descripcion', 'empresa_id'];


    public function cancha_servicio()
    {
      return $this->hasMany('App\Cancha_Servicio');
    }

    public function empresa()
    {
      return $this->belongsTo('App\Empresa');
    }

    public function scopeSearch($query, $buscar){
        
        if (trim($buscar) != '')
        {
          return $query
          ->Where('name', 'LIKE', '%' .$buscar. '%');
        }   
    }
}
