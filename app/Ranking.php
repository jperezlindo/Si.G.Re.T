<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    protected $table='ranking';
    protected $fillabled = ['promedio', 'puntos', 'torneos_jugados', 'user_id', 'posicion'];

    public function user_empresa()
    {
        return $this->belongsTo('App\User_Empresa');
    }
}
