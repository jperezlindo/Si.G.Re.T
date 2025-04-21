<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class C_Etario extends Model
{
    protected $table='c_etario';
    protected $fillabled = ['name', 'descripcion', 'activo'];

    public function categoria(){

    	return $this->hasMany('App\Categoria');

    }
}
