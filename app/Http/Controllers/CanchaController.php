<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\CanchaRequest;
use App\Http\Requests\Cancha_ServicioRequest;

use Illuminate\Support\Collection;
use Carbon\Carbon;
use App\Cancha;
use App\Servicio;
use App\Cancha_Servicio;
use App\Servicio_Requerido;
use App\Dia;
use App\Turno_Dia;
use App\Detalle_Reserva;

use Auth;

class CanchaController extends Controller
{
    public function __construct(){

  	}

  public function index(Request $req){ 

    $canchas = Cancha::buscar($req->get('buscar'))->orderBy('id','ASC')->paginate(10);
    return view('cancha.index', compact('canchas'));
  }

  	public function create(){

      return view ('cancha.create');
  	}

  	public function store(CanchaRequest $req){
      
      try {
        $cancha = new Cancha();

        $cancha->cod          = $req->cod;
        $cancha->name         = strtoupper($req->name);
        $cancha->tipo         = strtoupper($req->tipo);
        $cancha->ancho_cm     = $req->ancho_cm;
        $cancha->largo_cm     = $req->largo_cm;
        $cancha->descripcion  = strtoupper($req->descripcion);
        
        if ($req->hasFile('foto')){
          $cancha->foto = $req->file('foto')->store('public/canchasImages');
        }
        $cancha->empresa_id   = Auth::user()->user_empresa->empresa->id;
        $cancha->save();

        return redirect (route('cancha.index'))->with('success', 'La nueva cancha se agrego con exito!!!' );
        
      } catch (\Exception $e) {
        dd($e);
         return response()->view('errors.404', [], 404);
      }


  	}

  	public function show($id){

      $cancha = Cancha::with('cancha_servicio')->findOrFail($id);

      return view('cancha.show', compact('cancha'));

  	}

  	public function edit($id){

      $cancha = Cancha::findOrFail($id);
      return view ('cancha.edit', compact('cancha'));

  	}

  	public function update(Request $req, $id){
        $cancha = Cancha::findOrFail($id);
        
        $this->validate($req,[
          'cod'      => 'required|string|max:6|unique:canchas,cod,'.$cancha->id,
          'name'     => 'required|string|max:35|unique:canchas,name,'.$cancha->id,
          'tipo'     => 'required|string',
          'ancho_cm' => 'required|numeric',
          'largo_cm' => 'required|numeric',
        ]);
        
      try {

        $cancha->cod          = $req->cod;
        $cancha->name         = strtoupper($req->name);
        $cancha->tipo         = strtoupper($req->tipo);
        $cancha->ancho_cm     = $req->ancho_cm;
        $cancha->largo_cm     = $req->largo_cm;
        $cancha->descripcion  = strtoupper($req->descripcion);
      
        if ($req->hasFile('foto')){
          $cancha->foto       = $req->file('foto')->store('public/canchasImages');
        }
        $cancha->save();
        
        //flash('La cancha'. ' ' . $cancha->name.' ' .' se modifico correctamente!!!')->success();
        return redirect (route('cancha.index'))->with('success', 'La cancha'. ' ' . $cancha->name.' ' .' se modifico correctamente!!!');
      
      } catch (\Exception $e) {
        return response()->view('errors.404', [], 404);
      }
  	}

  	public function destroy($id){

      try {
        
        $cancha = Cancha::findOrFail($id);
        $cancha->delete();
        //flash('La cancha ' . $cancha->name. ' se elimino con Exito!!!')->success();
        return redirect (route('cancha.index'))->with('info', 'La cancha ' . $cancha->name. ' se elimino con Exito!!!');
      
      } catch (\Exception $e) {
          return redirect (route('cancha.index'))->with('danger', 'No puede eliminar, La cancha Tiene Servicios Asociados');        
      }
      


  	}

    //Metodos para agregar servicios a chanchas

    public function addService(){

      $servicioss = Servicio::all();
      $case = Cancha_Servicio::all();


      $canchas = Cancha::where('activo', true)->get();
      $ofrecidos = Cancha_Servicio::with('cancha', 'servicio')->get();
      $servicios = new Collection();
      
      foreach ($ofrecidos as $o) {
        if($o->cancha->activo) $servicios->push($o);
      }

      return view ('cancha.addService', compact('canchas', 'servicios', 'case', 'servicioss'));

    }

