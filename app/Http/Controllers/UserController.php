<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Collection;
use App\User;
use App\Rol;
use App\Ciudad;
use App\Categoria;
use App\User_Empresa;
use Auth;
use Carbon\Carbon;
use Input;
use Image;
use Hash;
class UserController extends Controller
{

//-------------------------------------------------------
  public function __construct(){
    Carbon::setLocale('es');
  }
//-------------------------------------------------------
  public function index(Request $req){ 
    
    $usuarioss = User::with('user_empresa')->where('activo', 1)->buscar($req->buscar)->orderBy('id','DESC')->paginate(10);
    $total = User_Empresa::where('empresa_id', Auth::user()->user_empresa->empresa_id)->where('activo', 1)->get()->count();

    $usuarios = new Collection();
    foreach ($usuarioss as $us) {
      if($us->user_empresa->activo)
        $usuarios->push($us);
    }
    return view('users.index', compact('usuarios', 'total'));
  }
//-------------------------------------------------------
  public function create(){ 
    
    $ciudades = Ciudad::all();

    return view('users.create', compact('ciudades'));
  }
//-------------------------------------------------------
  public function store(CreateUserRequest $req){
    
    try {

      $cadena=$req->dni; 
      for($i=0;$i<strlen($cadena);$i++){ 
          if (!(is_numeric($cadena{$i})))
              return back()->with('danger','EL DNI DEBE TENER SOLO CARACTERES NUMERICOS')->withInput();
      }

      $cadena=$req->cel; 
      for($i=0;$i<strlen($cadena);$i++){ 
          if (!(is_numeric($cadena{$i})))
              return back()->with('danger','EL CELULAR DEBE TENER SOLO CARACTERES NUMERICOS')->withInput();
      }  
      
      $fn = Carbon::parse($req->fecha_nacimiento);
      $edad = Carbon::createFromDate($fn->year, $fn->month, $fn->day)->age;

      if (($edad >= 5) and ($edad < 100)){
        
        $us = new User($req->all());
        $us->password = bcrypt($req->password);
        $us->au       = Auth::user()->user_empresa->id;
        $us->save();

        $usem = new User_Empresa(); // usem representa a un objeto usuario_empresa
        $usem->user_id      =  $us->id;
        $usem->empresa_id   = Auth::user()->user_empresa->empresa->id;
        $usem->au           = Auth::user()->user_empresa->id;
        $usem->rol_id       = 4; // cliente
        $usem->save();

        return redirect (route('users.index'))
              ->with('success', 'El Usuario: ' . $us->user . ', se almaceno correctamente!!!');
      }else{
        return redirect()->back()->with('danger', 'EDAD NO ACEPTADA')->withInput();
      }

    } catch (\Exception $e) {
        return response()->view('errors.404', [], 404);
    }
    
  }
//-------------------------------------------------------
  public function edit($id){
    
    $us = User::with('user_empresa')->findOrFail($id);
    $ciudades = Ciudad::all();
    $categorias = Categoria::with('c_categoria', 'c_etario', 'c_sexo')->get();
    $categoria = Categoria::with('c_categoria', 'c_etario', 'c_sexo')->find($us->categoria);
    $roles = Rol::all();
    $ue = User_Empresa::with('rol')
          ->where('user_id', $us->id)
          ->where('empresa_id', Auth::user()->user_empresa->empresa_id)
          ->first();

    return view('users.edit', compact('us', 'ciudades', 'categorias', 'categoria', 'roles', 'ue'));
  }
//-------------------------------------------------------
  public function editProfile($id){
    
    $us = User::find($id);
    $ciudades = Ciudad::all();
    $categorias = Categoria::with('c_categoria', 'c_etario', 'c_sexo')->get();
    $categoria = Categoria::with('c_categoria', 'c_etario', 'c_sexo')->findOrFail($us->categoria);
    $roles = Rol::all();
    $ue = User_Empresa::with('rol')
          ->where('user_id', $us->id)
          ->where('empresa_id', Auth::user()->user_empresa->empresa_id)
          ->first();

    return view('users.edit', compact('us', 'ciudades', 'categorias', 'categoria', 'roles', 'ue'));
  }
//-------------------------------------------------------
  public function update(Request $req, $id){

      $us = User::findOrFail($id);
      
      $this->validate($req,[
      'user'             => 'required|string|unique:users,user,'.$us->id,
      'dni'              => 'required|min:7|max:8|unique:users,dni,'.$us->id,
      'apellido'         => 'required|string',
      'name'             => 'required|string',
      'email'            => 'required|email|unique:users,email,'.$us->id,
      'fecha_nacimiento' => 'required',
      'foto'             => 'image',
      ]);

    try {
      
            
      $cadena=$req->cel; 
      for($i=0;$i<strlen($cadena);$i++){ 
          if (!(is_numeric($cadena{$i})))
              return back()->with('danger','EL CELULAR DEBE TENER SOLO CARACTERES NUMERICOS')->withInput();
      }  

      $fn = Carbon::parse($req->fecha_nacimiento);
      $edad = Carbon::createFromDate($fn->year, $fn->day, $fn->month)->age;
    
      if (($edad >= 18) and ($edad < 100)){
        //$us = User::find($id);
        $us->dni              = $req->dni;
        $us->user             = $req->user;
        $us->apellido         = strtoupper($req->apellido);
        $us->name             = strtoupper($req->name);
        $us->fecha_nacimiento = $req->fecha_nacimiento;
        $us->cel              = $req->cel;
        $us->email            = $req->email;
        $us->direccion        = strtoupper($req->direccion);
        $us->sexo             = $req->sexo;
        $us->ciudad_id        = $req->ciudad_id;
        $us->categoria        = $req->categoria_id;
        $us->au               = Auth::user()->user_empresa->id;
        if ($req->hasFile('foto')){
          $us->foto           = $req->file('foto')->store('public/userImages');
        }

        $us->save();   
        
        $ue = User_Empresa::findOrFail($req->ue_id);
        $ue->rol_id = $req->rol_id;
        $ue->au     = Auth::user()->user_empresa->id;
        $ue->save();
        
        return redirect()->back()->with('success', 'El Usuario: ' . $us->user .' se modifico correctamente!!!' );
      
      }else{
         return redirect()->back()->with('danger', 'Edad no Aceptada'); 
      }
        
      } catch (\Exception $e) {
        //dd($e);
        return response()->view('errors.404', [], 404);
      }
   
  }
//-------------------------------------------------------
  public function destroy($id)
  {

    try {
      
      $ue = User_Empresa::where('user_id', $id)->first();
      $us = User::findOrFail($id);

      $us->activo = false;
      $us->au     = Auth::user()->user_empresa->id;
      $us->save();
      $ue->activo = false;
      $ue->save();
      
      return redirect (route('users.index'))
      ->with('success', 'El Usuario: ' . $us->name .', se dio de baja correctamente!'); 
    
    } catch (\Exception $e) {
      dd($e);
      return response()->view('errors.404', [], 404);
    }

  }
//-------------------------------------------------------
  public function show($id){
    
    $us = User::findOrFail($id);
    
    return view('users.show', compact('us'));
  }
//-------------------------------------------------------
  //metodos para modificar la contraseña del usuario
  public function editPass(){
    
    return view('users.editPassword');
  }
//-------------------------------------------------------
  public function updatePass(Request $req, $id){
  
      $this->validate($req,[
          'myPassword' => 'required',
          'password' => 'required|confirmed|min:6',]);

      try {
        
        if (Hash::check($req->myPassword, Auth::user()->password)){
          
          $us = User::findOrFail(Auth::user()->id);
          $us->password = bcrypt($req->password);   
          $us->save();
          
          return view ('home')->with('success', 'El contraseña se modifico corectamente!!!');
        }else{
          
          return redirect(route('users.editPass'))->with('warning', 'La contraseña actual no coincide con nuestros registros!!!');
        }
      } catch (\Exception $e) {
        return response()->view('errors.404', [], 404);
      }

  }

}


