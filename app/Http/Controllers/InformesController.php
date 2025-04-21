<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

use Auth;
use PDF;
use Carbon\Carbon;
use App\Dia;
use App\Empresa;
use App\Turno;

use App\Reserva;
use App\Detalle_Reserva;
use App\Cancha_Servicio;

class InformesController extends Controller
{
    
    public function crcf(){
        $canchas = new Collection();
        return view('informes.reservas.reservas_canchas', compact('canchas'));
    }
    
    public function get_crcf(Request $req){

        if ($req->hasta < $req->desde){
            
            $notificacion = array(
                'message' => 'RANGO DE FECHAS NO ACEPTADO!', 
                'alert-type' => 'danger',
            );
            return redirect()->back()->with($notificacion);
        }
        
        $cans  = DB::table('canchas')->where('empresa_id', $req->empresa_id)->get();
        $desde = Carbon::parse($req->desde);
        $hasta = Carbon::parse($req->hasta);
        
        $canchas = new Collection();
        foreach ($cans as $can) {
            
            $ddrr = DB::table('detalles_reserva')
                ->where('fecha_reservada', '>=' , $desde)
                ->where('fecha_reservada', '<=' , $hasta)
                ->where('confirmada', 1)
                ->where('ca', $can->id)
                ->get();
            
            $cancha = new Collection();
            $cancha->put('name', $can->name);
            $cancha->put('cant', $ddrr->count());

            
            $canchas->push($cancha);
        }     
        if ($req->flag)
            return view('informes.reservas.reservas_canchas',  
                    compact('canchas', 'desde', 'hasta')); 

        $emp   = Empresa::findOrFail($req->empresa_id);
        $fecha = Carbon::now();
        $pdf = PDF::loadView('informes.reservas.reservas_canchas_pdf', [
            'canchas' => $canchas,
            'emp'     => $emp, 
            'desde'   => $desde,
            'hasta'   => $hasta,
            'fecha'   => $fecha
        ]);
                
        $pdf->setPaper('a4'); // , 'landscape' pone la hoja en horizontal

        return $pdf->stream();

    }

    //---------------------------------------------------------------------------------------------

    public function cruf(){
        
        return view('informes.reservas.reservas_user');
    }

    public function get_cruf(Request $req){

        if ($req->hasta < $req->desde){
            
            $notificacion = array(
                'message' => 'RANGO DE FECHAS NO ACEPTADO!', 
                'alert-type' => 'danger',
            );
            return redirect()->back()->with($notificacion);
        }

        $emp   = Empresa::findOrFail($req->empresa_id); 
        $desde = Carbon::parse($req->desde);
        $hasta = Carbon::parse($req->hasta);
        $fecha = Carbon::now();
        $uuee = DB::table('user_empresa')
                ->where('empresa_id', $req->empresa_id)
                ->get();
            
        $reservas = new Collection();
        foreach ($uuee as $ue) {
            $reserva = new Collection();
            $cant = DB::table('reservas')
                        ->where('created_at', '>=', $desde)
                        ->where('created_at', '<=', $hasta)
                        ->where('user_empresa_id', $ue->id)
                        ->where('confirmada', 1)
                        ->get()->count();
            
            $user = DB::table('users')
                    ->where('id', $ue->user_id)
                    ->get();

            $reserva->put('user', $user);
            $reserva->put('cant', $cant);

            $reservas->push($reserva);

        }
        
        //return view('informes.reservas.reservas_user_pdf', compact('reservas', 'emp', 'desde', 'hasta', 'fecha'));

        $pdf = PDF::loadView('informes.reservas.reservas_user_pdf', [
            'reservas' => $reservas->sortByDesc('cant'),
            'emp' => $emp, 
            'desde' => $desde,
            'hasta' => $hasta,
            'fecha' => $fecha
        ]);
        
        $pdf->setPaper('a4'); // , 'landscape' pone la hoja en horizontal

        return $pdf->stream();
    }

    //---------------------------------------------------------------------------------------------

