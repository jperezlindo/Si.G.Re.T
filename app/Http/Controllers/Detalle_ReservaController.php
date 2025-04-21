<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\Http\Requests\Detalle_DeservaRequest;
use Auth;

use Carbon\Carbon;
use App\Cancha;
use App\Reserva;
use App\Cancha_Servicio;
use App\Detalle_Reserva;
use App\Estado_Detalle_Reserva;
use App\User;
use App\Servicio_Requerido;
use App\Dia;
use App\Servicio;
use App\Turno;
use App\Turno_Dia;
use App\Jugador;


class Detalle_ReservaController extends Controller
{
    public function __construct(){
		  Carbon::setLocale('es');
  	}

//-----------------------------------------------------------------------------
    public function index(Request $req){
      
      try {
        
        $reserva = Reserva::findOrFail($req->reserva_id);
        
        return view('detalle_reserva.index', compact('reserva'));

      } catch (\Exception $e) {
        
        return response()->view('errors.404', [], 404);
      }      
    }
//-----------------------------------------------------------------------------
    public function edit(Request $req){

      try {

        $dr = Detalle_Reserva::findOrFail($req->detalle_reserva_id);    
        
        /*
        //controla que no se editen dentro de la hora establecida por el admin
        $fecha = Carbon::now();
        $fecha_actual = $fecha->format('d/m/Y');
        $hora_actual  = $fecha->format('H');
        */
        //ss = variable que restringe si se puede o no editar la reserva
        $ss = true;
        /*
        $fecha_reservada  = $dr->fecha_reservada->format('d/m/Y');
        $hr = 5;

        if ($fecha_reservada == $fecha_actual){
          $hora_edicion = (int)$dr->hr_reservada - $hr;
          if ($hora_actual > $hora_edicion){
            $ss = true;
          }
        }
        */

        return view('detalle_reserva.edit', compact('dr' , 'ss'));  

      } catch (\Exception $e) {
        return response()->view('errors.404', [], 404);
      }
    }

//-----------------------------------------------------------------------------
  	public function asociarServicios(Request $req, $id_dr){
    	
      try {
        $dr = Detalle_Reserva::findOrFail($id_dr);
        $ssrr = Servicio_Requerido::with('cancha_servicio')->where('detalle_reserva_id', $id_dr)->get();

        foreach ($ssrr as $sr) {
          $id_cancha = $sr->cancha_servicio->cancha_id;
        }

        
        $cancha= Cancha::findOrFail($id_cancha);
        $canser    = Cancha_Servicio::with('servicio')->where('cancha_id', $id_cancha)->where('activo', 1)->get();
        $asociados   = Servicio_Requerido::with('cancha_servicio', 'detalle_reserva')->where('detalle_reserva_id', $id_dr)->get();
                
        //devuelve todos los servicios disponibles para la chancha
        $disponibles = new Collection;
        foreach ($canser as $cs){
          if (!($asociados->contains('cancha_servicio_id', $cs->id))) $disponibles->push($cs);
        }
        ///-------------     
        
        return view('detalle_reserva.asociarServicios', compact('dr', 'disponibles', 'cancha', 'asociados'));
      
      } catch (\Exception $e) {
        
          return response()->view('errors.404', [], 404);
      }
  	}

//-----------------------------------------------------------------------------
 	
