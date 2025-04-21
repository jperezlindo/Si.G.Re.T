<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ServicioRequest;
use Illuminate\Support\Collection;
use App\Servicio;
use App\Cancha_Servicio;
use Auth;

class ServicioController extends Controller
{
    public function index(Request $req){
        
        $servicios = Servicio::search($req->get('buscar'))->orderBy('id','ASC')->paginate(10);
        return view('servicio.index', compact('servicios'));
    }

    public function create(){
        
        return view('servicio.create');
    }

    public function store(ServicioRequest $req){

      try {
        
        $se = new Servicio();
        $se->name         = strtoupper($req->name);
        $se->descripcion  = strtoupper($req->descripcion);
        $se->empresa_id   = Auth::user()->user_empresa->empresa->id;
        $se->save();
        
        return redirect (route('servicio.index'))->with('success', 'El Servicio ' . ' ' . $se->name . ' ' . ' se almaceno correctamente!!!'); 
      } catch (\Exception $e) {
        return response()->view('errors.404', [], 404);
      }
    }

    public function edit($id){

        $se = Servicio::findOrFail($id);
        return view('servicio.edit', compact('se'));
    }

    public function update(Request $req, $id){
        $servicio = Servicio::findOrFail($id);
        
        $this->validate($req,[
          'name'  => 'required|max:15|unique:servicios,name,'.$servicio->id,
          'descripcion'  => 'required|string|max:250',
        ]);
        
      try {
        
        
        
        $servicio->name         = strtoupper($req->name);
        $servicio->descripcion  = strtoupper($req->descripcion);
        
        $servicio->save();
        
        return redirect()->route('servicio.index')
            ->with('success', 'El Servicio'. ' ' . $servicio->name.' ' .' se modifico correctamente!!!' ); 
      
      } catch (\Exception $e) {
        //dd($e);
        return response()->view('errors.404', [], 404);
      }
    }

    public function show($id){
      //dd($id);
    }

    public function destroy($id){
      
      try {

        $servicio = Servicio::findOrFail($id);
        $servicio->delete();
        
        return redirect (route('servicio.index'))
          ->with('info', 'El servicio ' . $servicio->name . ' se elimino con Exito!!!' );        
      } catch (\Exception $e) {
        return redirect (route('servicio.index'))->with('danger', 
          'No puede eliminar, El servicio se encuentra asociado a una cancha!');
      }


    }

    public function getServicios ($id_cancha){

      try {
        $servicios = Cancha_Servicio::where('cancha_id', $id_cancha)->get();
        $disponibles = new Collection ();
        foreach ($servicios as $s) {
          if ((!$s->requerido) and ($s->activo)){
            $dis = new Collection();
            $dis->put('id', $s->id);
            $dis->put('servicio', $s->servicio->name);
            $dis->put('precio', $s->precio);
            $disponibles->push($dis);
          }
        }
        return $disponibles;

      } catch (\Exception $e) {
        return response()->view('errors.404', [], 404);
      }
    }
      

    public function getMonto($id_cancha, $ch){

      try {
        
        $servicios = Cancha_Servicio::where('cancha_id', $id_cancha)
                    ->where('requerido',1)->where('activo', 1)->get();
        $total = 0;
        foreach ($servicios as $s) {
          if ($s->xhr){
            $total += $s->precio * $ch;
          }else{
            $total += $s->precio;
          }
        }
        return $total; 
      
      } catch (\Exception $e) {
        return response()->view('errors.404', [], 404);
      }
    }
}
