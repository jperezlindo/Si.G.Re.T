<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\TorneoCreateRequest;
use Illuminate\Support\Collection;

use Carbon\Carbon;

use PDF;
use Auth;
use App\Empresa;
use App\Torneo;
use App\Categoria;
use App\Cancha;
use App\Equipo;
use App\Partido;
use App\Tipo_Torneo;
use App\Inscripcion;
use App\Detalle_Reserva;
use App\Categoria_Torneo;
use App\Reserva_Torneo;

class TorneoController extends Controller
{

    public function __construct(){
        
        Carbon::setLocale('es');
    }

    public function index()
    {
       $torneos = Torneo::where('activo', 1)
        ->where('finalizado', 0)->where('em', Auth::user()->user_empresa->empresa_id)->get();
       
       return view ('torneo.index', compact('torneos'));
    }

//-------------------------------------------------------------------------------------------------------------

    public function create()
    {
        $tipos = Tipo_Torneo::all();

        return view('torneo.create', compact('tipos'));
    }

//-------------------------------------------------------------------------------------------------------------

    public function store(TorneoCreateRequest $req)
    {
        try {

            $reservass = Detalle_Reserva::where('fecha_reservada', '>=', $req->f_desde)
                                        ->where('fecha_reservada', '<=', $req->f_hasta)
                                        ->where('activo', 1)->get();
            
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

            if ($reservas->isEmpty())
                return redirect()->back()
                    ->with('danger', 'NO DISPONE DE RESERVAS PARA CREAR EL TORNEO, POR FAVOR GENERE LAS RESERVAS')->withInput();
            
            if ($req->f_desde > $req->f_hasta)
                return redirect()->back()
                    ->with('danger', 'LA FECHA DE INICIO DEL TORNEO DEBE SER IGUAL O MENOR A LA FECHA FINALIZACION..')->withInput();
            
            if ($req->ini_ins >= $req->f_desde)
                return redirect()->back()
                    ->with('danger', 'LA FECHA QUE SE ABREN LAS INSCRIPCIONES DEBE SER MENOR A LA FECHA INICIO DEL TORNEO.')->withInput();

            if ($req->fin_ins >= $req->f_desde)
                return redirect()->back()
                    ->with('danger', 'LA FECHA DEL CIERRE DE LAS INSCRIPCIONES DEBE SER MENOR A LA FECHA INICIO.')->withInput();
            
            if ($req->fin_ins < $req->ini_ins)
                return redirect()->back()
                    ->with('danger', 'LA FECHA DEL CIERRE DE LAS INSCRIPCIONES DEBE SER MAYOR A LA FECHA INICIO DE INSCRIPCION.')->withInput();

            $torneos = Torneo::where('activo', 1)->get();

            foreach ($torneos as $t) {
                if ($t->f_desde->format('Y-m-d') < $req->f_desde and $t->f_hasta->format('Y-m-d') > $req->f_desde)
                    return redirect()->back()->with('danger', 'EL TORNEO NO SE PUEDE CREAR EN LA FECHA SOLICITADA. YA HAY UN TORNEO ACTIVO ENTRE LAS FECHAS.')->withInput();
            }
            
            $torneo = new Torneo();

            $torneo->name               = strtoupper($req->name);
            $torneo->f_desde            = $req->f_desde;
            $torneo->f_hasta            = $req->f_hasta;
            $torneo->hora               = $req->hora;
            $torneo->ini_ins            = $req->ini_ins;
            $torneo->fin_ins            = $req->fin_ins;
            $torneo->tipo_torneo_id     = $req->tipo_torneo_id;
            $torneo->descripcion        = strtoupper($req->descripcion);
            $torneo->user_empresa_id    = Auth::user()->user_empresa->id;
            $torneo->em                 = Auth::user()->user_empresa->empresa_id;
            $torneo->au                 = Auth::user()->user_empresa->id;
            $torneo->save();


           return redirect()->route('reserva_torneo.create', $torneo->id);
        
        } catch (Exception $e) {    
            return response()->view('errors.404', [], 404);
        }
    }

//-------------------------------------------------------------------------------------------------------------

    public function edit($id)
    {
        
        
        $torneo = Torneo::with('tipo_torneo', 'categorias_torneo')->findOrFail($id);
        
        if (Carbon::now() >= $torneo->f_desde)
            return redirect()->back()->with('warning', 'EL TORNEO YA NO SE PUEDE EDITAR.');
        
        $tipos = Tipo_Torneo::all();

        return view ('torneo.edit', compact('torneo', 'tipos'));
    }

//-------------------------------------------------------------------------------------------------------------

