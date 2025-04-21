<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;

use App\Jugador;
use App\User;
use App\Detalle_Reserva;
use App\User_Empresa;
use App\Mail\Avisar_Usuario;

use Auth;

class JugadoresController extends Controller
{
    
	public function index(){

	}

	public function create (Request $req, $id_dr){

      try {

		$dr = Detalle_Reserva::findOrFail($id_dr);
		$jugadores = Jugador::where('detalle_reserva_id', $id_dr)->get();
		$usuarioss = User::buscar($req->get('buscar'))->orderBy('id','ASC')->paginate(50);
		$usuarios = new Collection();
		$i = 1; $j = 4;
		foreach ($usuarioss as $us) {
			if ($us->user_empresa->rol_id == 4){
				if ($i < $j){
					if (!$jugadores->contains('user_empresa_id', $us->user_empresa->id)){
						$usuarios->push($us);
						$i++;
					}
				}else{
					return view('jugadores.create', compact('usuarios', 'jugadores', 'dr'));
				}
			}
		}
		
		return view('jugadores.create', compact('usuarios', 'jugadores', 'dr'));
        
      } catch (\Exception $e) {
        return response()->view('errors.404', [], 404);
      }

	}

	//-----------------------------------------------------------------------------

		public function create1 (Request $req, $id_dr){

		    try {

				$dr = Detalle_Reserva::findOrFail($id_dr);
				$jugadores 		= Jugador::where('detalle_reserva_id', $id_dr)->where('confirmo', 0)->get();
				$confirmados 	= Jugador::where('detalle_reserva_id', $id_dr)->where('confirmo', 1)->get();
				$usuarioss 		= User::buscar($req->get('buscar'))->orderBy('id','ASC')->paginate(10);
				$usuarios 		= new Collection();
				$i = 1; $j = 4;
				
				foreach ($usuarioss as $us) {
					//dd($us->user_empresa->rol_id);
					if ($us->user_empresa->rol_id == 4){
						if ($i < $j){
							if (!$jugadores->contains('user_empresa_id', $us->user_empresa->id)){
								if (!$confirmados->contains('user_empresa_id', $us->user_empresa->id)){
									$usuarios->push($us);
									$i++;
								}
							}
						}else{
							return view('jugadores.create1', compact('usuarios', 'jugadores', 'dr', 'confirmados'));
						}
					}
				}
							
				return view('jugadores.create1', compact('usuarios', 'jugadores', 'dr', 'confirmados'));
		        
		    } catch (\Exception $e) {
		    	dd($e);
		        return response()->view('errors.404', [], 404);
		    }

		}

    //-----------------------------------------------------------------------------
	public function addUser($id_user_emp, $id_dr, $flag){
      
      try {

		$jugador = new Jugador();
		$us = User_Empresa::findOrFail($id_user_emp); 
		$jugadores = Jugador::where('detalle_reserva_id', $id_dr)->get();
		$existe = true;
		$dr = Detalle_Reserva::findOrFail($id_dr);
		if ($jugadores->contains('user_empresa_id', $us->id))
			$existe = false;

		if ($existe){
			$jugador->detalle_reserva_id    = $id_dr;	
			$jugador->user_empresa_id 		= $us->id;
			$jugador->save();
			$notificacion = array(
	            'message' => 'El Jugador se asocio con exito!', 
	            'alert-type' => 'success'
	        );

		}else{
			$notificacion = array(
	            'message' => 'El Jugador ya se encuentra asociado!', 
	            'alert-type' => 'danger'
	        );
		}
		
		if ($flag){
			return redirect()->route('jugadores.create1', $id_dr)->with($notificacion);
		}else{
			return redirect()->route('jugadores.create', $id_dr)->with($notificacion);
		}

		

      } catch (\Exception $e) {
      	//dd($e);
        return response()->view('errors.404', [], 404);
      }		
	}

	public function delUser($id_jugador, $id_dr, $flag){

      try {

		$jugador = Jugador::findOrFail($id_jugador);
		$jugador->delete();

		$notificacion = array(
            'message' => 'El Jugador se quito con exito!', 
            'alert-type' => 'warning'
        );
		
		if ($flag){
			return redirect()->route('jugadores.create1', $id_dr)->with($notificacion);
		}else{
			return redirect()->route('jugadores.create', $id_dr)->with($notificacion);
		}
		

      } catch (\Exception $e) {
        return response()->view('errors.404', [], 404);
      }
	}

