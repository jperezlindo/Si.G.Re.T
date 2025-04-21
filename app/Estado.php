<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table='estados';
    protected $fillabled = ['name', 'activo'];


    public function estado_detalle()
    {
      return $this->hasMany('App\Estado_Detalle_Reserva');
    }
}
