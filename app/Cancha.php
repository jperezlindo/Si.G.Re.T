<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cancha extends Model
{
    protected $table='canchas';
    protected $fillabled = ['cod', 'name', 'tipo', 'ancho_cm', 'largo_cm', 'descripcion', 'foto', 'empresa_id'];

    public function scopeBuscar($query, $buscar){
        
        if (trim($buscar) != '')
        {
          return $query
          ->Where('cod', 'like', '%' .$buscar. '%')
          ->orwhere('name', 'LIKE', '%' .$buscar. '%')
          ->orwhere('tipo', 'LIKE', '%' .$buscar. '%');
        }   
    }

    //relaciones
    public function empresa()
    {
        return $this->belongsTo('zzEmpresa');
    }

    public function cancha_servicio()
    {
      return $this->hasMany('App\Cancha_Servicio');
    }
}