    public function crdf(){
        
        $dias = array();
        return view('informes.reservas.reservas_dias', compact('dias'));
    }

    public function get_crdf(Request $req){

        if ($req->hasta < $req->desde){
            
            $notificacion = array(
                'message' => 'RANGO DE FECHAS NO ACEPTADO!', 
                'alert-type' => 'danger',
            );
            return redirect()->back()->with($notificacion);
        }

        $desde = Carbon::parse($req->desde);
        $hasta = Carbon::parse($req->hasta);
        

        $cans  = DB::table('canchas')->where('empresa_id', $req->empresa_id)->get();
        
        $reservas = new Collection();
        $canchas = new Collection();
        $td=0; $tl=0; $tm=0; $tmi=0; $tj=0; $tv=0; $ts=0;
        foreach ($cans as $can) {
            $cancha = new Collection();
            $d=0; $l=0; $m=0; $mi=0; $j=0; $v=0; $s=0;
            $ddrr = DB::table('detalles_reserva')
                ->where('fecha_reservada', '>=' , $desde)
                ->where('fecha_reservada', '<=' , $hasta)
                ->where('ca', $can->id)
                ->where('confirmada', 1)
                ->get();

            foreach ($ddrr as $dr) {
                
                $fechats = strtotime($dr->fecha_reservada);
                switch (date('w', $fechats)){
                    case 0: $d  = $d + 1; $td = $td + 1; break; //"DOMINGO";  
                    case 1: $l  = $l + 1; $tl = $tl + 1; break; //"LUNES";   
                    case 2: $m  = $m + 1; $tm = $tm + 1; break;    
                    case 3: $mi = $mi+ 1; $tmi= $tmi+ 1; break; 
                    case 4: $j  = $j + 1; $tj = $tj + 1; break;   
                    case 5: $v  = $v + 1; $tv = $tv + 1; break;
                    case 6: $s  = $s + 1; $ts = $ts + 1; break; //"SABADO";      
                }
            
            }
            $cancha->put('name', $can->name);
            $cancha->put('dia', [$d, $l, $m, $mi, $j, $v, $s]);
            $canchas->push($cancha);

        }
        //dd($canchas);
        $dias = [$td, $tl, $tm, $tmi, $tj, $tv, $ts];
        $emp   = Empresa::findOrFail($req->empresa_id);
        $fecha = Carbon::now();

        if ($req->flag)
            return view('informes.reservas.reservas_dias', 
                        compact('dias', 'desde', 'hasta'));

        $pdf   = PDF::loadView('informes.reservas.reservas_dias_pdf', [
            'canchas'  => $canchas,
            'dias'  => $dias,
            'emp'   => $emp, 
            'desde' => $desde,
            'hasta' => $hasta,
            'fecha' => $fecha
        ]);
        
        $pdf->setPaper('a4'); // , 'landscape' pone la hoja en horizontal

        return $pdf->stream();
    }

    //---------------------------------------------------------------------------------------------

    public function crhf()
    {
        $me = 1;
        $horas = array();
        return view('informes.reservas.reservas_horas', compact('horas', 'me'));
    }

    public function crhcf()
    {
        $me = 0;
        $horas = array();
        return view('informes.reservas.reservas_horas', compact('horas', 'me'));
    }

