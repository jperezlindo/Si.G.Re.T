<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

use Auth;
use App\Ranking;
use App\Fixture;
use App\Torneo;
use App\Partido;
use App\Categoria;
use App\Instancia;
use App\Inscripcion;
use App\Detalle_Partido;
use App\Categoria_Torneo;

use App\Cancha;
use App\User_Empresa_Equipo;
use App\Reserva;
use App\Detalle_Reserva;
use App\Reserva_Torneo;

class FixtureController extends Controller
{
    public function __construct(){
    	Carbon::setLocale('es');
  	}
//------------------------------------------------------------------------------------------------

  	public function create($id_torneo){

  		$torneo = Torneo::with('tipo_torneo')->findOrFail($id_torneo);

  		$categorias_t = Categoria_Torneo::where('torneo_id', $torneo->id)->where('activo', 1)->get();
  		//if($torneo->fecha != Carbon::now()->format('Y-m-d'))
  			//return redirect()->back()->with('warning', 'LAS INSCRIPTIONES ESTAN ABIERTAS');
  		
        foreach ($categorias_t as $ct) {
            $ins = Inscripcion::where('categoria_torneo_id', $ct->id)->where('activo', 1)->get();
            $ct = array_add($ct, 'ins', $ins->count());
        }

        $rrtt = Reserva_Torneo::where('torneo_id', $torneo->id)->get();

        $canchas = new Collection();

        foreach ($rrtt as $rt) {
        	$dr = Detalle_Reserva::findOrFail($rt->detalle_reserva_id);
        	$ca = Cancha::findOrFail($dr->ca);

        	$cancha = new Collection();

        	$cancha->put('ca', $ca->name);

        	if (!$canchas->contains('ca', $ca->name))
        		$canchas->push($cancha);
        }

  		return view ('fixture.create', compact('torneo', 'categorias_t', 'canchas'));
  	}
//------------------------------------------------------------------------------------------------

