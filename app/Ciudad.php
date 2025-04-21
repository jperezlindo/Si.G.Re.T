<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    protected $table='ciudades';
    protected $fillabled = ['cp', 'name'];


    public function scopeSearch($query, $buscar){
        
        if (trim($buscar) != '')
        {
          return $query
          ->Where('cp', 'like', '%' .$buscar. '%')
          ->orwhere('name', 'LIKE', '%' .$buscar. '%');
        }   
    }

    public function provincia()
    {
        return $this->belongsTo('App\Provincia');
    }

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function empresas()
    {
        return $this->hasMany('App\Empresa');
    }
}