    public function storeService(Cancha_ServicioRequest $req){

      try {

        $cadena=$req->precio; 
        for($i=0;$i<strlen($cadena);$i++){ 
            if (!(is_numeric($cadena{$i})))
                return back()->with('danger','Ingrese valores numericos como PRECIO.'); 
        } 
        
        $asociado = DB::table('cancha_servicio')
                      ->where('cancha_id', $req->cancha_id)
                      ->where('servicio_id', $req->servicio_id)
                      ->get();

        if ($asociado->isNotEmpty())
          return back()->with('warning', 'ATENCION: El servicio no se puede duplicar');

 

        $cs = new Cancha_Servicio();
        $cs->cancha_id    = $req->cancha_id;
        $cs->servicio_id  = $req->servicio_id;
        $cs->precio       = $req->precio;
        $cs->requerido    = $req->requerido;
        $cs->xhr          = $req->xhr;

        $cs->save();
        
        return redirect (route('cancha.addService'))->with('success', 'El Servicio se Asocio con exito!!!' ); 
      } catch (Exception $e) {
          return response()->view('errors.404', [], 404);
      }      
    }

//--------------------------------------------------------------------------------------

    public function editService($id)
    {
      $cs = Cancha_Servicio::with('cancha', 'servicio')->findOrFail($id);

      return view('cancha.editService', compact('cs'));
    }
//--------------------------------------------------------------------------------------

    public function updateService(Request $req)
    {
      try {
        $cs = Cancha_Servicio::findOrFail($req->cs_id);

        $cs->precio = $req->precio;
        $cs->requerido = $req->requerido;
        $cs->xhr = $req->xhr;
        $cs->activo = $req->activo;
        $cs->save();

        return redirect()->route('cancha.addService')->with('success', 'El datos se modificaron con exito');
      } catch (Exception $e) {
        return response()->view('errors.404', [], 404);
      }
    }

//--------------------------------------------------------------------------------------
    public function getCanchas (Request $req){
      
      try {

        $fecha = $req->fecha_reservada;
        $fecha_actual = Carbon::now()->toDateString();
        $fecha_reserva = Carbon::parse($fecha)->toDateString();

        if ($fecha_reserva < $fecha_actual ){
          $msj = new Collection();
          $msj->put('f', true);
          return $msj;
        } 
        
        $d = new Dia();
        $dia = Dia::where('name', $d->get_nombre_dia($fecha))->first();
        
        //Obtiene el total de horas ofrecidos en alquiler para la fecha
        $ttdd = (Turno_Dia::get()->where('dia_id', $dia->id))->where('activo', 1);
        
        if ($ttdd->isEmpty()){
          $msj = new Collection();
          $msj->put('f', 2);
          return $msj;
        }
        
        $total_hs = 0;
        foreach ( $ttdd as $td) {
          $dif = (int)$td->turno->hr_fin - (int)$td->turno->hr_ini;
          $total_hs += $dif;
        }

        //obtiene la cantidad de horas reservadas para la fecha
        $total_hs_res = 0;
        foreach ((Detalle_Reserva::where('fecha_reservada', $fecha)->get()) as $detalle) {
          $total_hs_res += $detalle->cant_hs;
        }

        //obtiene las canchas reservadas por fecha
        $canchas = Cancha::all();
        if ($total_hs_res < ($total_hs * $canchas->count())){
          
          //obtiene el servicio alquiler de cada cancha para la fecha
          $ddrr = Detalle_Reserva::where('fecha_reservada', $fecha)->get();
          $servicio = Servicio::where('name', 'ALQUILER')->first();
          $ccss = Cancha_Servicio::all()->where('servicio_id', $servicio->id);
          $requeridos = new Collection();
          foreach ($ccss as $cs) {
            foreach ($ddrr as $dr) {
              $ssrr = Servicio_Requerido::all()
              ->where('detalle_reserva_id', $dr->id)->where('cancha_servicio_id', $cs->id);
              foreach ($ssrr as $sr) {
                $requeridos->push($sr);
              }  
            }
          }

          //Obtiene las canchas disponibles para la fecha
          $canchas_disponibles = new Collection();
          foreach ($canchas as $cancha) {
            $hs_res = 0;
            foreach ($requeridos as $sr) {
              if ($cancha->id == $sr->cancha_servicio->cancha_id)
                $hs_res += (int)$sr->detalle_reserva->cant_hs;    
            }
            if( $hs_res < $total_hs)
               $canchas_disponibles->push($cancha);  
          }

          return $canchas_disponibles;
          
        }else{
          return 'En estos momentos no disponemos de canchas';
        }

      } catch (\Exception $e) {
        return response()->view('errors.404', [], 404);
      }
    }
      
}