	public function primeraRonda (Request $req){

		try {
			
			$ct = Categoria_Torneo::findOrFail($req->categoria_torneo_id);

			if (Partido::where('categoria_torneo_id', $ct->id)->get()->isNotEmpty())
				return redirect()->back()->with('danger', 'EL TORNEO NO SE PUEDE VOLVER A COMENZAR!');

			// inscripciones representa una coleccion de inscripciones para el torneo
			$inscripciones = Inscripcion::with('equipo', 'categoria_torneo')
					->where('activo', 1)->where('categoria_torneo_id', $ct->id)->get();
			
			if ($inscripciones->isEmpty())
				return redirect()->back()->with('danger', 'EL TORNEO NO TIENE INSCRIPCIONES ACTIVAS!');
			
			if ($inscripciones->count() < 4)
				return redirect()->back()->with('danger', 'LA CATEGORIDA DEBE TENER MAS DE 3 EQUIPOS PARTICIPANTES PARA PODER DESARROLLARSE!');
		    
		    $i = $inscripciones->count();

		    switch ($i){
			
				case ($i <= 4)   : $ins_ini = 2;  break;
				case ($i <= 8)   : $ins_ini = 3;  break;
				case ($i <= 16)  : $ins_ini = 4;  break;
				case ($i >= 17)  : $ins_ini = 5;  break;

        
	    	}

	    	

			//arma el fixture de la primera ronda Open C/ cabeza de serie
			if (Torneo::findOrFail($ct->torneo_id)->tipo_torneo_id == 1){

				//selecciona los cabezas de serie con el criterio de mayor puntaje
				//en la sumataria de los puntajes de los integrantes del equipo
				$participantes = new Collection();
				foreach ($inscripciones as $ins) {
					$total = 0;
					
					foreach ($ins->equipo->user_empresa_equipo as $uee) {
						$rank   = Ranking::where('user_empresa_id', $uee->user_empresa_id)->first();
						if ($rank == null){
							$total = 0;
						}else{	
							$total = $total + $rank->puntos;
						}
					}
					
					$participante = new Collection();

					$participante->put('equipo', $ins->equipo);
					$participante->put('puntos', $total);
					
					$participantes->push($participante);
				}
				
				if (($inscripciones->count() %2 == 0)){
					$cant = intval($inscripciones->count() / 2) -1;
				}else{
					$cant = intval($inscripciones->count() / 2);
				}
				
				$c = 0;
				$cabezas = new Collection();
				$resto   = new Collection();

				foreach ($participantes->sortBy('puntos')->reverse() as $par) {
					if ($c <= $cant){
						$cabezas->push($par);
					}else{
						$resto->push($par);
					}
					$c++;
				}
				
			    //-----fin de seleccion de cabezas de serie-----------------------------
				
				//en caso de que el numeros de inscriptos sean impares, 
				//entra al if y selecciona un equipo aleatoriamente y lo deja libre.
				if (!($inscripciones->count() %2 == 0)){

					$torneo = Torneo::findOrFail($ct->torneo_id);
					
					$libre   = $cabezas->pull(rand(0,$cant))['equipo'];

					$partido = new Partido();

					$partido->name                = $libre->name . ' ' . 'LIBRE';
					$partido->fecha               = Carbon::now()->format('Y-m-d');
					$partido->hr_ini              = $torneo->hora;
					$partido->hr_fin              = $torneo->hora;
					$partido->finalizado          = 1;
					$partido->categoria_torneo_id = $ct->id;
					$partido->instancia_id        = $ins_ini;
					$partido->au                  = Auth::user()->user_empresa->id;
					$partido->save();

					$dp = new Detalle_Partido();

					$dp->comentario = 'LIBRE';
					$dp->isWinn     = 1;
					$dp->set_01     = 7;
					$dp->set_02     = 7;
					$dp->set_03     = 7;
					$dp->au         = Auth::user()->user_empresa->id;
					$dp->equipo_id  = $libre->id;
					$dp->partido_id = $partido->id;
					$dp->save();

					$case = $cabezas;
					
					$cabezas = new Collection();
					foreach ($case as $cabeza) {
						$cabezas->push($cabeza);
					}
				}
				//--------- fin de libre -----------------------------------

				//dd($cabezas, $resto, $cant);
				$equipos = new Collection();
				
				$i =0;
				if ($cant %2 == 0){
					$fin = $cant + 1;
				}else{
					$fin = $cant;
				}
				
				while ( $i < $fin) {
					
					$equipo1 = $cabezas->pull($i);

					$claves  = $resto->keys();
					$equipo2 = $resto->pull($claves->random());

					$equipos->push($equipo1);
					$equipos->push($equipo2);

					$i = $i + 2;

				}
				
				
				if (($inscripciones->count() %2 == 0)){
					if ($cant %2 == 0){
						$i = $cant - 1;
					}else{
						$i = $cant;
					}
					
				}else{
					$i = $cant - 2;
				}
				
				$fin = 1;
				while ( $i >= $fin) {
					
					$equipo1 = $cabezas->pull($i);

					$claves  = $resto->keys();
					$equipo2 = $resto->pull($claves->random());
					$equipos->push($equipo1);
					$equipos->push($equipo2);

					if ($i == 1){
						$i = 0;
					}else{
						$i = $i - 2;
					}
					
				}

				
				$play_new = 1;
				foreach ($equipos as $equipo) {

					if (!($play_new % 2 == 0)){
						
						$partido = new Partido();
					
						$partido->name                = $equipo['equipo']->name;
						$partido->categoria_torneo_id = $ct->id;
						$partido->instancia_id        = $ins_ini;
						$partido->au                  = Auth::user()->user_empresa->id;
						$partido->save();

						$dp = new Detalle_Partido();
						$dp = $dp->newDetalle_Partido($equipo['equipo']->id, $partido->id);
						$dp->save();
					}else{
						
						$dp = new Detalle_Partido();
						$dp = $dp->newDetalle_Partido($equipo['equipo']->id, $partido->id);
						$dp->save();

						$partido = Partido::findOrFail($partido->id);
						$partido->name = $partido->name .' '.'vs.'.' '. $equipo['equipo']->name;
						$partido->save();

						$i = $i + 2;
					}
					$play_new++;				
				
				}			

			}
			//----Fin del Algoritmo Open C/ Cabeza de Serie-------------------------------------
			


			//arma el fixture de la primera ronda Open S/ cabeza de serie
			if (Torneo::findOrFail($ct->torneo_id)->tipo_torneo_id == 2){
				
				//devuelve la coleccion en un orden aleatorio.
				$inscriptos = $inscripciones->shuffle();

				//en caso de que el numeros de inscriptos sean impares, 
				//entra al if y selecciona el primero y lo deja libre.
				if (!($inscriptos->count() %2 == 0)){
					
					$torneo = Torneo::findOrFail($ct->torneo_id);

					$libre   = $inscriptos->pull(1);
					
					$partido = new Partido();

					$partido->name                = $libre->equipo->name . ' ' . 'LIBRE';
					$partido->fecha               = Carbon::now()->format('Y-m-d');
					$partido->hr_ini              = $torneo->hora;
					$partido->hr_fin              = $torneo->hora;
					$partido->finalizado          = 1;
					$partido->categoria_torneo_id = $ct->id;
					$partido->instancia_id        = $ins_ini;
					$partido->au                  = Auth::user()->user_empresa->id;
					$partido->save();

					$dp = new Detalle_Partido();

					$dp->comentario = 'LIBRE';
					$dp->isWinn     = 1;
					$dp->set_01     = 7;
					$dp->set_02     = 7;
					$dp->set_03     = 7;
					$dp->au         = Auth::user()->user_empresa->id;
					$dp->equipo_id  = $libre->equipo_id;
					$dp->partido_id = $partido->id;
					$dp->save();
				}	

				$play_new = 1;
				foreach ($inscriptos as $ins) {
					
					if (!($play_new % 2 == 0)){
						
						$partido = new Partido();

						$partido->name                = $ins->equipo->name;
						$partido->categoria_torneo_id = $ct->id;
						$partido->instancia_id        = $ins_ini;
						$partido->au                  = Auth::user()->user_empresa->id;
						$partido->save();

						$dp = new Detalle_Partido();
						$dp = $dp->newDetalle_Partido($ins->equipo_id, $partido->id);
						$dp->save();
					
					}else{
						
						$dp = new Detalle_Partido();
						$dp = $dp->newDetalle_Partido($ins->equipo_id, $partido->id);
						$dp->save();

						$partido = Partido::findOrFail($partido->id);
						$partido->name = $partido->name .' '.'vs.'.' '. $ins->equipo->name;
						$partido->save();
					}

					$play_new++;

				}
			}
			//----Fin del Algoritmo Open S/ Cabeza de Serie-------------------------------------


			return redirect()->route('fixture.show', $ct->id)->with('success', 'YA CUENTAS CON LOS ENFRENTAMIENTOS DE LA PRIMERA RONDA ');;
			
		} catch (Exception $e) {
			//dd($e);
			return response()->view('errors.404', [], 404);
		}
	
	}


//------------------------------------------------------------------------------------------------
	public function instancias (Request $req){

		try {
			
			if (Partido::with('detalle_partido')->where('categoria_torneo_id', $req->categoria_torneo_id)
				->where('instancia_id', $req->ins_fin)->where('finalizado', 0)->get()->isNotEmpty())
				return redirect()->back()
					->with('warning', 'NO SE HAN FINALIZADOS TODOS LOS PARTIDOS DE LA INSTANCIA!');

			$partidos = Partido::with('detalle_partido')
								->where('categoria_torneo_id', $req->categoria_torneo_id)
								->where('instancia_id', $req->ins_fin)
								->where('finalizado', 1)->get();
	    	
	    	
	    	//contrala que se cree la instancia correcta
		    $i = ($partidos->count() / 2);

		    switch ($i){
			
				case        1    : $ins_ini = 1;  break;
				case ($i <= 2)   : $ins_ini = 2;  break;
				case ($i <= 4)   : $ins_ini = 3;  break;
				case ($i <= 8)   : $ins_ini = 4;  break;
				case ($i <= 16)  : $ins_ini = 6;  break;
				case ($i <= 32)  : $ins_ini = 7;  break;
				case ($i <= 64)  : $ins_ini = 8;  break;
				case ($i <= 128) : $ins_ini = 9;  break;
				case ($i <= 256) : $ins_ini = 10; break;
        
	    	}

			$libre = null;

			//obtiebe el equipo libre en caso de que en la ronda exista una cantidad de equipos impares
			if (!($partidos->count() %2 == 0)){
				
				//colecicon de los detalles de partidos que son ganadores.
				$winners = new Collection();

				foreach ($partidos as $partido) {
					foreach ($partido->detalle_partido as $dp) {
						if ($dp->isWinn and strcmp($dp->comentario, 'LIBRE'))
							$winners->push($dp);
					}
				}

				//libre representa un objeto de detalle_partido 
				//que pasa libre a la siguiente ronda.
				$libre = $winners->shuffle()->random();
								
				$partido = new Partido();

				$partido->name                = $libre->equipo->name . ' ' . 'LIBRE';
				$partido->fecha               = Carbon::now()->format('Y-m-d');
				$partido->hr_ini              = $libre->partido->hr_fin;
				$partido->hr_fin              = $libre->partido->hr_fin;
				$partido->finalizado          = 1;
				$partido->instancia_id        = $ins_ini;
				$partido->categoria_torneo_id = $req->categoria_torneo_id;
				$partido->au                  = Auth::user()->user_empresa->id;
				$partido->save();

				$dp = new Detalle_Partido();

				$dp->set_01     = 7;
				$dp->set_02     = 7;
				$dp->set_03     = 7;
				$dp->comentario = 'LIBRE';
				$dp->isWinn     = 1;
				$dp->au         = Auth::user()->user_empresa->id;
				$dp->equipo_id  = $libre->equipo_id;
				$dp->partido_id = $partido->id;
				$dp->save();
			}

			$winners = new Collection();
			
			foreach ($partidos as $partido) {
				foreach ($partido->detalle_partido as $dp) {
					if ($libre){
						if ($dp->isWinn  and  ($libre->id <> $dp->id))
							$winners->push($dp);
					}else{
						if ($dp->isWinn)
							$winners->push($dp);						
					}
				}
			}

			//Arma los enfrentamientos en forma de llave.
			$play_new = 1;
			foreach ($winners as $dp) {
				if (!($play_new % 2 == 0)){
					
					$partido = new Partido();

					$partido->name                = $dp->equipo->name;
					$partido->categoria_torneo_id = $req->categoria_torneo_id;
					$partido->instancia_id        = $ins_ini;
					$partido->au                  = Auth::user()->user_empresa->id;
					$partido->save();

					$d_p = new Detalle_Partido();
					$d_p = $d_p->newDetalle_Partido($dp->equipo_id, $partido->id);
					$d_p->save();
				
				}else{
					
					$d_p = new Detalle_Partido();
					$d_p = $d_p->newDetalle_Partido($dp->equipo_id, $partido->id);
					$d_p->save();

					$partido = Partido::findOrFail($partido->id);
					$partido->name = $partido->name .' '.'vs.'.' '. $dp->equipo->name;
					$partido->save();
				}

				$play_new++;
			}

			return redirect()->route('fixture.show', $req->categoria_torneo_id);

		} catch (Exception $e) {
			return response()->view('errors.404', [], 404);
		}
	}



//------------------------------------------------------------------------------------------------

