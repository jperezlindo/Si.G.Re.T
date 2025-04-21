<?php 

namespace App\Http\Controllers;


use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use PDF;
use App\Http\Requests\ReservaResquest;
use App\Http\Requests\Detalle_DeservaRequest;
use Carbon\Carbon;
use App\Dia;
use App\User;
use App\Jugador;
use App\Reserva;
use App\Cancha;
use App\Servicio;
use App\Cancha_Servicio;
use App\Detalle_Reserva;
use App\Turno;
use App\Turno_Dia;
use App\Servicio_Requerido;
use App\Estado_Detalle_Reserva;
use App\Empresa;

class ReservaController extends Controller
{


    public function __construct(){
      Carbon::setLocale('es');
      $this->middleware('auth');
    }


//--------------------------------------------------------------------------------------
    public function index(){

      return view('reserva.index');
      
    }

//--------------------------------------------------------------------------------------
    public function create (){
      $empresa = Empresa::findOrFail(Auth::user()->user_empresa->empresa_id);
      $canchas = Cancha::where('activo', true)->get();
      $ofrecidos = Cancha_Servicio::with('cancha', 'servicio')->get();
      $servicios = new Collection();
      
      foreach ($ofrecidos as $o) {
        if($o->cancha->activo) $servicios->push($o);
      }
      return view('reserva.create', compact('empresa', 'canchas', 'servicios')); 
    }

//--------------------------------------------------------------------------------------
    public function getReservas (){
      
      $res = Reserva::with('detalles_reserva')
                  ->where('user_empresa_id', Auth::user()->user_empresa->id)
                  ->where('activo', 1)->where('confirmada', 1)
                  ->where('finalizada', 0)
                  ->get(); //->reverse();

      //rnc = reservas no confirmadas
      $rnc = Reserva::with('detalles_reserva')->where('user_empresa_id', Auth::user()->user_empresa->id)
      ->where('activo', 1)->where('confirmada', 0)->get()->reverse();


      
      ///busca canchas no confirmadas en caso de q el usuario no tenga reservas sin confirmar      
      $cnc = new Collection();
      foreach ($res as $rs) {
        $ddrr = Detalle_Reserva::where('reserva_id', $rs->id)->where('activo', 1)->where('confirmada', 0)->get();
        if ($ddrr->isNotEmpty()){
          foreach ($ddrr as $dr) {
              if (!$cnc->contains($dr))
                $cnc->push($dr);
          }
        }
      }
      $res = $res->sortBy('fecha_reservada');
      $reservas = new Collection();
      foreach ($res as $rs) {
        foreach ($rs->detalles_reserva as $dr) {
          $dr->ca = Cancha::findOrFail($dr->ca)->name;
          $reservas->push($dr);
        }
      }
      
      //dd($reservas);

      return view('reserva.misReservas', compact('reservas', 'rnc', 'cnc')); 
    }

//--------------------------------------------------------------------------------------
    public function consultarReservas(Request $req){
      
      $canchas = Cancha::where('empresa_id', Auth::user()->user_empresa->empresa_id)->get();
      
      $reservas = new Collection();
      foreach ($canchas as $ca) {
        $ddrr = Detalle_Reserva::with('reserva')->where('ca', $ca->id)->where('activo', 1)->get();
        foreach ($ddrr as $dr) {
          //dd(Carbon::parse($req->fecha), $dr->fecha_reservada);
          if (Carbon::parse($req->fecha) == $dr->fecha_reservada){
            $dr->ca = $ca->name;
            $dr->au = User::findOrFail($dr->reserva->user_empresa->user_id)->user;

            $reservas->push($dr);
          }
          
          if(empty($req->fecha) and $req->flag){
            $dr->ca = $ca->name;
            $dr->au = User::findOrFail($dr->reserva->user_empresa->user_id)->user;

            $reservas->push($dr);
          }  

        }
      }

      $reservas = $reservas->sortBy('fecha_reservada');
      //dd($reservas);
      return view('reserva.consultarReservas', compact('reservas'));
    }

//--------------------------------------------------------------------------------------
      public function store(Detalle_DeservaRequest $req){
        
        //fhcu = variable que recibira si la fecha hora y cancha que se quiere reservar ya esta ocupada por el usuario.
        $fhcu = Detalle_Reserva::ExisteReservaUsuario($req->fecha_reservada, $req->hr_reservada, $req->cancha_id);
 
        if ($fhcu->isNotEmpty())
           return redirect()->route('reserva.index')
                    ->with('warning', 'YA DISPONE DE LA RESERVA, CONFIRMELA EN: "Reservas -> Mis Reservas -> No Confirmadas"');     
        
        // fhc = variable que recibira si la fecha hora y cancha que se quiere reservar ya esta ocupada.
        $fhc = Detalle_Reserva::ExisteReserva($req->fecha_reservada, $req->hr_reservada, $req->cancha_id);
 
        if ($fhc->isNotEmpty())
           return redirect()->route('reserva.index')
                    ->with('warning', 'LO SENTIMOS, LA CANCHA YA NO SE ENCUENTRA DISPONIBLE PARA LA FECHA Y HORARIO ELEGIDO.');    
        
        try {
          //almacena la reserva
          $reserva = new Reserva();
          
          $reserva->fija             = false;
          $reserva->dia              = null;
          $reserva->total            = 0;
          $reserva->activo           = true;
          $reserva->au               = 0;
          $reserva->user_empresa_id  = Auth::user()->user_empresa->id;
          $reserva->save();

          //amacena el detalle de reserva
          $dr = new Detalle_Reserva();
          
          $dr->fecha_reservada  = $req->fecha_reservada;
          $dr->hr_reservada     = $req->hr_reservada;
          $dr->cant_hs          = $req->cant_hs;
          $dr->monto            = 0;
          $dr->ca               = $req->cancha_id;
          $dr->reserva_id       = $reserva->id;
          $dr->au               = Auth::user()->user_empresa->id;
          /////guarda automaticamente el campo confirmada en false
          $dr->save();
          

          //almacena los servicios obligatorios para el detalle y obtiene la sumatoria de los montos de los mismos
          $canser = Cancha_Servicio::all()
                        ->where('cancha_id', $req->cancha_id)
                        ->where('requerido', true); 
          
          $total_servicios = 0;
          foreach ($canser as $cs) {
            $sr = new Servicio_Requerido();
            $sr->precio             = $cs->precio;
            $sr->cancha_servicio_id = $cs->id;
            $sr->detalle_reserva_id = $dr->id;
            $sr->save();
            if ($cs->xhr){
              $total_servicios += ($cs->precio * $req->cant_hs);
            }else{
              $total_servicios += $cs->precio;
            }
          }
          
          //actualiza los montos tanto en la reserva como en el detalle
          $dr->monto      = $total_servicios;
          $dr->save();
          $reserva->total = $total_servicios;
          $reserva->save();
          
          return redirect()->route('detalle_reserva.asociarServicios', $dr->id);  
        
        } catch (\Exception $e) {
          //dd($e);
          return response()->view('errors.404', [], 404);
        }
    }

//--------------------------------------------------------------------------------------

