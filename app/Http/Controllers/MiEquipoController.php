<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

use Auth;
use App\User;
use App\Equipo;
use App\Ranking;
use App\Inscripcion;
use App\User_Empresa_Equipo;

class MiEquipoController extends Controller
{

    public function index()
    {
        $uee = User_Empresa_Equipo::where('user_empresa_id' ,Auth::user()->user_empresa->id)
                                ->where('activo', 1)->first();
       
       return view ('mi_equipo.show', compact('uee'));
    }


    public function store(Request $req)
    {
        try {
            
            $inscripcion = Inscripcion::where('equipo_id', $req->equipo_id)
                        ->where('activo', 1)->first();
            
            if ($inscripcion){
                $notificacion = array(
                    'message' => 'EL EQUIPO SELECIONADO SE ENCUENTRA INSCRIPTO A UN TORNEO!.', 
                    'alert-type' => 'warning'
                );
                return redirect()->back()->with($notificacion);
            }
            $uueeee = User_Empresa_Equipo::where('equipo_id', $req->equipo_id)->get();
            if ($uueeee->count() == 2){
                
                $no_pasa = 1;
                foreach ($uueeee as $uee) {
                    if ($uee->user_empresa_id == Auth::user()->user_empresa->id)
                        $no_pasa = 0;
                }

                if ($no_pasa){
                    $notificacion = array(
                        'message' => 'EL EQUIPO NO PUEDE TENER MAS DE DOS JUGADORES', 
                        'alert-type' => 'warning'
                    );
                    return redirect()->back()->with($notificacion);
                }    
            }

            
            $actual = User_Empresa_Equipo::with('equipo')->where('user_empresa_id' ,Auth::user()->user_empresa->id)
                                ->where('activo', 1)->first();

            if ($actual){
                if ($actual->equipo_id == $req->equipo_id){
                    
                    if ($actual->activo){

                        $notificacion = array(
                            'message' => 'DENEGADO: YA ERES PARTE DEL EQUIPO', 
                            'alert-type' => 'warning'
                        );
                        return redirect()->back()->with($notificacion);
                    }else{
                        
                        $actual->activo = 1;
                        $actual->save();
                        $notificacion = array(
                            'message' => 'YA ESTAS NUEVAMENTE EN EL EQUIPO', 
                            'alert-type' => 'success'
                        );

                        return redirect()->route('miequipo.show', $actual->user_empresa_id)->with($notificacion);
                    }

                }else{

                    $notificacion = array(
                        'message' => 'DENEGADO: ERES MIEMBRO DEL EQUIPO: ' . $actual->equipo->name, 
                        'alert-type' => 'warning'
                    );
                    return redirect()->back()->with($notificacion);

                }
            }else{

                // uee = representa un objeto de User Empresa Equipo.
                $uee = new User_Empresa_Equipo();

                $uee->user_empresa_id = Auth::user()->user_empresa->id;
                $uee->equipo_id       = $req->equipo_id;
                $uee->save();
                return redirect()->route('miequipo.show', $uee->user_empresa_id)
                        ->with('success', 'BIENVENIDO AL EQUIPO, YA ERES PARTE DEL MISMO.');
            }
            
        } catch (Exception $e) {
            return response()->view('errors.404', [], 404);
        }
    }

    public function quitar_jugador(Request $req)
    {

        try {
            $uee = User_Empresa_Equipo::findOrFail($req->user_empresa_equipo_id);
            
            $inscripcion = Inscripcion::where('equipo_id', $uee->equipo_id)
                        ->where('activo', 1)->first();
            
            if ($inscripcion)
                return redirect()->back()
                    ->with('warning', 'NO SE PUEDE QUITAR AL JUGADOR, EL EQUIPO SE ENCUENTRA INSCRIPTO A UN TORNEO!.');

            $uee->activo = 0;
            $uee->save();

            $notificacion = array(
                'message' => 'El JUGADOR SE QUITO CON EXITO DEL EQUITO!', 
                'alert-type' => 'success'
            );

            return redirect()->route('miequipo.show', $uee->user_empresa_id)->with($notificacion);

        } catch (Exception $e) {
            return response()->view('errors.404', [], 404);
        }
    }

    public function show($id)
    {   
        try {
            
            // uee = representa un objeto de User Empresa Equipo.
            $uee = User_Empresa_Equipo::with('equipo')->where('user_empresa_id', $id)->where('activo', 1)->first();

            
            if ($uee){
                // uueeee representa una coleccion de objetos de User Empresa Equipo.
                $uueeee = User_Empresa_Equipo::with('user_empresa')->where('equipo_id', $uee->equipo->id)
                    ->where('activo', 1)->get();
                $ints = new Collection();
                foreach ($uueeee as $ueeq) {
                    $int  = new Collection();
                    $rank = Ranking::where('user_empresa_id', $ueeq->user_empresa_id)->first();
                    $user = User::findOrFail($ueeq->user_empresa->id);
                    
                    $int->put('id',$ueeq->id);
                    $int->put('us',$user->user);
                    $int->put('ap',$user->apellido);
                    $int->put('no',$user->name);
                    if ($rank){
                        $int->put('pu',$rank->puntos);
                        $int->put('tj',$rank->torneos_jugados);
                    }else{
                        $int->put('pu',0);
                        $int->put('tj',0);   
                    }

                    $ints->push($int);
                }
            }
                       
            return view ('mi_equipo.show', compact('uee', 'ints'));        
        
        } catch (Exception $e) {
            return response()->view('errors.404', [], 404);
        }
    }
}