    public function update(Request $req, $id)
    {
            $torneo = Torneo::findOrFail($id);
            
            $this->validate($req,[    
                'name'          => 'string|required|min:4|max:35|unique:torneos,name,'.$torneo->id,
                'f_desde'       => 'required',
                'f_hasta'       => 'required',
                'ini_ins'       => 'required',
                'fin_ins'       => 'required',
                'descripcion'   => 'required',
            ]);
            
        try {
            
            if ($req->f_desde > $req->f_hasta)
                return redirect()->back()
                    ->with('danger', 'LA FECHA DE INICIO DEL TORNEO DEBE SER IGUAL O MENOR A LA FECHA FINALIZACION..')->withInput();
            
            if ($req->ini_ins >= $req->f_desde)
                return redirect()->back()
                    ->with('danger', 'LA FECHA QUE SE ABREN LAS INSCRIPCIONES DEBE SER MENOR A LA FECHA INICIO DEL TORNEO.')->withInput();

            if ($req->fin_ins >= $req->f_desde)
                return redirect()->back()
                    ->with('danger', 'LA FECHA DEL CIERRE DE LAS INSCRIPCIONES DEBE SER MENOR A LA FECHA INICIO.')->withInput();
            
            if ($req->fin_ins < $req->ini_ins)
                return redirect()->back()
                    ->with('danger', 'LA FECHA DEL CIERRE DE LAS INSCRIPCIONES DEBE SER MAYOR A LA FECHA INICIO DE INSCRIPCION.')->withInput();

            $torneos = Torneo::where('activo', 1)->get();

            foreach ($torneos as $t) {
                if ($t->f_desde->format('Y-m-d') < $req->f_desde and $t->f_hasta->format('Y-m-d') > $req->f_desde)
                    return redirect()->back()->with('danger', 'EL TORNEO NO SE PUEDE CREAR EN LA FECHA SOLICITADA. YA HAY UN TORNEO ACTIVO ENTRE LAS FECHAS.')->withInput();
            }

            $torneo->name               = strtoupper($req->name);
            $torneo->f_desde            = $req->f_desde;
            $torneo->f_hasta            = $req->f_hasta;
            $torneo->hora               = $req->hora;
            $torneo->ini_ins            = $req->ini_ins;
            $torneo->fin_ins            = $req->fin_ins;
            $torneo->tipo_torneo_id     = $req->tipo_torneo_id;
            $torneo->descripcion        = strtoupper($req->descripcion);
            $torneo->au                 = Auth::user()->user_empresa->id;

            $torneo->save();

            return redirect()->route('torneo.edit', $torneo->id)
                             ->with('success', 'LOS DATOS DEL TORNEO SE MODIFICARON CON EXITO!!!');
            
        } catch (Exception $e) {
            return response()->view('errors.404', [], 404);
        }
    }
//-------------------------------------------------------------------------------------------------------------

    public function show($id)
    {
        
        $torneo = Torneo::findOrFail($id);
        $agregadas = Categoria_Torneo::with('categoria')->where('torneo_id', $id)->where('activo', 1)->get();
        
        foreach ($agregadas as $agre) {
            $ins = Inscripcion::where('categoria_torneo_id', $agre->id)->where('activo', 1)->get();
            $agre = array_add($agre, 'ins', $ins->count());

        }


        return view ('torneo.show', compact('torneo', 'agregadas'));

    }

//-------------------------------------------------------------------------------------------------------------

