<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateEmpresaRequest;
use Illuminate\Support\Collection;

use Auth;
use App\Ciudad;
use App\Empresa;
use App\Turno_Dia;
use App\Turno;
use App\Dia;

class EmpresaController extends Controller
{
  public function __construct(){

  }

  public function edit($id){
    
    $emp = Empresa::findOrFail($id);
    $ciudades = Ciudad::all();
  	return view('empresa.edit', compact('emp', 'ciudades'));
  }

  public function update(UpdateEmpresaRequest $req, $id){

    try {

      $emp = Empresa::findOrFail($id);

      $emp->name           = strtoupper($req->name);
      $emp->razon_social   = strtoupper($req->razon_social);
      $emp->cuit           = $req->cuit;
      $emp->tel            = $req->tel;
      $emp->cel            = $req->cel;
      $emp->email          = $req->email;
      $emp->direccion      = strtoupper($req->direccion);
      $emp->rubro          = strtoupper($req->rubro);
      $emp->ciudad_id      = $req->ciudad_id;
      $emp->au             = Auth::user()->user_empresa->id;
      
      if ($req->hasFile('logo')){
        $emp->logo = $req->file('logo')->store('public/logoEmpresa'); 
      }

      $emp->save();

      $notificacion = array(
            'message' => 'LOS DATOS DE LA EMPRESA SE MODIFICARON CON EXITO!.', 
            'alert-type' => 'success',
      );
      return redirect (route('home'))->with($notificacion);

    } catch (\Exception $e) {
      //dd($e);
      return response()->view('errors.404', [], 404);
    }
  }

  public function turno_index()
  {
    try {
      $ds = Dia::all();
      $dias = new Collection();
      foreach ($ds as $d) {
        foreach ($d->turnos_dias as $td) {
          if ($td->activo){  
            $dia = new Collection();
            $dia->put('0',$d->name);
            $dia->put('1', $td->turno->name);
            $dia->put('2', $td->turno->hr_ini);
            $dia->put('3', $td->turno->hr_fin);
            $dia->put('4', $td->id);
            $dias->push($dia);
          }
        }
      }

      $turnos = Turno::where('empresa_id', Auth::user()->user_empresa->empresa_id)->get();
      return view('turnos.index', compact('dias', 'turnos')); 

    } catch (Exception $e) {
        //dd($e);
        return response()->view('errors.404', [], 404);
    }
  }

  public function turno_create()
  {
    $turnos = Turno::where('empresa_id', Auth::user()->user_empresa->empresa_id)->get();
    $dias = Dia::all();
    $turno = new Turno();

    $create = 1;

    return view('turnos.create', compact('turnos', 'dias', 'turno', 'create'));
  }

  public function turno_store(Request $req)
  {
    
    try {
      if ($req->flag){
        $this->validate($req,[
          'name'    => 'required',
          'hr_ini'  => 'required',
          'hr_fin'  => 'required',
        ]);
        
        if (Turno::where('name', strtoupper($req->name))
              ->where('empresa_id', Auth::user()->user_empresa->empresa_id)->get()->isNotEmpty())
          return back()->with('danger', 'EL TURNO YA EXISTE.');

        $turno = new Turno();
        $turno->name       = strtoupper($req->name);
        $turno->hr_ini     = $req->hr_ini;
        $turno->hr_fin     = $req->hr_fin;
        $turno->activo     = 1;
        $turno->empresa_id = Auth::user()->user_empresa->empresa_id;
        $turno->save();

        return redirect()->route('empresa.turnos.create')->with('success', 'EL TURNO FUE AGREGADO CON EXITO');
      }else{
        if (Turno_Dia::where('turno_id', $req->turno_id)->where('dia_id', $req->dia_id)->get()->isNotEmpty())
          return back()->with('danger', 'EL TURNO YA EXISTE.');

        $td = new Turno_Dia();

        $td->dia_id = $req->dia_id;
        $td->turno_id = $req->turno_id;
        $td->activo =1;
        $td->save();
        
        return redirect()->route('empresa.turnos.create')->with('success', 'EL TURNO SE AGREGO CON EXITO');

      }
    } catch (Exception $e) {
        //dd($e);
        return response()->view('errors.404', [], 404);
    }
  }

  public function turno_edit($id)
  {

    $turnos = Turno::where('empresa_id', Auth::user()->user_empresa->empresa_id)->get();
    $dias = Dia::all();
    $turno = Turno::findOrFail($id);

    $create = 0;

    return view('turnos.create', compact('turnos', 'dias', 'turno', 'create'));

  }

  public function turno_update(Request $req)
  {
    try {
      
      $turno = Turno::findOrFail($req->turno_id);

      $turno->hr_ini = $req->hr_ini;
      $turno->hr_fin = $req->hr_fin;
      $turno->save();

      return redirect()->route('empresa.turnos.index')->with('success', 'LOS DATOS SE MODIFICARON CON EXITO');   
    } catch (Exception $e) {
        //dd($e);
        return response()->view('errors.404', [], 404);
    }
  }

  public function turno_destroy(Request $req)
  {
    try {
      $td = Turno_Dia::findOrFail($req->td_id);

      $td->activo = 0;
      $td->save();
      
      return redirect()->route('empresa.turnos.index')->with('success', 'EL TURNO SE DESACTIVO CON EXITO');      
    } catch (Exception $e) {
        //dd($e);
        return response()->view('errors.404', [], 404);
    }
  }
}