    public function show(Request $req, $id_reserva){
      
      try {

        $detalles   = Detalle_Reserva::where('reserva_id', $id_reserva)->where('activo', 1)->get();
              
        $asociados = new Collection();
        $confirmados = new Collection();
        
        //Captura todos los servicios asociados a la reserva
        foreach ($detalles as $detalle) {
          
          $ssrr = Servicio_Requerido::with( 'detalle_reserva','cancha_servicio')->where('detalle_reserva_id', $detalle->id)->get();
          foreach ($ssrr as $sr) {
            $asociados->push($sr); 
          }

          $confirmadoss = Jugador::with('user_empresa')->where('detalle_reserva_id', $detalle->id)
                                  ->where('activo', 1)->where('confirmo', 1)->get();
          
          foreach ($confirmadoss as $co) {
            $confirmado = new Collection();
            $user = User::findOrFail($co->user_empresa->user_id);
            
            $confirmado->put('user', $user->user);
            $confirmado->put('ape', $user->apellido);
            $confirmado->put('name', $user->name);
            $confirmado->put('email', $user->email);
            $confirmado->put('fec', $detalle->fecha_reservada);
            $confirmado->put('hr', $detalle->hr_reservada);


            $confirmados->push($confirmado);
          }

          
        }
        //--------------------------------------------------

        $reserva = Reserva::findOrFail($detalle->reserva_id);
        return view('reserva.show', compact('detalles', 'asociados', 'reserva', 'confirmados'));        
      
      } catch (\Exception $e) {
        
        return response()->view('errors.404', [], 404);
      }
    }

//--------------------------------------------------------------------------------------
    public function pdf_reserva (Request $req)
    {

        $emp     = Empresa::findOrFail($req->empresa_id);
        $fecha   = Carbon::now();

        $detalles   = Detalle_Reserva::where('reserva_id', $req->reserva_id)->where('activo', 1)->get();
              
        $asociados = new Collection();
        //Captura todos los servicios asociados a la reserva
        foreach ($detalles as $detalle) {
          $ssrr = Servicio_Requerido::with( 'detalle_reserva','cancha_servicio')->where('detalle_reserva_id', $detalle->id)->get();
          foreach ($ssrr as $sr) {
            $asociados->push($sr);
          }
        }
        //--------------------------------------------------
        $reserva = Reserva::findOrFail($req->reserva_id);
        
        //return view('reserva.pdf_reserva', compact('detalles', 'asociados', 'fecha', 'emp'));

        $pdf = PDF::loadView('reserva.pdf_reserva', [
            'detalles'  => $detalles,
            'asociados' => $asociados, 
            'emp'       => $emp,
            'fecha'     => $fecha
        ]);
        
        $pdf->setPaper('a4'); // , 'landscape' pone la hoja en horizontal

        return $pdf->stream();

    }

//--------------------------------------------------------------------------------------