    public function show_end($id)
    {
        
        $torneo = Torneo::findOrFail($id);
        $agregadas = Categoria_Torneo::with('categoria')->where('torneo_id', $id)->get();
        
        foreach ($agregadas as $agre) {
            
            $insta = Partido::where('categoria_torneo_id', $agre->id)->first()->instancia_id;
            
            $partidos = Partido::where('categoria_torneo_id', $agre->id)->where('instancia_id', $insta)->get();
            
            $agre = array_add($agre, 'ins', $partidos->count() * 2);
            $ganador = Equipo::findOrFail(Categoria_Torneo::findOrFail($agre->id)->winn)->name;
            $agre = array_add($agre, 'ganador', $ganador);
            
            
            $posiciones = new Collection();
            
            $partidos = Partido::with('detalle_partido')
                        ->where('categoria_torneo_id', $agre->id)
                        ->get();

            foreach ($partidos as $partido) {
                
                $posicion = new Collection();
                
                if ($partido->instancia_id == 1){
                    foreach ($partido->detalle_partido as $dp) {
                        if ($dp->isWinn == 0){
                            $posicion->put('ins', 'SUBCAMPEON');
                            $posicion->put('eq', $dp->equipo->name);
                        }
                    }
                }

                if ($partido->instancia_id == 2){
                    foreach ($partido->detalle_partido as $dp) {
                        if ($dp->isWinn == 0){
                            $posicion->put('ins', 'SEMIFINALES');
                            $posicion->put('eq', $dp->equipo->name);
                        }
                    }
                }

                if ($partido->instancia_id == 3){
                    foreach ($partido->detalle_partido as $dp) {
                        if ($dp->isWinn == 0){
                            $posicion->put('ins', 'CUARTOS DE FINAL');
                            $posicion->put('eq', $dp->equipo->name);
                        }
                    }
                }

                if ($partido->instancia_id == 4){
                    foreach ($partido->detalle_partido as $dp) {
                        if ($dp->isWinn == 0){
                            $posicion->put('ins', 'OCTAVOS DE FINAL');
                            $posicion->put('eq', $dp->equipo->name);
                        }
                    }
                }

               if ($posicion->isNotEmpty())
                $posiciones->push($posicion);
            }

            $agre = array_add($agre, 'posiciones', $posiciones);



        }

        return view ('torneo.show_end', compact('torneo', 'agregadas'));

    }
//-------------------------------------------------------------------------------------------------------------
    
    public function confirmar(Request $req)
    {
        
        try {
            
            if (Categoria_Torneo::where('torneo_id', $req->torneo_id)->get()->isEmpty())
                return back()->with('danger', 'EL TORNEO NO SE PUEDE CONFIRMAR SIN CATEGORIAS PARTICIPANTES');
            
            if (Reserva_Torneo::where('torneo_id', $req->torneo_id)->get()->isEmpty())
                return back()->with('danger', 'EL TORNEO NO SE PUEDE CONFIRMAR SIN RESERVAS ASOCIADAS');

            $torneo = Torneo::findOrFail($req->torneo_id);

            $torneo->activo = true;
            $torneo->save();

            return redirect()->route('torneo.index')
                ->with('success', 'El TORNEO ' . $torneo->name . ' SE CREO CON EXITO!!!');

        } catch (Exception $e) {
            return response()->view('errors.404', [], 404);
        }

    }
//-------------------------------------------------------------------------------------------------------------

    public function finalizados()
    {
       $torneos = Torneo::where('activo', 0)
        ->where('finalizado', 1)->get();
       
       return view ('torneo.finalizados', compact('torneos'));
    }

//-------------------------------------------------------------------------------------------------------------
    
    public function destroy($id)
    {
        
        try {


            $torneo = Torneo::with('categorias_torneo')->findOrFail($id);

            foreach ($torneo->categorias_torneo as $ct) {
                
                $partidos = Partido::where('categoria_torneo_id', $ct->id)->get();

                if ($partidos->isNotEmpty())
                    return redirect()->back()
                        ->with('warning','EL TORNEO NO SE PUEDE ANULAR CON PARTIDOS ARMADOS ');
            }

            foreach ($torneo->categorias_torneo as $ct) {
                
                $inscripciones = Inscripcion::where('categoria_torneo_id', $ct->id)->where('activo', 1)->get();

                foreach ($inscripciones as $ins) {
                    $ins->activo = false;
                    $ins->au     = Auth::user()->user_empresa->id;
                    $ins->save();
                }
            }

            $torneo->activo = false;
            $torneo->au     = Auth::user()->user_empresa->id;
            $torneo->save();

            $rrtt = Reserva_Torneo::where('torneo_id', $torneo->id)->get();

            foreach ($rrtt as $rt) {
                $rt->delete();
            }

            return redirect()->route('torneo.index')
                ->with('success', 'El TORNEO SE ANULO CON EXITO!!!');

        } catch (Exception $e) {
            return response()->view('errors.404', [], 404);
        }

    }
//-------------------------------------------------------------------------------------------------------------
    
    public function create_cat($id_torneo)
    {

        $torneo = Torneo::findOrFail($id_torneo);
        $categorias = Categoria::with('c_categoria', 'c_etario', 'c_sexo')->get();
        $agregadas = Categoria_Torneo::with('categoria')->where('torneo_id', $torneo->id)->get();
        
        return view('torneo.create_cat', compact ('categorias', 'agregadas','torneo'));
    }

//-------------------------------------------------------------------------------------------------------------
    
