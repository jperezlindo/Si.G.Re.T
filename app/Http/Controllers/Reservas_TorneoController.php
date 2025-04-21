<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

use Auth;
use App\Torneo;
use App\Cancha;
use App\Detalle_Reserva;
use App\Reserva_Torneo;

class Reservas_TorneoController extends Controller
{


    public function create($id_torneo)
    {
    	try {
    		
    		$torneo = Torneo::findOrFail($id_torneo);

	        $reservass = Detalle_Reserva::with('reserva')
	        							->where('fecha_reservada', '>=', $torneo->f_desde)
	                                   	->where('fecha_reservada', '<=', $torneo->f_hasta)->get();


	        $reservas = new Collection();
	        foreach ($reservass as $re) {
	        	
	        	if ($re->reserva->user_empresa->user_id == Auth::user()->id){

		        	$e = Reserva_Torneo::where('detalle_reserva_id', $re->id)->where('activo', 1)->first();
		        	
		        	if (empty($e)){
		        		$re->ca = Cancha::findOrFail($re->ca)->name;	
		        		$reservas->push($re);
		        	}
		        }
	        }

	        $agregadass = Reserva_Torneo::where('torneo_id', $torneo->id)->where('activo', 1)->get();

	        $agregadas = new Collection();
	        if ($agregadass->isNotEmpty()){
		        foreach ($agregadass as $agre) {
		        	$dr = Detalle_Reserva::findOrFail($agre->detalle_reserva_id);
		        	$dr->ca = Cancha::findOrFail($dr->ca)->name;

		        	$agregadas->push($dr);
		        }
		    }

        	return view('torneo.reservas_torneo', compact('reservas', 'agregadas', 'torneo'));

    	} catch (Exception $e) {
    		return response()->view('errors.404', [], 404);	
    	}
    }


   	public function store(Request $req)
   	{

		$rt = new Reserva_Torneo();
		
		$rt->torneo_id          = $req->torneo_id;
		$rt->detalle_reserva_id = $req->detalle_reserva_id;
		$rt->save();

	    $notificacion = array(
	        'message' => 'RESERVA AGREGADA CON EXITO!', 
	        'alert-type' => 'success'
	    );

		return redirect()->route('reserva_torneo.create', $req->torneo_id)->with($notificacion);
   	}

   	public function destroy (Request $req)
   	{
		try {

			$rt = Reserva_Torneo::where('detalle_reserva_id', $req->detalle_reserva_id)->first();
			
			$rt->delete();

		    $notificacion = array(
		        'message' => 'LA RESERVA SE QUITO CON EXITO!', 
		        'alert-type' => 'info'
		    );

			return redirect()->route('reserva_torneo.create', $rt->torneo_id)->with($notificacion);
		} catch (Exception $e) {
			return response()->view('errors.404', [], 404);
		}
   	}

}