  	public function store(Request $req){
      
      //fhcu = variable que recibira si la fecha hora y cancha que se quiere reservar ya esta ocupada por el usuario.
      $fhcu = Detalle_Reserva::ExisteReservaUsuario($req->fecha_reservada, $req->hr_reservada, $req->cancha_id);

      if ($fhcu->isNotEmpty())
         return redirect()->back()
                  ->with('warning', 'YA DISPONE DE LA RESERVA, CONFIRMELA EN: "Reservas -> Mis Reservas -> No Confirmadas"');  
      

      $fhc = Detalle_Reserva::ExisteReserva($req->fecha_reservada, $req->hr_reservada, $req->cancha_id);
 
        if ($fhc->isNotEmpty())
           return redirect()->back()
                    ->with('warning', 'LO SENTIMOS, LA CANCHA YA NO SE ENCUENTRA DISPONIBLE PARA LA FECHA Y HORARIO ELEGIDO.'); 

      try {

        //amacena el detalle de reserva
        $dr = new Detalle_Reserva();
        
        $dr->fecha_reservada  = $req->fecha_reservada;
        $dr->hr_reservada     = $req->hr_reservada;
        $dr->cant_hs          = $req->cant_hs;
        $dr->monto            = 0;
        $dr->ca               = $req->cancha_id;
        $dr->reserva_id       = $req->reserva_id;
        $dr->au               = Auth::user()->user_empresa->id;
        $dr->save();
        

        //almacena los servicios obligatorios para el detalle
        $canser = Cancha_Servicio::where('cancha_id', $req->cancha_id)
                      ->where('requerido', true)->get(); 
        
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
        
        $reserva = Reserva::findOrFail($req->reserva_id);
        //actualiza los montos tanto en la reserva como en el detalle
        $dr->monto      = $total_servicios;
        $dr->save();
        $reserva->total += $total_servicios;
        $reserva->save();

        return redirect()->route('detalle_reserva.asociarServicios', $dr->id);

      } catch (\Exception $e) {
        dd($e);
        return response()->view('errors.404', [], 404);
      }
  	}
//-----------------------------------------------------------------------------
	public function update(Request $req){

    $fhc = Detalle_Reserva::ExisteReserva($req->fecha_reservada, $req->hr_reservada, $req->cancha_id);

      if ($fhc->isNotEmpty())
         return redirect()->back()
                  ->with('warning', 'LO SENTIMOS, LA CANCHA YA NO SE ENCUENTRA DISPONIBLE PARA LA FECHA Y HORARIO ELEGIDO.'); 
    try {

      $dr  = Detalle_Reserva::findOrFail($req->detalle_reserva_id);
      $edr = Estado_Detalle_Reserva::where('detalle_reserva_id', $dr->id)->where('estado_id', 1)->first();
      $edr->delete(); 

      //obtiene el valor del detalle anterior y elimina los servicios contratados funcion en el modelo.
      $total_old = $dr->getMontoDetalle($req->detalle_reserva_id);

      //actuliza los servicios obligatorios para el detalle y calcula el nuevo monto 
      $canser = Cancha_Servicio::where('cancha_id', $req->cancha_id)
                                ->where('requerido', true)
                                ->where('activo', true)->get(); 
      
      $total_new = 0;
      foreach ($canser as $cs) {
        $sr = new Servicio_Requerido();
        $sr->precio             = $cs->precio;
        $sr->cancha_servicio_id = $cs->id;
        $sr->detalle_reserva_id = $dr->id;
        $sr->save();
        if ($cs->xhr){
          $total_new += ($cs->precio * $req->cant_hs);
        }else{
          $total_new += $cs->precio;
        }
      }

      $dr->fecha_reservada  = $req->fecha_reservada;
      $dr->hr_reservada     = $req->hr_reservada;
      $dr->cant_hs          = $req->cant_hs;
      $dr->monto            = $total_new;
      $dr->confirmada       = 0;
      $dr->ca               = $req->cancha_id;
      $dr->reserva_id       = $dr->reserva_id;
      $dr->au               = Auth::user()->user_empresa->id;
      $dr->save();

      $reserva = Reserva::findOrFail($dr->reserva_id);
      $old = $reserva->total;
      $reserva->total = 0;
      $reserva->total = $old - $total_old;
      $reserva->total += $total_new;

      //controla si es el unico detalle de la reserva lo desconfirma
      $ddrr = Detalle_Reserva::where('reserva_id', $reserva->id)->where('activo', 1)->where('confirmada', 1)->get();
      if ($ddrr->isEmpty()) $reserva->confirmada = 0;
      ////
      
      $reserva->save();

      $notificacion = array(
            'message' => 'SU RESERVA SE MODIFICO CON EXITO!.', 
            'alert-type' => 'warning',
      );
      
      return redirect()->route('jugadores.create', $dr->id);

    } catch (\Exception $e) {
      //dd($e);
      return response()->view('errors.404', [], 404);
    }		
	}

//--------------------------------------------------------------------------------------

    public function confirmarDetalle (Request $req){

      $dr = Detalle_Reserva::findOrFail($req->detalle_reserva_id);
    
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
        
        return redirect()->route('reserva.misReservas')
                  ->with('warning', 'LO SENTIMOS, LA CANCHA YA NO SE ENCUENTRA DISPONIBLE PARA LA FECHA Y HORARIO ELEGIDO.'); 
      }

