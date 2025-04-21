<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Auth;
use App\Categoria_Torneo;
use App\Partido;
use App\Ranking;
use App\Equipo;
use App\Inscripcion;
use App\User_Empresa_Equipo;
use App\Mail\Avisar_Torneo;

class InscripcionesController extends Controller
{
    
//-----------------------------------------------------------------------------------------------------
    public function __construct(){
        Carbon::setLocale('es');
    }

//-----------------------------------------------------------------------------------------------------    
    public function create()
    {
        try {

            $equipo = User_Empresa_Equipo::with('equipo')
                    ->where('user_empresa_id', Auth::user()->user_empresa->id)
                    ->where('activo', 1)->first();
            
            $inscripciones = new Collection();

            if ($equipo)
                $inscripciones = Inscripcion::with('categoria_torneo')->where('equipo_id', $equipo->equipo_id)
                    ->where('activo', 1)->get();

            return view('inscripciones.create', compact('inscripciones', 'equipo'));
            
        } catch (Exception $e) {
            return response()->view('errors.404', [], 404);
        }
    }

//-----------------------------------------------------------------------------------------------------
    public function store(Request $req)
    {
        try {
            //****----CONTROLES-----------------------------------------------
            $mi_equipo = User_Empresa_Equipo::with('equipo')
                ->where('user_empresa_id', Auth::user()->user_empresa->id)->where('activo', 1)->first();
                        
            if (!$mi_equipo)
                return redirect()->back()->with('warning', 'DEBE TENER UN EQUIPO PARA PODER INSCRIBIRSE AL TORNEO');
            
            $inscripto = Inscripcion::where('equipo_id', $mi_equipo->equipo_id)
                ->where('categoria_torneo_id', $req->categoria_torneo_id)->where('activo', 1)->first();
            
            if ($inscripto)            
                return redirect()->back()->with('warning', 'EL EQUIPO YA TE ENCUENTRAS INSCRIPTO AL TORNEO');
            

            $uee = User_Empresa_Equipo::with('equipo')->where('equipo_id', $mi_equipo->equipo_id)
                    ->where('activo',1)->get();
            
            $ct = Categoria_Torneo::with('torneo')->findOrFail($req->categoria_torneo_id);

            if ($mi_equipo->equipo->categoria_id <> $ct->categoria_id )
                return redirect()->back()
                ->with('warning', 'SU EQUIPO NO CUMPLE CON LA CATEGORIA PARTICIPANTE.');           

            if ($uee->count() <> $ct->n_ptes )
                return redirect()->back()
                ->with('warning', 'SU EQUIPO NO CUMPLE CON LA CANTIDAD DE PARTICIPANTES PERMITIDOS');
            
            if(Partido::where('categoria_torneo_id', $ct->id)->get()->isNotEmpty())
                return redirect()->back()
                    ->with('warning', 'LOS SENTIMOS, LA INSCRIPCION YA NO ESTA DISPONIBLE');

            if(Carbon::now() < $ct->torneo->ini_ins)
                return redirect()->back()
                    ->with('warning', 'LA INSCRIPCION ESTARA DISPONIBLE A PARTIR DEL ' . $ct->torneo->ini_ins->format('d-m-Y'));

            if(Carbon::now()->toDateString() > $ct->torneo->fin_ins->toDateString())
                return redirect()->back()
                    ->with('danger', 'LA INSCRIPCION YA NO ESTA DISPONIBLE PARA EL TORNEO');
            
            
            if ($ct->cupo == Inscripcion::where('categoria_torneo_id', $ct->id)->where('activo', 1)->get()->count())
                return redirect()->back()
                    ->with('warning', 'LOS SENTIMOS, NO HAY CUPOS DISPONIBLES.');
            
            //-----fin de controles -----------------------------------------------------

            $ins = new Inscripcion();
            $ins->categoria_torneo_id = $ct->id;
            $ins->equipo_id           = $mi_equipo->equipo_id;
            $ins->user_empresa_id     = Auth::user()->user_empresa->id;
            $ins->au                  = Auth::user()->user_empresa->id;
            $ins->save();

            return redirect()->route('torneo.avisar', [$ct->id, $mi_equipo->equipo_id]);

        } catch (Exception $e) {
            //dd($e);
            return response()->view('errors.404', [], 404);
        }      
    }

    public function avisarTorneo($id_ct, $id_equipo){

        try {
            
            $ct = Categoria_Torneo::with('torneo')->findOrFail($id_ct);

            $data = Array (
                'name'     => $ct->torneo->name,
                'inicia'   => $ct->torneo->f_desde->format('d-m-Y'),
                'hora'     => $ct->torneo->hora,
                'finaliza' => $ct->torneo->f_hasta->format('d-m-Y'),
                'valor'    => $ct->valor,
                
            );

            $equipo = User_Empresa_Equipo::with('user_empresa')->where('equipo_id', $id_equipo)
                ->where('activo', 1)->get();

            foreach ($equipo as $eq) {
                try {
                   Mail::to($eq->user_empresa->user->email)->send(new Avisar_Torneo($data)); 
                }catch(\Swift_TransportException $e){
                    return redirect()->route('torneo.index')->with('success', 'SU INSCRIPCION SE REALIZO CON EXITO!');
                }
                
            }
            
            return redirect()->route('torneo.index')->with('success', 'SU INSCRIPCION SE REALIZO CON EXITO');
            
        } catch (Exception $e) {
            return response()->view('errors.404', [], 404);
        }
    }

    public function destroy($id)
    {

        $inscripcion = Inscripcion::findOrFail($id);

        if(Partido::where('categoria_torneo_id', $inscripcion->categoria_torneo_id)->get()->isNotEmpty())
            return redirect()->back()
                ->with('danger', 'NO SE PUEDE CANCELAR LA INSCRIPCION UNA VEZ INICIADO EL TORNEO.');

        $inscripcion->activo = false;
        $inscripcion->au     = Auth::user()->user_empresa->id;
        $inscripcion->save();

        return redirect()->route('inscripciones.create')->with('success', 'SE CANCELO SU INSCRIPCION CON EXITO!.');
    }

    public function show($id_ct)
    {
        try {
            $inscripciones = Inscripcion::with('equipo')
                            ->where('categoria_torneo_id', $id_ct)
                            ->where('activo', 1)->get();
            
            $equipos = new Collection();
            
            foreach ($inscripciones as $inscripcion) {

                $jugadores = User_Empresa_Equipo::with('user_empresa', 'equipo')
                            ->where('equipo_id', $inscripcion->equipo_id)
                            ->where('activo', 1)->get();

                foreach ($jugadores as $jugador) {
                    $equipo = new Collection();
                    $us = $jugador->user_empresa->user->user;
                    $eq = $jugador->equipo->name;
                    
                    $ran = Ranking::where('user_empresa_id', $jugador->user_empresa->id)->first();
                    
                    if (empty($ran)){
                        $pts = 0;
                        $tor = 0;
                    }else{
                        $pts = $ran->puntos;
                        $tor = $ran->torneos_jugados;
                    }

                    $equipo->put(0, $eq);
                    $equipo->put(1, $us);
                    $equipo->put(2, $pts);
                    $equipo->put(3, $tor);
                    
                    $equipos->push($equipo);

                }
            }

            $id_torneo = (Categoria_Torneo::findOrFail($id_ct))->torneo_id;
            
            return view('inscripciones.show', compact('equipos' , 'id_torneo'));

        } catch (Exception $e) {
            return response()->view('errors.404', [], 404);
        }
    }

    
}
