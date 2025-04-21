<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use App\Ciudad;
use App\Categoria;
use App\Empresa;
use App\User_Empresa;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;



class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'user'             => 'required|string|max:255|unique:users',
            'dni'              => 'required|min:7|max:8|unique:users',
            'apellido'         => 'required|string',
            'name'             => 'required|string',
            'fecha_nacimiento' => 'required',
            'email'            => 'required|string|email|max:255|unique:users',
            'cel'              => 'required',
            'direccion'        => 'required',
            'password'         => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    public function showRegistrationForm()
    {
        $ciudades = Ciudad::all();
        $empresas = Empresa::all();
        $categorias = Categoria::all();

        return view('auth.register', compact('ciudades', 'empresas', 'categorias'));
    }

    protected function create(array $data)
    {

        try {
        
            $cadena=$data['dni'];
            for($i=0;$i<strlen($cadena);$i++){ 
                if (!(is_numeric($cadena{$i})))
                    return back()->with('danger','EL DNI DEBE TENER SOLO CARACTERES NUMERICOS'); 
            }

            $user = new User();
             
            $user->user             = $data['user'];
            $user->dni              = $data['dni'];
            $user->apellido         = strtoupper($data['apellido']);
            $user->name             = strtoupper($data['name']);
            $user->fecha_nacimiento = $data['fecha_nacimiento'];
            $user->email            = $data['email'];
            $user->cel              = $data['cel'];
            $user->direccion        = strtoupper($data['direccion']);
            $user->sexo             = $data['sexo'];
            $user->categoria        = $data['categoria_id'];
            $user->ciudad_id        = $data['ciudad_id'];
            $user->au               = 0;
            $user->password         = bcrypt($data['password']);
            $user->save();

            $usem = new User_Empresa(); // usem representa a un objeto usuario_empresa
            $usem->user_id    = $user->id;
            $usem->empresa_id = $data['empresa_id'];
            $usem->rol_id     = 4; // cliente
            $usem->activo     = 1;
            $usem->au         = $user->id;
            $usem->save();
           

            return $user;
        } catch (Exception $e) {
            return response()->view('errors.404', [], 404);
        }
    }  
    
}
