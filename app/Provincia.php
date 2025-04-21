<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    protected $table='provincias';
    protected $fillabled = ['name'];

	public function pais()
    {
        return $this->belongsTo('App\Pais');
    }
    
    public function ciudades()
    {
        return $this->hasMany('App\Ciudad');
    }
}