	public function avisarJugadores($id_reserva){

		try {

			$ddrr = Detalle_Reserva::where('activo', 1)->where('confirmada', 1)->where('reserva_id', $id_reserva)->get();
			
			foreach ($ddrr as $dr) {
				$data = Array (
					'fecha' => $dr->fecha_reservada->format('d-m-Y'),
					'hora'	=> $dr->hr_reservada,
				);
				
				$jugadores = Jugador::with('user_empresa')->where('detalle_reserva_id', $dr->id)->get();
				
				if ($jugadores->isNotEmpty()){
					foreach ($jugadores as $jugador) {
						try {
							Mail::to($jugador->user_empresa->user->email)->send(new Avisar_Usuario($data));
						 }catch(\Swift_TransportException $e){
							$mensaje = 'SU RESERVA SE REALIZO CON EXITO!, no se pudo notificar a los jugadores debido a un problema de conexión. (Para avisar manualmente dirijase a: Mis Reservas -> Editar Reserva -> Editar Jugadores -> Avisar). Disculpe las molestias';
							return redirect()->route('reserva.show', $dr->reserva_id)->with('success', $mensaje );
						}
							
					}
					$mensaje = 'SU RESERVA SE REALIZO CON EXITO!, se notifico a los participantes de la misma.';
				}else{
					$mensaje = 'SU RESERVA SE REALIZO CON EXITO!';
				}
				
			}

			return redirect()->route('reserva.show', $dr->reserva_id)->with('success', $mensaje );

		} catch (Exception $e) {
			
			return response()->view('errors.404', [], 404);
		}

	}

	public function avisarJugadores1($id_dr){

		try {

			$dr = Detalle_Reserva::findOrFail($id_dr);
			
		
			$data = Array (
				'fecha' => $dr->fecha_reservada->format('d-m-Y'),
				'hora'	=> $dr->hr_reservada,
			);
			
			$jugadores = Jugador::with('user_empresa')->where('detalle_reserva_id', $dr->id)->get();
			
			if ($jugadores->isNotEmpty()){
				foreach ($jugadores as $jugador) {
					try {
						Mail::to($jugador->user_empresa->user->email)->send(new Avisar_Usuario($data));
					}catch(\Swift_TransportException $e){
						$mensaje = 'PROBLEMA DE CONEXION, NO SE PUEDE NOTIFICAR A LOS JUGADORES. asegurese de estar conectado a internet ';
						return redirect()->back()->with('danger', $mensaje );
					}
				}

				$notificacion = array(
		            'message' => 'ESTAMOS NOTIFICANDO A LOS NUEVOS JUGADORES', 
		            'alert-type' => 'success'
		        );
				
			}else{
				
				$notificacion = array(
		            'message' => 'EL JUEGO NO TIENE JUGADORES ASOCIADOS', 
		            'alert-type' => 'warning'
		        );
				
			}

			return redirect()->back()->with($notificacion);
		} catch (Exception $e) {
			
			return response()->view('errors.404', [], 404);
		}

	}


	public function getJuegos(){
		try {
			
			// jncs = variable que representa los juegos no confirmados o invitaciones que tiene el jugador
			$jncs = Jugador::with('detalle_reserva')
				->where('activo', 1)	
				->where('confirmo', 0)
				->where('user_empresa_id', Auth::user()->user_empresa->id)->get();

			// jcs = variable que representa los juegos  confirmados que tiene el jugador
			$jcs = Jugador::with('detalle_reserva')	
				->where('confirmo', 1)
				->where('user_empresa_id', Auth::user()->user_empresa->id)->get();

			return view('jugadores.juegos', compact('jncs', 'jcs'));

		} catch (Exception $e) {
			
			return response()->view('errors.404', [], 404);		
		}
	}

	public function confirmarJuego(Request $req){

		try {

			$juego = Jugador::where('detalle_reserva_id', $req->detalle_reserva_id)
						->where('user_empresa_id', Auth::user()->user_empresa->id)->first();

			$juego->confirmo = true;
			$juego->save();

			$notificacion = array(
	            'message' => 'SU PARTICIPACION SE CONFIRMO CON EXITO!.', 
	            'alert-type' => 'success'
	        );
			return redirect()->route('jugadores.getJuegos')->with($notificacion);
					
		} catch (Exception $e) {
			
			return response()->view('errors.404', [], 404);
		}

	}

	public function cancelarJuego(Request $req){

		try {

			$juego = Jugador::where('detalle_reserva_id', $req->detalle_reserva_id)
						->where('user_empresa_id', Auth::user()->user_empresa->id)->first();

			$juego->confirmo = false;
			$juego->save();

			$notificacion = array(
	            'message' => 'SU PARTICIPACION SE CANCELO CON EXITO!.', 
	            'alert-type' => 'warning'
	        );

			return redirect()->route('jugadores.getJuegos')->with($notificacion);
					
		} catch (Exception $e) {
			
			return response()->view('errors.404', [], 404);
		}

	}

	public function anularInvitacion (Request $req){

		try {

			$juego = Jugador::findOrFail($req->jugador_id);
			$juego->activo = false;
			$juego->save();

			$notificacion = array(
	            'message' => 'LA INVITACION SE CANCELO CON EXITO!.', 
	            'alert-type' => 'warning'
	        );

			return redirect()->route('jugadores.getJuegos')->with($notificacion);
			
		} catch (Exception $e) {
			
			return response()->view('errors.404', [], 404);

		}

	}


}

