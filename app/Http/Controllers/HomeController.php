<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

use App\User;
use App\Inscripcion;
use App\User_Empresa;
use App\User_Empresa_Equipo;
use App\Reserva;
use App\Detalle_Reserva;
use App\Cancha;
use App\Torneo;
use Carbon\Carbon;
use Auth;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

    }


    public function index()
    {
        try {
            $cant_to = Torneo::where('em', Auth::user()->user_empresa->empresa_id)->where('activo', 1)->get()->count();
            if (Auth::user()->rol() == 6)
                return redirect()->route('auditoria.index');

            //Para el cliente
            if (Auth::user()->rol() == 4){
                $rs = Reserva::with('detalles_reserva')->where('activo', 1)
                      ->where('user_empresa_id', Auth::user()->user_empresa->id)
                      ->get();
                
                $cant_res = 0;

                $reservas = new Collection();

                foreach ($rs as $r) {
                    foreach ($r->detalles_reserva as $dr) {
                        $hoy = Carbon::now()->toDateString();
                        $fere = Carbon::parse($dr->fecha_reservada)->toDateString();
                        
                        if ($hoy == $fere){
                            
                            $cancha = Cancha::findOrFail($dr->ca)->name;
                            $dr->ca = $cancha;
                            $reservas->push($dr);
                        }
                        $cant_res++;
                    }
                }
                
                $reservas = $reservas->sortBy('hr_reservada');
                
                $uee = User_Empresa_Equipo::where('user_empresa_id', Auth::user()->user_empresa->id)->first();
                
                if (empty($uee)){
                    $cant_ins = 0;
                }else{
                    $equipo_id = $uee->equipo_id;
                    $cant_ins = Inscripcion::where('activo', 1)->where('equipo_id', $equipo_id)->get()->count();  
                }            

                
                return view ('home', compact('reservas', 'cant_res', 'cant_ins'));

            }else{
                //Para la empresa
                $canchas = Cancha::where('empresa_id', Auth::user()->user_empresa->empresa_id)->get();
              
                $reservas = new Collection();
                foreach ($canchas as $ca) {
                    $ddrr = Detalle_Reserva::with('reserva')
                        ->where('ca', $ca->id)
                        ->where('activo', 1)
                        ->where('fecha_reservada', Carbon::now()->toDateString())
                        ->get();

                    foreach ($ddrr as $dr) {
                        $dr->ca = $ca->name;
                        $dr->au = User::findOrFail($dr->reserva->user_empresa->user_id)->user;

                        $reservas->push($dr);
                    }
                }

                $cant_us = User_Empresa::where('empresa_id', Auth::user()->user_empresa->empresa_id)->get()->count();
                $reservas = $reservas->sortBy('hr_reservada');
               return view ('home_empresa', compact('reservas', 'cant_us', 'cant_to'));
            }
                
        } catch (Exception $e) {
            //dd($e);
            return response()->view('errors.404', [], 404);
        }
    }

}