    public function edit_cat($id_torneo)
    {

        $torneo = Torneo::findOrFail($id_torneo);
        $categorias = Categoria::with('c_categoria', 'c_etario', 'c_sexo')->get();
        $agregadas = Categoria_Torneo::with('categoria')->where('torneo_id', $torneo->id)->get();
        
        
        return view('torneo.edit_cat', compact ('categorias', 'agregadas','torneo'));
    }
//-------------------------------------------------------------------------------------------------------------
    
    public function store_cat(Request $req)
    {

        try {
            
            $existe = Categoria_Torneo::where('torneo_id', $req->torneo_id)
                    ->where('categoria_id', $req->categoria_id)->first();
            
            if (!$existe){
                $ct = new Categoria_Torneo();

                $ct->n_ptes       = $req->n_ptes;
                $ct->valor        = $req->valor;
                $ct->cupo         = $req->cupo;
                $ct->campeon      = $req->campeon;
                $ct->subcampeon   = $req->subcampeon;
                $ct->semifinal    = $req->semifinal;
                $ct->cuartos      = $req->cuartos;
                $ct->octavos      = $req->octavos;
                $ct->descripcion  = $req->descripcion;
                $ct->au           = Auth::user()->user_empresa->id;
                $ct->categoria_id = $req->categoria_id;
                $ct->torneo_id    = $req->torneo_id;
                $ct->descripcion  = $req->descripcion;

                $ct->save();

                $notificacion = array(
                    'message' => 'LA CATEGORIA SE AGREGO CON EXITO!', 
                    'alert-type' => 'success'
                );
            }else{
                $notificacion = array(
                    'message' => 'LA CATEGORIA YA SE ENCUENTRA ASOCIADA!', 
                    'alert-type' => 'danger'
                );
            } 

            if ($req->editar)
                return redirect()->route('torneo.edit_cat', $req->torneo_id)->with($notificacion);
            
            return redirect()->route('torneo.create_cat', $req->torneo_id)->with($notificacion);

        } catch (Exception $e) {
            return response()->view('errors.404', [], 404);
        }
    }


//-------------------------------------------------------------------------------------------------------------

    public function editar_cat($id)
    {
        $inscripciones = Inscripcion::where('categoria_torneo_id', $id)->where('activo', 1)->get();

        if ($inscripciones->isNotEmpty()){
                $notificacion = array(
                    'message' => 'LA CATEGORIA NO SE PUEDE EDITAR. TIENE INSCRIPCIONES ACTIVAS', 
                    'alert-type' => 'warning'
                );
            return redirect()->back()->with($notificacion);
        }

        $categoria = Categoria_Torneo::with('categoria')->findOrFail($id);
        $categorias = Categoria::with('c_categoria', 'c_etario', 'c_sexo')->get();

        return view('torneo.update_cat', compact('categoria', 'categorias'));
    }

//-------------------------------------------------------------------------------------------------------------

    public function update_cat(Request $req)
    {
        

        $this->validate($req,[    
                'n_ptes'      => 'required',
                'valor'       => 'required',
                'cupo'        => 'required',
                'campeon'     => 'required',
                'subcampeon'  => 'required',
                'semifinal'   => 'required',
                'cuartos'     => 'required',
                'octavos'     => 'required',
            ]);
        
        try {
            
            $ct = Categoria_Torneo::findOrFail($req->categoria_torneo_id);


            $ct->n_ptes       = $req->n_ptes;
            $ct->valor        = $req->valor;
            $ct->cupo         = $req->cupo;
            $ct->campeon      = $req->campeon;
            $ct->subcampeon   = $req->subcampeon;
            $ct->semifinal    = $req->semifinal;
            $ct->cuartos      = $req->cuartos;
            $ct->octavos      = $req->octavos;
            $ct->descripcion  = $req->descripcion;
            $ct->au           = Auth::user()->user_empresa->id;
            $ct->categoria_id = $req->categoria_id;
            $ct->torneo_id    = $req->torneo_id;

            $ct->save();

            $notificacion = 'LOS DATOS SE MODIFICARON CON EXITO!';

            return redirect()->route('torneo.edit_cat', $ct->torneo_id)->with('success',$notificacion);

        } catch (Exception $e) {
            //dd($e);
            return response()->view('errors.404', [], 404);
        }
    }

//-------------------------------------------------------------------------------------------------------------
    
