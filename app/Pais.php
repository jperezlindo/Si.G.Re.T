<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $table='paises';
    protected $fillabled = ['name'];

    public function provincias()
    {
        return $this->hasMany('App\Provincia');
    }
}
