<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Auth;
use App\Reserva;
use App\Cancha;
use App\Servicio_Requerido;
use App\Cancha_Servicio;
use App\Detalle_Reserva;

class Servicios_RequeridosController extends Controller
{
    
    //agrega los servicios obcionales a la cancha contratada
  	public function store(Request $req){
	  	try {

			$sr = new Servicio_Requerido();
			$cs = Cancha_Servicio::findOrFail($req->cancha_servicio_id);
			
			$sr->precio 			= $cs->precio;
			$sr->cancha_servicio_id = $req->cancha_servicio_id;
			$sr->detalle_reserva_id = $req->detalle_reserva_id;
			$sr->save();
			
			$dr = Detalle_Reserva::findOrFail($req->detalle_reserva_id);
			$reserva = Reserva::findOrFail($dr->reserva_id);
			
			$total = 0;
			if ($cs->xhr){
				$total = $dr->cant_hs * $sr->precio; 
			}else{
				$total = $sr->precio;
			}

			$old = $dr->monto;
			$dr->monto = 0;
			$dr->monto = $old + $total;
			$dr->save();

			$old = 0;
			$old = $reserva->total;
			$reserva->total = 0;
			$reserva->total = $old + $total;		
			$reserva->save();

			$editar = $req->editar;
		
			$notificacion = array(
	            'message' => 'Servicio Agregado con Exito!', 
	            'alert-type' => 'success'
	        );
			
			if ($req->editar)
				return redirect()->route('servicios_requeridos.editarServicios', $req->detalle_reserva_id)->with($notificacion);
			
			return redirect()->route('detalle_reserva.asociarServicios', $req->detalle_reserva_id)->with($notificacion);
  
	    } catch (\Exception $e) {
	    	
	        return response()->view('errors.404', [], 404);
	    }
		
		
  	}

  	//elimina los servicios requeridos
  	public function destroy($id_sr, $id_dr, $editar){
		
		try {
        	
        	$sr = Servicio_Requerido::findOrFail($id_sr);
		
			$cs = Cancha_Servicio::findOrFail($sr->cancha_servicio_id);
			$dr = Detalle_Reserva::findOrFail($id_dr);
			$reserva = Reserva::findOrFail($dr->reserva_id);
			
			$total = 0;
			if ($cs->xhr){
				$total = $dr->cant_hs * $sr->precio; 
			}else{
				$total = $sr->precio;
			}

			$old = $dr->monto;
			$dr->monto = 0;
			$dr->monto = $old - $total;
			$dr->save();

			$old = 0;
			$old = $reserva->total;
			
			$reserva->total = 0;
			$reserva->total = $old - $total;		
			$reserva->save();

			$sr->delete();
			$notificacion = array(
	            'message' => 'Servicio Quitado con Exito!', 
	            'alert-type' => 'warning',
	        );

			if ($editar)
				return redirect()->route('servicios_requeridos.editarServicios', $sr->detalle_reserva_id)->with($notificacion);
			
			
			return redirect()->route('detalle_reserva.asociarServicios', $sr->detalle_reserva_id )->with($notificacion);
      	
      	} catch (\Exception $e) {
        	dd($e);
        	return response()->view('errors.404', [], 404);
      	}			
	}

	public function getCanchas($fecha, $hr, $cant_hs){

    	$canchas = Cancha::all();
    	return $canchas;
    }

	//-----------------------------------------------------------------------------
  	public function editarServicios(Request $req, $id_dr){
    	
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
        
        return view('detalle_reserva.editarServicios', compact('dr', 'disponibles', 'cancha', 'asociados', 'editar'));
      
      } catch (\Exception $e) {
        
          return response()->view('errors.404', [], 404);
      }
  	}

}
