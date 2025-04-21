<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
    public function scopeBuscar($query, $buscar){
        
        if (trim($buscar) != '')
        {
          return $query
          ->Where('tabla', 'like', '%' .$buscar. '%')
          ->orwhere('accion', 'LIKE', '%' .$buscar. '%')
          ->orwhere('fecha_hora', 'LIKE', '%' .$buscar. '%');
        }   
    }
}