    public function destroy(Request $req, $id_r){

      try {
        
        $fecha = Carbon::now();
        $fecha_actual = $fecha->format('d/m/Y');
        $hora_actual  = $fecha->format('H');
        
        if ($hora_actual == 00) $hora_actual = 24;

        $ddrr = Detalle_Reserva::where('reserva_id', $id_r)->where('activo', true)->get();

        foreach ($ddrr as $dr) {
          $fecha_reservada  = $dr->fecha_reservada->format('d/m/Y');
          $hr = 5;
          
          if ($fecha_reservada == $fecha_actual){
            $hora_cancelacion = (int)$dr->hr_reservada - $hr;
            if ($hora_actual > $hora_cancelacion){
              $mensaje = 'LAS RESERVAS SOLO SE PUEDEN ANULAR CON 5 HORAS DE ANTELACION, GRACIAS!.';
              if ($req->consultar)
                return redirect()->route('reserva.consultarReservas')
                     ->with('danger', $mensaje);
              return redirect(route('reserva.misReservas'))
                    ->with('danger', $mensaje);
            }
          }
          
          $edr = new Estado_Detalle_Reserva();
          $edr->detalle_reserva_id = $dr->id;
          $edr->estado_id = 3; //3 estado cancalada
          $edr->comentario = $req->comentario;
          $edr->save();
          $dr->activo = false;
          $dr->save();

          $jugadores = Jugador::where('detalle_reserva_id', $dr->id)->get();
          foreach ($jugadores as $j) {
            $j->delete();
          }

        }

        $reserva = Reserva::findOrFail($id_r);
        $reserva->activo = false;
        $reserva->save();
        
        $mensaje = 'SU RESERVA SE CANCELO CON EXITO!.';
        if ($req->consultar)
          return redirect()->route('reserva.consultarReservas')->with('success', $mensaje);
        

        return redirect()->route('reserva.misReservas')->with('success', $mensaje);        
      
      } catch (\Exception $e) {
        return response()->view('errors.404', [], 404);
      }
    }

//--------------------------------------------------------------------------------------