	public function show($id_ct){


		try {
			$ct = Categoria_Torneo::findOrFail($id_ct);
			
			$torneo = Torneo::findOrFail($ct->torneo_id);

			$partidos = Partido::with('detalle_partido', 'instancia')
				->where('categoria_torneo_id', $ct->id)->get()->reverse();
			

			if ($partidos->isEmpty()){

				$notificacion = array(
		            'message' => 'EL FIXTURE NO SE ENCUENTRA DISPONIBLE POR EL MOMENTO!', 
		            'alert-type' => 'info'
		        );
				return redirect()->back()->with($notificacion);
			}
			
			$c = Categoria::with('c_categoria', 'c_sexo', 'c_etario')->findOrFail($ct->categoria_id);
			$categoria = $c->c_etario->name .'-'. $c->c_sexo->name .'-'. $c->c_categoria->name; 
			return view('fixture.show', compact('partidos', 'torneo', 'categoria'));

		} catch (Exception $e) {
			return response()->view('errors.404', [], 404);
		}
		
	}

//------------------------------------------------------------------------------------------------

	public function finalizar_categoria(Request $req){

		try {

			$ct = Categoria_Torneo::findOrFail($req->categoria_torneo_id);
	 
	  		if (!($ct->activo))
	  			return redirect()->back()->with('warning', 'EL TORNEO PARA ESTA CATEGORIA YA SE FINALIZO');

	  		if (Partido::where('categoria_torneo_id', $req->categoria_torneo_id)
	  			->where('finalizado', 0)->get()->isNotEmpty())
	  			return redirect()->back()
	  				   ->with('warning', 'LA CATEGORIA NO SE PUEDE FINALIZAR! NO SE JUGARON TODOS LOS PARTIDOS');

	  		if (Partido::where('categoria_torneo_id', $req->categoria_torneo_id)
	  			->where('finalizado', 1)->where('activo', 0)->get()->isNotEmpty())
	  			return redirect()->back()->with('warning', 'LA CATEGORIA YA SE ENCUENTRA CERRADA');
		

	  		$partidos = Partido::with('detalle_partido')->where('categoria_torneo_id', $req->categoria_torneo_id)->get();

	  		//dectiva todos los partidos de la categoria para un torneo
	  		foreach ($partidos as $partido) {
	  			$partido->activo = 0;
	  			$partido->au     = Auth::user()->user_empresa->id;
	  			$partido->save();

	  			foreach ($partido->detalle_partido as $dp) {
	  				$dp->activo = 0;
	  				$dp->au 	= Auth::user()->user_empresa->id;
	  				$dp->save();
	  			}
	  		}

			$final  = Partido::with('detalle_partido')
						->where('categoria_torneo_id', $ct->id)
						->where('instancia_id', 1)->first();


			foreach ($final->detalle_partido as $dp) {
				
				$uueeee = User_Empresa_Equipo::with('User_Empresa')->where('equipo_id', $dp->equipo_id)->get();
				foreach ($uueeee as $uee) {
						    
					$rank = Ranking::where('user_empresa_id', $uee->user_empresa_id)->first();
					
					if ($rank == null){
						$rank = new Ranking();

						$rank->puntos          = 0;
						$rank->torneos_jugados = 0;
						$rank->promedio        = 0;
						$rank->activo          = 1;
						$rank->user_empresa_id = $uee->user_empresa_id;
						$rank->categoria       = $ct->categoria_id;
						$rank->user_empresa_id = $uee->user_empresa_id;
						$rank->au              = Auth::user()->user_empresa->id;
						$rank->save();
						$rank = Ranking::where('user_empresa_id', $uee->user_empresa_id)->first();
						
					}
					
					if ($dp->isWinn){
						$camp = $dp->equipo_id;
						$rank->puntos          += $ct->campeon;
						$rank->torneos_jugados += 1;
						$rank->promedio         = $rank->puntos / $rank->torneos_jugados;
						$rank->au              = Auth::user()->user_empresa->id;
						$rank->save();
					}else{

						$rank->puntos          += $ct->subcampeon;
						$rank->torneos_jugados += 1;
						$rank->promedio         = $rank->puntos / $rank->torneos_jugados;
						$rank->au              = Auth::user()->user_empresa->id;
						$rank->save();
					}
				}
			}

	  		//asigna los puntos a los equipos perdedores
			for ($i=2; $i <= 4; $i++) { 
			    
			    switch ($i){
					case 2 : $pts = $ct->semifinal;  break;
					case 3 : $pts = $ct->cuartos;  break;
					case 4 : $pts = $ct->octavos;  break;     
		    	}

				$partidos = Partido::with('detalle_partido')
							->where('categoria_torneo_id', $ct->id)
							->where('instancia_id', $i)->get();
				
				foreach ($partidos as $partido) {
					foreach ($partido->detalle_partido as $dp) {
						if(!$dp->isWinn){
							$uueeee = User_Empresa_Equipo::with('User_Empresa')->where('equipo_id', $dp->equipo_id)->get();
							foreach ($uueeee as $uee) {
								
								$rank = Ranking::where('user_empresa_id', $uee->user_empresa_id)->first();

								if ($rank == null){
									$rank = new Ranking();
									
									$rank->puntos          = $pts;
									$rank->torneos_jugados = 1;
									$rank->promedio        = $pts;
									$rank->activo          = 1;
									$rank->user_empresa_id = $uee->user_empresa_id;
									$rank->categoria       = $ct->categoria_id;
									$rank->user_empresa_id = $uee->user_empresa_id;
									$rank->au              = Auth::user()->user_empresa->id;
									$rank->save();
																		
								}else{
									$rank->puntos          = $rank->puntos + $pts;
									$rank->torneos_jugados = $rank->torneos_jugados + 1;
									$rank->promedio        = $rank->puntos / $rank->torneos_jugados;
									$rank->au              = Auth::user()->user_empresa->id;
									$rank->save();	
								}

						
							}
						}
					}
				}
			}

			$ct->au           = Auth::user()->user_empresa->id;
			$ct->activo       = 0;
			$ct->winn         = $camp;
			$ct->save();

			$inscripciones = Inscripcion::where('categoria_torneo_id', $ct->id)->get();

			foreach ($inscripciones as $inscripcion) {
				$inscripcion->activo = 0;
				$inscripcion->au     = Auth::user()->user_empresa->id;
				$inscripcion->save();
			}


			if (Categoria_Torneo::where('torneo_id', $ct->torneo_id)->where('activo', 1)->get()->isNotEmpty()){
				return redirect()->route('fixture.show', $ct->id)
	  			->with('success', 'SE REPARTIERON LOS PUNTOS CORRESPONDIENTES YLA CATEGORIA SE FINALIZO CON EXITO');
			}

			$torneo = Torneo::findOrFail($ct->torneo_id);
			
			$torneo->au         = Auth::user()->user_empresa->id;
			$torneo->activo     = 0;
			$torneo->finalizado = 1;
			$torneo->save();

			$rrtt = Reserva_Torneo::where('torneo_id', $torneo->id)->get();

			foreach ($rrtt as $rt) {
				
				$rt->activo = false;
				$rt->save();

				$dr = Detalle_Reserva::with('reserva')->findOrFail($rt->detalle_reserva_id);

				$dr->activo = false;
				$dr->au = Auth::user()->user_empresa->id;
				$dr->save();

				$reserva = Reserva::findOrFail($dr->reserva->id);

				$reserva->activo = false;
				$reserva->finalizada = true;
				$reserva->au = Auth::user()->user_empresa->id;

				$reserva->save();
			}

	  		return redirect()->route('fixture.show', $ct->id)
	  			->with('success', 'SE REPARTIERON LOS PUNTOS CORRESPONDIENTES Y EL TORNEO FINALIZO CON EXITO!');
		
		} catch (Exception $e) {
			return response()->view('errors.404', [], 404);
		}
	}

//------------------------------------------------------------------------------------------------

	public function fixture($id_ct){


		try {
			$ct = Categoria_Torneo::findOrFail($id_ct);
			
			$torneo = Torneo::findOrFail($ct->torneo_id);

			$partidos = Partido::with('detalle_partido', 'instancia')
						->where('categoria_torneo_id', $ct->id)->get()->reverse();
			

			if ($partidos->isEmpty()){

				$notificacion = array(
		            'message' => 'EL FIXTURE NO SE ENCUENTRA DISPONIBLE POR EL MOMENTO!', 
		            'alert-type' => 'info'
		        );
				return redirect()->back()->with($notificacion);
			}
			
			$c = Categoria::with('c_categoria', 'c_sexo', 'c_etario')->findOrFail($ct->categoria_id);
			$categoria = $c->c_etario->name .'-'. $c->c_sexo->name .'-'. $c->c_categoria->name; 
			
			return view('fixture.fixture', compact('partidos', 'torneo', 'categoria'));

		} catch (Exception $e) {
			return response()->view('errors.404', [], 404);
		}
		
	}

}
