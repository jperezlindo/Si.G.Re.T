<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class C_Sexo extends Model
{
    protected $table='c_sexo';
    protected $fillabled = ['name', 'descripcion', 'activo'];

    public function categoria(){

    	return $this->hasMany('App\Categoria');

    }
}