    public function get_crhf(Request $req)
    {

        if ($req->hasta < $req->desde){
            
            $notificacion = array(
                'message' => 'RANGO DE FECHAS NO ACEPTADO!', 
                'alert-type' => 'danger',
            );
            return redirect()->back()->with($notificacion);
        }

        $cans   = DB::table('canchas')->where('empresa_id', $req->empresa_id)->get();
        $desde  = Carbon::parse($req->desde);
        $hasta  = Carbon::parse($req->hasta);
        

        $turnos = DB::table('turnos')->where('empresa_id', $req->empresa_id)->get();
        
        $ini = DB::table('turnos')->where('empresa_id', Auth::user()->user_empresa->empresa_id )->pluck('hr_ini');
        $fin = DB::table('turnos')->where('empresa_id', Auth::user()->user_empresa->empresa_id )->pluck('hr_fin');
        
        $horas = new Collection;
        foreach ($turnos as $turno) {
          $i = (int)$turno->hr_ini;
          $j = (int)$turno->hr_fin;
          while ( $i <= $j ) {
            if (!($fin->contains($i))){
              if (!$horas->contains($i)){ 
                    $horas->put($i,0);
              }
            }else{
              if ($ini->contains($i)){
                if (!$horas->contains($i)){ 
                    $horas->put($i,0);
                }
              }
            }
            $i++;
          }
        }
        
        $canchas = new Collection();
        foreach ($cans as $can) {
            $cancha = new Collection();
            $hs = new Collection();
            
            foreach ($horas as $i => $hora) {
                $hs->put($i, 0);
            }

            $ddrr = DB::table('detalles_reserva')
                ->where('fecha_reservada', '>=' , $desde)
                ->where('fecha_reservada', '<=' , $hasta)
                ->where('confirmada', 1)
                ->where('ca', $can->id)
                ->get();
            
            foreach ($ddrr as $dr) {
                $horas[$dr->hr_reservada] +=1;
                $hs[$dr->hr_reservada] +=1;
            }
            $cancha->put('name', $can->name);
            $cancha->put('horas', $hs);
            $canchas->push($cancha);                      
        }
        
        $me = $req->me;
        if ($req->flag){
            if($me){

                return view('informes.reservas.reservas_horas', compact('horas', 'desde', 'hasta', 'me'));
            }else{
                $emp   = Empresa::findOrFail($req->empresa_id);
                $fecha = Carbon::now();
                
                /*return view('informes.reservas.reservas_horas_canchas_pdf', 
                            compact('horas', 'emp', 'fecha', 'desde', 'hasta', 'canchas'));*/

                $pdf   = PDF::loadView('informes.reservas.reservas_horas_canchas_pdf', [
                    'horas'   => $horas,
                    'canchas' => $canchas,
                    'emp'     => $emp, 
                    'desde'   => $desde,
                    'hasta'   => $hasta,
                    'fecha'   => $fecha
                    ]);
                    
                $pdf->setPaper('a4', 'landscape'); // , 'landscape' pone la hoja en horizontal

                return $pdf->stream();
            }
        }
         
             
    }
//------------------------------------------------------------------------------------------------
    public function cso()
    {   
        $servicios = array();
        return view('informes.servicios.servicios_ocupados', compact('servicios'));
    }
    
    public function get_cso(Request $req)
    {
        if ($req->hasta < $req->desde){
            
            $notificacion = array(
                'message' => 'RANGO DE FECHAS NO ACEPTADO!', 
                'alert-type' => 'danger',
            );
            return redirect()->back()->with($notificacion);
        }

        $servicioss   = DB::table('servicios')->where('empresa_id', $req->empresa_id)->get();
        $desde  = Carbon::parse($req->desde);
        $hasta  = Carbon::parse($req->hasta);

        $servicios = new Collection();
        $ccss = new Collection();
        foreach ($servicioss as $servicio) {
            $cccsss = Cancha_Servicio::with('servicio')
                      ->where('servicio_id', $servicio->id)
                      ->where('requerido', 0)
                      ->get();

            foreach ($cccsss as $cs) {
                $ccss->put($cs->id, $cs->servicio->name);
                $servicios->put($cs->servicio->name, 0);
            }
        }


        
        foreach ($ccss as $key => $value) {
            
            $ssrr = DB::table('servicios_requeridos')
                ->where('created_at', '>=' , $desde)
                ->where('created_at', '<=' , $hasta)
                ->where('cancha_servicio_id', $key)
                ->get();

            $servicios[$value] = $servicios[$value] + $ssrr->count();
            
        }

        return view('informes.servicios.servicios_ocupados', compact('servicios', 'desde', 'hasta'));
    }
}