      $dr->confirmada = true;
      $dr->save();
      
      $estado = new Estado_Detalle_Reserva();
      $estado->estado_id = 1;
      $estado->detalle_reserva_id = $dr->id;
      $estado->save();
  
      return redirect()->route('reserva.show', $dr->reserva_id)->with('success', 'LA CANCHA SE CONFIRMO CON EXITO!.');

    }
//--------------------------------------------------------------------------------------

 public function finalizarDetalle (Request $req){
 
    try {
      
      $dr = Detalle_Reserva::findOrFail($req->detalle_reserva_id);
      
      ///controla que el juego se pueda finalizar despues de haber transcurrido    
      $fecha = Carbon::now();
      $fecha_actual = $fecha->toDateString();
      $hora_actual  = $fecha->format('H');

      if ($hora_actual == 00) $hora_actual = 24;

      $fecha_reservada  = $dr->fecha_reservada->toDateString();
      
      if ($fecha_reservada >= $fecha_actual){
        
        if ($fecha_reservada == $fecha_actual){
          if ($hora_actual <= $dr->hr_reservada){
            return redirect()->back()->with('danger', 'EL JUEGO NO SE PUEDE FINALIZAR HASTA QUE HAYA TERMINADO.' );
          }  
        }else{
          return redirect()->back()->with('danger', 'EL JUEGO NO SE PUEDE FINALIZAR HASTA QUE HAYA TERMINADO.' );
        }
      }  
      
      $dr->activo = 0;
      $dr->au     = Auth::user()->user_empresa->id;
      
      $edr = new Estado_Detalle_Reserva();
      $edr->detalle_reserva_id = $dr->id;
      $edr->estado_id          = 2; //2 = estado finalizada
      $edr->comentario         = 'EMPRESA';

      $dr->save();
      $edr->save();
     
      $ddrr = Detalle_Reserva::where('reserva_id', $dr->reserva_id)->where('activo', 1)->where('confirmada', 1)->get();

      if ($ddrr->isEmpty()){
        $reserva = Reserva::findOrFail($dr->reserva_id);
        $reserva->finalizada = 1;
        $reserva->activo     = 0;
        $reserva->save();
        
      }
     
      $notificacion = array(
            'message' => 'LA RESERVA Nro. ' . $dr->id . ', SE HA FINALIZADO  CON EXITO.', 
            'alert-type' => 'success',
      );
     
      return redirect()->back()->with($notificacion);

    }catch (Exception $e) {
      return response()->view('errors.404', [], 404);
    }

    }
