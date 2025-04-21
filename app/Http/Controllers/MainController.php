<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Empresa;
use App\User_Empresa;
use App\Ciudad;
use App\Provincia;
use App\Pais;
use App\Rol;
use App\Categoria;
use Auth;
use Carbon\Carbon;
use Input;
use Image;

class MainController extends Controller
{
    public function __construct(){
        Carbon::setLocale('es');
    }


    public function indexLocalidades(Request $req){

        $ciudades = Ciudad::search($req->get('buscar'))->orderBy('id','ASC')->paginate(10);
        return view ('main.indexLocalidades', compact('ciudades'));
    }

    public function finish(){

        $ciudades = Ciudad::all();
        $empresas = Empresa::all();
        $categorias = Categoria::all();
        return view ('auth.registerFinish', compact('ciudades', 'empresas', 'categorias'));
    }

    //Actualiza el registro del recien dado de alta al sistema
    public function update(Request $req, $id){
        $this->validate($req,[
            'dni'              => 'required|min:7|max:8|unique:users',
            'apellido'         => 'required|string',
            'name'             => 'required|string',
            'fecha_nacimiento' => 'required',
        ]);

      try {
        
        $cadena=$req->dni; 
        for($i=0;$i<strlen($cadena);$i++){ 
            if (!(is_numeric($cadena{$i})))
                return back()->with('danger','EL DNI DEBE TENER SOLO CARACTERES NUMERICOS'); 
        }   
            
        $us = User::findOrFail($id);

        $fn = Carbon::parse($req->fecha_nacimiento);
        $edad = Carbon::createFromDate($fn->year, $fn->month, $fn->day)->age;

        if (($edad >= 18) and ($edad < 100)){

            $us->dni              = $req->dni;
            $us->apellido         = strtoupper($req->apellido);
            $us->name             = strtoupper($req->name);
            $us->fecha_nacimiento = $req->fecha_nacimiento;
            $us->cel              = $req->cel;
            $us->email            = $req->email;
            $us->direccion        = strtoupper($req->direccion);
            $us->categoria        = $req->categoria_id;
            $us->sexo             = $req->sexo;

            $us->save();

            $usem = new User_Empresa();
            $usem->user_id      = $us->id;
            $usem->empresa_id   = $req->empresa_id;
            $usem->rol_id       = 4;
            $usem->activo       = true;
            $usem->au           = Auth::user()->id;
            $usem->save();

             
            return redirect()->route('home')
                    ->with('success', 'SU REGISTRO FINALIZO CON EXITO... BIENVENIDO A Si.G.Re.T');
        }else{
            return redirect()->back()->with('danger', 'EDAD NO ACEPTADA');
        }

      } catch (\Exception $e) {
        //dd($e);
        return response()->view('errors.404', [], 404);
      } 

    }

    public function createCiudad(){
 
        $provincias = Provincia::all();
        return view('main.createCiudad', compact('provincias'));
    }

    public function storeCiudad(Request $req){
        $this->validate($req,[
            'name' => 'required|string|unique:ciudades,name,',
            'cp' => 'required|numeric|unique:ciudades,cp,',
        ]);

      try {

        $cadena=$req->cp; 
        for($i=0;$i<strlen($cadena);$i++){ 
          if (!(is_numeric($cadena{$i})))
              return back()->with('danger','EL CODIGO POSTAL DEBE TENER SOLO NUMEROS')->withInput();
        }

        $ciudad = new Ciudad();
        $ciudad->name           = strtoupper($req->name);
        $ciudad->cp             = $req->cp;
        $ciudad->provincia_id   = $req->provincia_id;
        
        $ciudad->save();
        flash('La ciudad ' . $ciudad->name . ' de agrego con exito!!!')->success();
        return redirect(route('main.indexLocalidades'));
        
      } catch (\Exception $e) {
        return response()->view('errors.404', [], 404);
      }
    }

    public function createProvincia(){
 
        $paises = Pais::all();
        return view('main.createProvincia', compact('paises'));
    }

    public function storeProvincia(Request $req){
        $this->validate($req,[
            'name' => 'required|string|unique:provincias,name,',
        ]);
      try {
        
        $prov = new Provincia();
        $prov->name      = strtoupper($req->name);
        $prov->pais_id   = $req->pais_id;
        
        $prov->save();

        flash('La Provincia ' . $prov->name . ' se agrego con exito!!!')->success();
        return redirect(route('main.createProvincia'));
        
      } catch (\Exception $e) {
        return response()->view('errors.404', [], 404);
      } 
    }

    public function createPais(){
 
        return view('main.createPais');
    }

    public function storePais(Request $req){
        $this->validate($req,[
            'name' => 'required|string|unique:paises,name',
        ]);
      try {

        $pais = new Pais();
        $pais->name      = strtoupper($req->name);

        $pais->save();
        flash('El Pais '. $pais->name . ' se agrego con exito!!!')->success();
        return redirect(route('main.createPais'));

      } catch (\Exception $e) {
        return response()->view('errors.404', [], 404);
      }
    }

    public function createRol(){

        return view('main.createRol');
    }

    public function storeRol(Request $req){

      try {

        $this->validate($req,[
            'tipo' => 'required|string|unique:roles,tipo,',
        ]);

        $rol = new Rol();
        $rol->tipo = strtoupper($req->tipo);

        $rol->save();
        flash('El ROL '. $rol->tipo . ' se agrego con exito!!!')->success();
        return redirect(route('main.createRol'));
                
      } catch (\Exception $e) {
        return response()->view('errors.404', [], 404);
      }
    }

    

}
