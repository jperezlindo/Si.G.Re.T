<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table='roles';
    protected $fillabled = ['name', 'descripcion', 'activo'];

    public function users_empresa()
    {
        return $this->hasOne('App\User_Empresa');
    }
}