//-----------------------------------------------------------------------------

	public function destroy(Request $req, $id_dr){

    try {

      $dr = Detalle_Reserva::findOrFail($id_dr);    
      
      $fecha = Carbon::now();
      $fecha_actual = $fecha->format('d/m/Y');
      $hora_actual  = $fecha->format('H');

      if ($hora_actual == 00) $hora_actual = 24;

      $fecha_reservada  = $dr->fecha_reservada->format('d/m/Y');
      
      $hr = 5;
      if ($fecha_reservada == $fecha_actual){
        $hora_cancelacion = (int)$dr->hr_reservada - $hr;
        if ($hora_actual >= $hora_cancelacion){
          return redirect()->back()
                  ->with('danger', 'LAS CANCHAS SOLO SE PUEDEN ANULAR CON 5 HORAS DE ANTELACION, GRACIAS!.');
        }
      }

      $dr->activo = false;
      $dr->au     = Auth::user()->user_empresa->id;
      $dr->save();
      
      $edr = new Estado_Detalle_Reserva();
      $edr->detalle_reserva_id = $dr->id;
      $edr->estado_id = 3; //3 estado cancalada
      $edr->comentario = $req->comentario;
      $edr->save();

      $jugadores = Jugador::where('detalle_reserva_id', $dr->id)->get();
      foreach ($jugadores as $j) {
        $j->delete();
      }
      
      $ddrr = Detalle_Reserva::where('reserva_id', $dr->reserva_id)->where('activo', true)->get();
      
      if($ddrr->isEmpty()){
        $reserva = Reserva::findOrFail($dr->reserva_id);
        $reserva->activo = false;
        $reserva->save();
        
        if ($req->flag)
          return redirect()->back()->with('success', 'LA FECHA Y HORA SE CANCELARON CON EXITO!.');;

        return redirect()->route('reserva.misReservas')->with('success', 'SU RECERVA SE CANCELO CON EXITO!.');
      }else{

        $total_old = $dr->getMontoDetalle($dr->id);
        $reserva = Reserva::findOrFail($dr->reserva_id);
        $old = $reserva->total;
        $reserva->total = 0;
        $reserva->total = $old - $total_old;
        $reserva->save();

        if ($req->flag)
          return redirect()->back()->with('success', 'LA FECHA Y HORA SE CANCELARON CON EXITO!.');

        return redirect()->route('reserva.misReservas')->with('success', 'LA FECHA Y HORA SE CANCELARON CON EXITO!.');
      }

    } catch (\Exception $e) {
      //dd($e);
      return response()->view('errors.404', [], 404);
    }
	}

	//--------------------------------------------------------------------------------------

    public function getHoras (Request $req){ 

      try {
        $_fecha = $req->fecha_reservada;
        $id_cancha = $req->cancha_id;
        $dia      = new Dia();
        $horarios = Turno_Dia::with('turno', 'dia')->get();
        $turnos   = new Collection;
        $fecha = Carbon::parse($_fecha);
        
        //alacena todos los turnos ofrecido por la empresa para sus canchas
        foreach ($horarios as $hr) {
          if(strcmp($dia->get_nombre_dia($fecha->toDateString()), $hr->dia->name) === 0){
            if ($hr->turno->empresa_id == Auth::user()->user_empresa->empresa_id) 
             { $turnos->push($hr); }
          }
        }

        //crea una coleccion con los horarios ofrecidos para la fecha a consultar
        $ini = DB::table('turnos')->where('empresa_id', Auth::user()->user_empresa->empresa_id )->pluck('hr_ini');
        $fin = DB::table('turnos')->where('empresa_id', Auth::user()->user_empresa->empresa_id )->pluck('hr_fin');

        if ($_fecha == Carbon::now()->format('Y-m-d')){
          $hora_actual  = Carbon::now()->format('H');
        }else{
          $hora_actual = 0;
        }
        
        $horas = new Collection;
        foreach ($turnos as $turno) {
          $i = (int)$turno->turno->hr_ini;
          $j = (int)$turno->turno->hr_fin;
          while ( $i <= $j ) {
            if (!($fin->contains($i))){
              if (!$horas->contains($i)){ 
                if ($i > $hora_actual)
                  $horas->push($i);
              }
            }else{
              if ($ini->contains($i)){
                if (!$horas->contains($i)){ 
                  if ($i > $hora_actual)
                    $horas->push($i);
                }
              }
            }
            $i++;
          }
        }
        
        //obtiene el servicio de alquiler contratados para la cancha
        $ddrr = Detalle_Reserva::where('fecha_reservada', $fecha->toDateString())
          ->where('activo',1)->where('confirmada', 1)->get();
         
        $dsrs = new Collection();
        $servicio = Servicio::where('name', 'ALQUILER')->first();
        $ccss = Cancha_Servicio::where('servicio_id', $servicio->id)->where('activo', 1)->get();
        $requeridos = new Collection();
        foreach ($ccss as $cs) {
          foreach ($ddrr as $dr) {
            $ssrr = Servicio_Requerido::with('cancha_servicio')->get()
              ->where('detalle_reserva_id', $dr->id)
              ->where('cancha_servicio_id', $cs->id);
            foreach ($ssrr as $sr) {
              if ($sr->cancha_servicio->cancha_id == $id_cancha){
                $requeridos->push($sr);
                if (!$dsrs->contains('id', $dr->id))
                  {$dsrs->push($dr);}
              }
            }  
          }
        }
      
        //crea una coleccion con los horarios disponibles para la fecha y cancha a reservar
        $uc=0;
        $horas_disponibles = new Collection();
        foreach ($horas as $hr) {
          foreach ($requeridos as $re) {
            if ($hr == (int)$re->detalle_reserva->hr_reservada){
                $h = 0;
                $h = ((int)$re->detalle_reserva->hr_reservada + (int)$re->detalle_reserva->cant_hs);
                if (!($dsrs->contains('hr_reservada', $h ))){
                  if (!($horas_disponibles->contains($h))){
                    if (!($fin->contains($h))){
                      if ($h > $hora_actual)
                        $horas_disponibles->push((int)$h); 
                    }else{
                      $uc = $h;
                    }
                  }
                }else{
                  $uc = $h;
                }    
            }else{
              if (!($dsrs->contains('hr_reservada', $hr ))){
                if (!($hr < (int)$horas_disponibles->last())){
                  if (!($hr < $uc)){
                    if (!($horas_disponibles->contains($hr))){
                      if ($hr > $hora_actual)
                        $horas_disponibles->push((int)$hr);
                    }
                  }
                }
              }
            }//else
          }//foreach
        }//foreach

        if ($horas_disponibles->isEmpty()){
          return $horas;
        }else{
          return $horas_disponibles;
        }
 
      } catch (\Exception $e) {
        return response()->view('errors.404', [], 404);
      }
    }
