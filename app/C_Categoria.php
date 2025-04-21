<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class C_Categoria extends Model
{
    protected $table='c_categoria';
    protected $fillabled = ['name', 'descripcion', 'activo'];

    public function categoria(){

    	return $this->hasMany('App\Categoria');

    }
}
