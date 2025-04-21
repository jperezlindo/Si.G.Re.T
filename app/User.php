<?php

namespace App;
use App\Empresa;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user', 'dni','apellido','name', 'fecha_nacimiento', 'email', 'cel', 'sexo', 'direccion' ,'password', 'foto', 'ciudad_id', 'empresa_id', 'activo', 'categoria'];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $dates = [
        'fecha_nacimiento',
    ];

    public function scopeBuscar($query, $buscar){
        
        if (trim($buscar) != '')
        {
          return $query
          ->Where('dni', 'like', '%' .$buscar. '%')
          ->orwhere('user', 'LIKE', '%' .$buscar. '%')
          ->orwhere('name', 'LIKE', '%' .$buscar. '%')
          ->orwhere('email', 'LIKE', '%' .$buscar. '%')
          ->orwhere('apellido', 'LIKE', '%' .$buscar. '%');
        }   
    }
    //relaciones

    public function user_empresa()
    {
        return $this->hasOne('App\User_Empresa');
    }

    public function ciudad()
    {
        return $this->belongsTo('App\Ciudad');
    }

    public function rol (){
      
        return $this->user_empresa->rol_id;
    }

}
