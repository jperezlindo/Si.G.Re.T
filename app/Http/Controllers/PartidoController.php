<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

use Auth;
use Carbon\Carbon;
use App\Cancha;
use App\Partido;
use App\Detalle_Partido;
use App\Detalle_Reserva;
use App\User_Empresa_Equipo;
use App\Categoria_Torneo;
use App\Reserva_Torneo;
use App\Torneo;
use App\Categoria;


class PartidoController extends Controller
{

    public function index()
    {
        //
    }


    public function create($id_partido)
    {
        try {
            
            $partido = Partido::with('detalle_partido', 'categoria_torneo')->findOrFail($id_partido);
            $partido_ = new Collection();
            
            foreach ($partido->detalle_partido as $dp) {
                
                $jugadores = User_Empresa_Equipo::with('user_empresa')->where('equipo_id', $dp->equipo_id)->get();

                $par = new Collection();    
                $nombres = new Collection();
                foreach ($jugadores as $jugador) {
                    $nombres->push($jugador->user_empresa->user->user);
                }
                $par->put('0', $dp);
                $par->put('1', $nombres);
                $partido_->push($par);
            }

            $torneo = Torneo::findOrFail($partido->categoria_torneo->torneo_id);
            $desde = $torneo->f_desde->format('Y-m-d');
            $hasta = $torneo->f_hasta->format('Y-m-d');
            $hora = $torneo->hora;

            $ct = Categoria_Torneo::findOrFail($partido->categoria_torneo_id);
            $c = Categoria::with('c_categoria', 'c_sexo', 'c_etario')->findOrFail($ct->id);
            $categoria = $c->c_etario->name .'-'. $c->c_sexo->name .'-'. $c->c_categoria->name; 
            

            $canchas = new Collection();

            $rrtt = Reserva_Torneo::where('torneo_id', $torneo->id)->get();

            foreach ($rrtt as $rt) {
                $dr = Detalle_Reserva::findOrFail($rt->detalle_reserva_id);
                $ca = Cancha::findOrFail($dr->ca);

                if (!$canchas->contains($ca))
                    $canchas->push($ca);
            }



            return view ('partido.create', compact('torneo', 'categoria','partido', 'partido_', 'canchas', 'desde', 'hasta', 'hora'));

        } catch (Exception $e) {
            return response()->view('errors.404', [], 404);
        }
    }


    public function store(Request $req)
    {
        
        try {

            $torneo = Torneo::findOrFail(Categoria_Torneo::with('torneo')->findOrFail($req->ct_id)->torneo_id);
            
            if (($req->fecha < $torneo->f_desde->toDateString()) or ($req->fecha > $torneo->f_hasta->toDateString()))
                return redirect()->back()->with('danger', 'LA FECHA DE LOS PARTIDOS DEBEN SER DENTRO DE: ' . $torneo->f_desde->format('d-m-Y') . ' Y ' . $torneo->f_hasta->format('d-m-Y'));

            $partido = Partido::with('detalle_partido')->findOrFail($req->partido_id);

            $partidos = Partido::where('categoria_torneo_id', $partido->categoria_torneo_id)
                                ->where('activo', 1)->where('finalizado', 1)
                                ->where('fecha', $req->fecha)->get();

            foreach ($partidos as $par) {

                $rhini = Carbon::parse($req->hr_ini)->format('H:i:s');
                $rhfin = Carbon::parse($req->hr_fin)->format('H:i:s');
                $phini = Carbon::parse($par->hr_ini)->format('H:i:s');
                $phfin = Carbon::parse($par->hr_fin)->format('H:i:s');
                
                //dd($rhini, $phini, $phfni);
                if ($req->partido_id <> $par->id){
                
                    if ((strcmp($par->cancha, $req->cancha) === 0) and ($rhini >= $phini) and ($rhini <= $phfin)){
                        $notificacion = array(
                            'message' => 'HORA NO VALIDA, EXISTE UN PARTIDO CARGADO.', 
                            'alert-type' => 'danger'
                        );
                        return redirect()->back()->with($notificacion);
                    }
                        
                    
                    if ((strcmp($par->cancha, $req->cancha) === 0) and ($rhfin >= $phini) and ($rhfin <= $phfin)){
                        $notificacion = array(
                            'message' => 'HORA NO VALIDA, EXISTE UN PARTIDO CARGADO..', 
                            'alert-type' => 'danger'
                        );
                        return redirect()->back()->with($notificacion);
                    }
                    

                    if ((strcmp($par->cancha, $req->cancha) === 0) and ($rhini <= $phini) and ($rhfin >= $phfin)){
                        $notificacion = array(
                            'message' => 'HORA NO VALIDA, EXISTE UN PARTIDO CARGADO...', 
                            'alert-type' => 'danger'
                        );
                        return redirect()->back()->with($notificacion);
                    }
                }
            }

            $total = 0; $suma  = 0; 
            foreach ($partido->detalle_partido as $i => $dp) {
                
                $dp = Detalle_Partido::findOrFail($dp->id);
                $dp->set_01     = $req->set_01[$i];
                $dp->set_02     = $req->set_02[$i];
                $dp->set_03     = $req->set_03[$i];
                $dp->comentario = $req->comentario;
                $dp->au         = Auth::user()->user_empresa->id;
                

                $suma = $req->set_01[$i]+$req->set_02[$i]+$req->set_03[$i];
                
                if ($suma == 0){
                    $notificacion = array(
                        'message' => 'COMPLETE TODOS LOS CAMPOS PARA PODER GUARDAR LOS DATOS!', 
                        'alert-type' => 'danger'
                    );
                    return back()->with($notificacion);
                }

                if ($suma > $total){
                    $winn  = $dp->id;
                    $total = $suma;
                    $eq    = $dp->equipo_id;
                }

                $dp->save();
            }

            $dp = Detalle_Partido::findOrFail($winn);
            $dp->isWinn = 1;
            $dp->save();

            $partido->cancha     = $req->cancha; 
            $partido->finalizado = 1;
            $partido->hr_ini     = $req->hr_ini;
            $partido->hr_fin     = $req->hr_fin;
            $partido->fecha      = $req->fecha;
            $partido->au         = Auth::user()->user_empresa->id;
            $partido->winn       = $eq;
            $partido->save();

            return redirect()->route('fixture.show', $partido->categoria_torneo_id)
                ->with('success', 'LOS DATOS DEL PARTIDO ' . $partido->name .' FUERON AGREGADOS CON EXITO!'); 

        } catch (Exception $e) {
            return response()->view('errors.404', [], 404);
        }
        
    }


    public function show($id_partido)
    {
        try {
            
            $partido = Partido::with('detalle_partido')->findOrFail($id_partido);
            $partido_ = new Collection();
            
            foreach ($partido->detalle_partido as $dp) {
                
                $jugadores = User_Empresa_Equipo::with('user_empresa')->where('equipo_id', $dp->equipo_id)->get();

                $par = new Collection();    
                $nombres = new Collection();
                foreach ($jugadores as $jugador) {
                    $nombres->push($jugador->user_empresa->user->user);
                }
                $par->put('0', $dp);
                $par->put('1', $nombres);
                $partido_->push($par);
            }

            $canchas = Cancha::where('empresa_id', Auth::user()->user_empresa->empresa_id)->get();

            return view ('partido.show', compact('partido', 'partido_', 'canchas'));

        } catch (Exception $e) {
            
        }
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