//--------------------------------------------------------------------------------------
    public function getHsRes(Request $req){

      try {
        $_hr = $req->hr_reservada;
        
        $_fecha = $req->fecha_reservada;
        $id_cancha = $req->cancha_id;
        //alacena todos los turnos ofrecido por la empresa para sus canchas
        $dia      = new Dia();
        $horarios = Turno_Dia::with('turno', 'dia')->get();
        $turnos   = new Collection;
        $fecha = Carbon::parse($_fecha);
        foreach ($horarios as $hr) {
          if(strcmp($dia->get_nombre_dia($fecha->toDateString()), $hr->dia->name) === 0){
            if ($hr->turno->empresa_id == Auth::user()->user_empresa->empresa_id) 
              $turnos->push($hr); 
          }
        }

        //Craea una coleccion de las horas ofrecidas
        $horas = new Collection;
        foreach ($turnos as $turno) {
          $i = (int)$turno->turno->hr_ini;
          $j = (int)$turno->turno->hr_fin;
          while ( $i <= $j ) {
            if (!$horas->contains($i)) 
              $horas->push($i);
            $i++;
          }
        }

        
        //obtiene el corte en corte_turno para cambio de turno no continuo
        $corte_turno = (int)$horas->first();
        foreach ($horas as $hr) {
          if ($corte_turno == $hr){
            $corte_turno += 1;
          }
        }
        $corte_turno -= 1;

        /*Crea la coleccion de la cantidad de horas q puede 
          reservar hasta la proxima reserva o corte de turno.*/
        $servicio = Cancha_Servicio::where('cancha_id', $id_cancha)->where('servicio_id', 1)->first();
        $adquiridos = Servicio_Requerido::with('detalle_reserva')->where('cancha_servicio_id', $servicio->id)->get();
        


        $dsrs = Detalle_Reserva::where('fecha_reservada', $fecha->toDateString())->where('activo', 1)->where('confirmada', 1)->get();
         
        $detalles = new Collection();
        foreach ($dsrs as $d) {
          foreach ($adquiridos as $a) {
            if ($d->id == $a->detalle_reserva_id)
              $detalles->push($d);
          }
        }

        $ddrr = $detalles->sortBy('hr_reservada');
        $hs_res = new Collection();
        foreach ($ddrr as $dr) {
          if ($_hr < (int)$dr->hr_reservada){
            $dif = (int)$dr->hr_reservada - $_hr;  
            for ($i=1; $i <= $dif ; $i++) { 
              if (($_hr + $i) <= $corte_turno){
                if (!$hs_res->contains($i))
                  $hs_res->push($i);
              }else{
                if ($_hr > $corte_turno){
                  if (!$hs_res->contains($i))
                    $hs_res->push($i);
                }
              }
            }
            return $hs_res;
          }
        }
        

        /*crea la coleccion de la cantidad de horas a reservar, 
          cuando no hay una reserva posterior a la hora seleccionada.*/ 
        if($hs_res->isEmpty()){
          $fin = (int)$horas->last();
          if ($_hr < $corte_turno){
            $fin = 0;
            $fin = $corte_turno - $_hr + 1;
          }else{
            $fin = $fin - $_hr + 1;
          }
          $i = 1;
          while ( $i < $fin) {
            if (!($hs_res->contains($i)))
              $hs_res->push($i);
            $i++;
          }
        }

        return $hs_res;

      } catch (\Exception $e) {
        return response()->view('errors.404', [], 404);
      }
    }
}