    public function destroy_cat(Request $req)
    {

        if (Categoria_Torneo::where('torneo_id', $req->torneo_id)->get()->count() == 1){
            $notificacion = array(
                'message' => 'DEBE AGREGAR UNA NUEVA CATEGORIA PARTICIPANTE PARA PODER ELIMINAR LA ACTUAL!', 
                'alert-type' => 'danger'
            );
            return redirect()->back()->with($notificacion);
        }


        $ct = Categoria_Torneo::findOrFail($req->categoria_id);
        
        $inscripciones = Inscripcion::where('categoria_torneo_id', $ct->id)->where('activo', 1)->get();

        if ($inscripciones->isNotEmpty()){
            $notificacion = array(
                'message' => 'LA CATEGORIA NO SE PUEDE QUITAR. TIENE INSCRIPCIONES ACTIVAS', 
                'alert-type' => 'warning'
            );
            return redirect()->back()->with($notificacion);
        }
        
        $ct->delete();

        $notificacion = array(
            'message' => 'LA CATEGORIA SE QUITO CON EXITO!', 
            'alert-type' => 'warning'
        );

        if ($req->editar)
            return redirect()->route('torneo.edit_cat', $req->torneo_id)->with($notificacion); 

        return redirect()->route('torneo.create_cat', $req->torneo_id)->with($notificacion);
    }

    public function torneo_pdf ($idt, $idct)
    {
        
        $torneo    = Torneo::findOrFail($idt);
        $categoria = Categoria_Torneo::findOrFail($idct);
        $emp       = Empresa::findOrFail($torneo->em);
        $fecha     = Carbon::now();

        $partidos = Partido::with('detalle_partido')->where('categoria_torneo_id', $idct)->get();

        $posiciones = new Collection();

        foreach ($partidos as $partido) {
            $posicion = new Collection();
           
            if ($partido->instancia_id == 1){
                foreach ($partido->detalle_partido as $dp) {
                    
                    if ($dp->isWinn == 1){
                        $posicion = new Collection();
                        $posicion->put('pos', 'CAMPEON');
                        $posicion->put('equ', $dp->equipo->name);
                        $posicion->put('pts', $categoria->campeon);
                        $posiciones->push($posicion);
                    }

                    if ($dp->isWinn == 0){
                        $posicion = new Collection();
                        $posicion->put('pos', 'SUBCAMPEON');
                        $posicion->put('equ', $dp->equipo->name);
                        $posicion->put('pts', $categoria->subcampeon);
                        $posiciones->push($posicion);
                    }
                    
                }

            }
           
            if ($partido->instancia_id == 2){
                foreach ($partido->detalle_partido as $dp) {
                    if ($dp->isWinn == 0){
                        $posicion->put('pos', 'SEMIFINALES');
                        $posicion->put('equ', $dp->equipo->name);
                        $posicion->put('pts', $categoria->semifinal);
                        $posiciones->push($posicion);
                    }
                }
            }

            if ($partido->instancia_id == 3){
                foreach ($partido->detalle_partido as $dp) {
                    if ($dp->isWinn == 0){
                        $posicion->put('pos', 'CUARTOS DE FINAL');
                        $posicion->put('equ', $dp->equipo->name);
                        $posicion->put('pts', $categoria->cuartos);
                        $posiciones->push($posicion);
                    }
                }
            }

            if ($partido->instancia_id == 4){
                foreach ($partido->detalle_partido as $dp) {
                    if ($dp->isWinn == 0){
                        $posicion->put('pos', 'OCTAVOS DE FINAL');
                        $posicion->put('equ', $dp->equipo->name);
                        $posicion->put('pts', $categoria->octavos);
                        $posiciones->push($posicion);
                    }
                }
            }
        }
        
        $posiciones = $posiciones->sortByDesc('pts');
        //return view('torneo.pdf.torneo_pdf', compact( 'emp', 'fecha', 'torneo', 'categoria', 'posiciones'));

        $pdf = PDF::loadView('torneo.pdf.torneo_pdf', [
            'posiciones' => $posiciones,
            'torneo' => $torneo,
            'categoria' => $categoria,
            'emp'    => $emp,
            'fecha'  => $fecha
        ]);
        
        $pdf->setPaper('a4'); // , 'landscape' pone la hoja en horizontal

        return $pdf->stream();
    }
}