    public function confirmarReserva (Request $req){

      try {
            $ddrr = Detalle_Reserva::where('reserva_id', $req->reserva_id)->where('activo',1)->get();
            
            foreach ($ddrr as $dr) {
              
              $fhc = Detalle_Reserva::ExisteReserva($dr->fecha_reservada, $dr->hr_reservada, $dr->ca);
              
              if ($fhc->isNotEmpty()){
                $ssrr = Servicio_Requerido::where('detalle_reserva_id', $dr->id)->get();
                foreach ($ssrr as $sr) {
                  $sr->delete();
                }

                $dr->activo     = false;
                $dr->confirmada = false;
                $dr->au         = Auth::user()->user_empresa->id;
                $dr->save();
              } 
            }

            $ddrr = Detalle_Reserva::where('reserva_id', $req->reserva_id)->where('activo',1)->get();
            
            if($ddrr->isEmpty()){
              $reserva = Reserva::findOrFail($dr->reserva_id);
              $reserva->activo = false;
              $reserva->save();
              
              return redirect()->route('reserva.misReservas')
                      ->with('warning', 'LO SENTIMOS, LA CANCHA YA NO SE ENCUENTRA DISPONIBLE PARA LA FECHA Y HORARIO ELEGIDO.'); 
            }

            // Confirma todos la reserva con sus detalles.
            $reserva = Reserva::findOrFail($req->reserva_id);

            $reserva->confirmada = true;
            $reserva->save();

            $ddrr = Detalle_Reserva::with('reserva')->where('reserva_id', $reserva->id)->where('activo', 1)->get();
            foreach ($ddrr as $dr) {
              $dr->confirmada = true;
              $dr->save();
              $estados = Estado_Detalle_Reserva::where('detalle_reserva_id', $dr->id)->get();
              if (!$estados->contains('estado_id', 1)){
                //almacena el estado de la reserva 1-iniciada 2-finalizada 3-cancelada
                $estado = new Estado_Detalle_Reserva();
                $estado->estado_id = 1;
                $estado->detalle_reserva_id = $dr->id;
                $estado->save();
              }
            }
            return redirect()->route('jugadores.avisarJugadores', $req->reserva_id);
      } catch (Exception $e) {
          //dd($e);
          return response()->view('errors.404', [], 404);
      }

    }

//--------------------------------------------------------------------------------------

    public function finalizarReserva (Request $req){

      $reserva = Reserva::findOrFail($req->reserva_id);
      
      try {
        
        $ddrr = Detalle_Reserva::where('reserva_id', $reserva->id)->where('activo', 1)->where('confirmada', 1)->get();

        foreach ($ddrr as $dr) {
            
          ///controla que el juego se pueda finalizar despues de haber transcurrido    
          $fecha = Carbon::now();
          $fecha_actual = $fecha->format('d/m/Y');
          $hora_actual  = $fecha->format('H');

          if ($hora_actual == 00) $hora_actual = 24;

          $fecha_reservada  = $dr->fecha_reservada->format('d/m/Y');
          $mensaje = 'LA RESERVA NO SE PUEDE FINALIZAR HASTA QUE FINALICEN TODOS SUS JUEGOS.';
          
          if ($fecha_reservada >= $fecha_actual){
            
            if ($fecha_reservada == $fecha_actual){
              if ($hora_actual < $dr->hr_reservada){
                return redirect()->back()->with('warning', $mensaje);
              }
            }else{
              return redirect()->back()->with('warning', $mensaje);
            }  
          }

          $dr->activo = 0;

          $edr = new Estado_Detalle_Reserva();
          $edr->detalle_reserva_id = $dr->id;
          $edr->estado_id          = 2; //2 = estado finalizada
          $edr->comentario         = 'EMPRESA';

          $dr->save();
          $edr->save();
        }

        $ddrr = Detalle_Reserva::where('reserva_id', $reserva->id)->where('activo', 1)->where('confirmada', 0)->get();

        if ($ddrr->isEmpty()){
          $reserva->finalizada = 1;
          $reserva->activo     = 0;
          $reserva->save();
          $msj = 'LA RESERVA Nro. ' . $reserva->id . 'SE HA FINALIZADO CON EXITO';
          $tipo = 'success';
        }else{
          $msj = 'RESERVA NO FINALIZADA, DISPONE DE CANCHA/S NO CONFIRMADAS.';
          $tipo = 'warning';
        }


         return redirect()->back()->with($tipo, $msj);
      }catch (Exception $e) {
          //dd($e);
          return response()->view('errors.404', [], 404);
      }

    }

}