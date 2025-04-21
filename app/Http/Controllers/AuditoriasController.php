<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

use PDF;
use Carbon\Carbon;
use App\Auditoria;
use App\User;
use App\Empresa;
use App\User_Empresa;
use App\Detalle_Reserva;
use App\Torneo;

class AuditoriasController extends Controller
{

//---------------------AUDITORIA PARA TORNEO-----------------------------------------------------------------------------
    public function empresa()
    {
        
        $tabla = 'empresas';
        $auditorias = DB::table('auditorias')->where('tabla', $tabla)->get()->reverse();

        
        $movimientos = new Collection();

        foreach ($auditorias as $m) {
			$movimiento = new Collection();
			
			$user       = User::findOrFail(User_Empresa::findOrFail($m->user_empresa)->user_id);

        	$movimiento->put('u', $user->name);
        	$movimiento->put('n', $m->old_data[0]);
            $movimiento->put('m', $m);

        	$movimientos->push($movimiento);

        }
		
        return view ('auditorias.empresa.empresa', compact('tabla', 'movimientos'));
    }

    public function empresa_movimiento($id)
    {

    	$tabla = 'empresas';
    	$auditoria = DB::table('auditorias')->where('id', $id)->first();
    	
        $user  = User::findOrFail(User_Empresa::findOrFail($auditoria->user_empresa)->user_id);

        $n_d   = explode("|s.g.r.t|", $auditoria->new_data);
        $o_d   = explode("|s.g.r.t|", $auditoria->old_data);


        $new_data = new Collection();
        $old_data = new Collection();
        for ($i=0; $i <= (count($n_d) - 1) ; $i+=2)
        { 
            $new_data->put($n_d[$i], $n_d[$i + 1]);
            $old_data->put($o_d[$i], $o_d[$i + 1]); 
        }
        
        //dd($old_data, $new_data);
		return view('auditorias.empresa.empresa_movimiento', compact('auditoria', 'old_data', 'new_data', 'tabla', 'user'));

    }

    public function empresa_movimiento_pdf($id)
    {
        
        $tabla     = 'empresas';
        $auditoria = DB::table('auditorias')->where('id', $id)->first();
        $user      = User::findOrFail(User_Empresa::findOrFail($auditoria->user_empresa)->user_id);
        $emp       = Empresa::findOrFail(User_Empresa::findOrFail($auditoria->user_empresa)->empresa_id);
        $fecha     = Carbon::now();

        $n_d   = explode("|s.g.r.t|", $auditoria->new_data);
        $o_d   = explode("|s.g.r.t|", $auditoria->old_data);


        $new_data = new Collection();
        $old_data = new Collection();
        for ($i=0; $i <= (count($n_d) - 1) ; $i+=2)
        { 
            $new_data->put($n_d[$i], $n_d[$i + 1]);
            $old_data->put($o_d[$i], $o_d[$i + 1]); 
        }
        //dd($old_data, $new_data);

        //return view('auditorias.empresa.pdf', compact('auditoria', 'old_data', 'new_data', 'tabla', 'user', 'emp', 'fecha'));

        $pdf = PDF::loadView('auditorias.empresa.pdf', [
            'auditoria' => $auditoria, 
            'old_data'  => $old_data,
            'new_data'  => $new_data,
            'tabla'     => $tabla,
            'user'      => $user,
            'emp'       => $emp,
            'fecha'     => $fecha
        ]);
        
        $pdf->setPaper('a4'); // , 'landscape' pone la hoja en horizontal

        return $pdf->stream();
    }



//---------------------AUDITORIA GENERICO-----------------------------------------------------------------------------

    public function index (Request $req)
    {
        
        $movimientos = Auditoria::buscar($req->buscar)->orderBy('id','DESC')->paginate(30);

        //$movimientos = $movimiento->reverse();
        return view ('auditorias.index', compact('movimientos'));
    }

    public function show ($id)
    {
        $movi = DB::table('auditorias')->where('id', $id)->first();
        $user = User::findOrFail(User_Empresa::findOrFail($movi->user_empresa)->user_id);

        $n_d   = explode("|s.g.r.t|", $movi->new_data);
        $o_d   = explode("|s.g.r.t|", $movi->old_data);

        //dd($n_d, $o_d);
        $new_data = new Collection();
        $old_data = new Collection();
        for ($i=0; $i <= (count($n_d) - 1) ; $i+=2)
        { 
            $new_data->put($n_d[$i], $n_d[$i + 1]);
            $old_data->put($o_d[$i], $o_d[$i + 1]); 
        }
            
        return view ('auditorias.show', compact('movi', 'user', 'new_data', 'old_data'));
    }

    public function pdf($id)
    {
        $tabla     = 'empresas';
        $auditoria = DB::table('auditorias')->where('id', $id)->first();
        $user      = User::findOrFail(User_Empresa::findOrFail($auditoria->user_empresa)->user_id);
        $emp       = Empresa::findOrFail(User_Empresa::findOrFail($auditoria->user_empresa)->empresa_id);
        $fecha     = Carbon::now();

        $n_d   = explode("|s.g.r.t|", $auditoria->new_data);
        $o_d   = explode("|s.g.r.t|", $auditoria->old_data);


        $new_data = new Collection();
        $old_data = new Collection();
        for ($i=0; $i <= (count($n_d) - 1) ; $i+=2)
        { 
            $new_data->put($n_d[$i], $n_d[$i + 1]);
            $old_data->put($o_d[$i], $o_d[$i + 1]); 
        }
        
        $datos = new Collection();
        foreach ($new_data as $key => $value) {
            $dato = new Collection();
            $dato->put(0, $key);
            $dato->put(1, $value);
            $dato->put(2, $old_data[$key]);

            $datos->push($dato);
        }

        //dd($datos[0]);

        //return view('auditorias.pdf', compact('auditoria', 'old_data', 'new_data', 'tabla', 'user', 'emp', 'fecha', 'datos'));

        $pdf = PDF::loadView('auditorias.pdf', [
            'auditoria' => $auditoria, 
            'datos'  => $datos,
            //'tabla'     => $tabla,
            'user'      => $user,
            'emp'       => $emp,
            'fecha'     => $fecha
        ]);
        
        $pdf->setPaper('a4'); // , 'landscape' pone la hoja en horizontal

        return $pdf->stream();
    }

}



/*
//---------------------AUDITORIA PARA TORNEO-----------------------------------------------------------------------------

    public function torneo()
    {
        
        $auditorias = DB::table('auditorias')->where('tabla', 'torneos')->get()->reverse();

        
        $movimientos = new Collection();

        foreach ($auditorias as $m) {
            $movimiento = new Collection();
            
            $user       = User::findOrFail(User_Empresa::findOrFail($m->user_empresa)->user_id);

            $movimiento->put('u', $user->name);
            $movimiento->put('n', $m->old_data[0]);
            $movimiento->put('m', $m);

            $movimientos->push($movimiento);

        }
        
        return view ('auditorias.torneo.torneo', compact('movimientos'));
    }

    public function torneo_movimiento($id)
    {
        
        $auditoria = DB::table('auditorias')->where('id', $id)->first();
        $user       = User::findOrFail(User_Empresa::findOrFail($auditoria->user_empresa)->user_id);

        $old_data   = explode("|s.g.r.t|", $auditoria->old_data);
        $new_data   = Torneo::findOrFail($old_data[0]);

        return view('auditorias.torneo.torneo_movimiento', compact('auditoria', 'old_data', 'new_data', 'user'));

    }

    public function torneo_movimiento_pdf($id)
    {
        
        $auditoria = DB::table('auditorias')->where('id', $id)->first();
        $user      = User::findOrFail(User_Empresa::findOrFail($auditoria->user_empresa)->user_id);
        $emp       = Empresa::findOrFail(User_Empresa::findOrFail($auditoria->user_empresa)->empresa_id);
        $fecha     = Carbon::now();

        $old_data  = explode("|s.g.r.t|", $auditoria->old_data);
        $new_data  = Torneo::findOrFail($old_data[0]);

        //return view('auditorias.empresa.pdf', compact('auditoria', 'old_data', 'new_data', 'tabla', 'user', 'emp', 'fecha'));

        $pdf = PDF::loadView('auditorias.torneo.pdf', [
            'auditoria' => $auditoria, 
            'old_data'  => $old_data,
            'new_data'  => $new_data,
            'user'      => $user,
            'emp'       => $emp,
            'fecha'     => $fecha
        ]);
        
        $pdf->setPaper('a4'); // , 'landscape' pone la hoja en horizontal

        return $pdf->stream();
    }


//---------------------AUDITORIA PARA RERESERVAS-----------------------------------------------------------------------------

    public function reserva()
    {
        
        $auditorias = DB::table('auditorias')->where('tabla', 'detalles_reserva')->get()->reverse();

        
        $movimientos = new Collection();

        foreach ($auditorias as $m) {
            $movimiento = new Collection();
            
            $user       = User::findOrFail(User_Empresa::findOrFail($m->user_empresa)->user_id);

            $movimiento->put('u', $user->name);
            $movimiento->put('n', $m->old_data[0]);
            $movimiento->put('m', $m);

            $movimientos->push($movimiento);

        }
        
        return view ('auditorias.reserva.reserva', compact('movimientos'));
    }

    public function reserva_movimiento($id)
    {
        
        $auditoria = DB::table('auditorias')->where('id', $id)->first();
        $user      = User::findOrFail(User_Empresa::findOrFail($auditoria->user_empresa)->user_id);

        $old_data   = explode("|s.g.r.t|", $auditoria->old_data);
        $new_data   = Detalle_Reserva::findOrFail($old_data[0]);

        return view('auditorias.reserva.reserva_movimiento', compact('auditoria', 'old_data', 'new_data', 'user'));

    }

    public function reserva_movimiento_pdf($id)
    {
        
        $auditoria = DB::table('auditorias')->where('id', $id)->first();
        $user      = User::findOrFail(User_Empresa::findOrFail($auditoria->user_empresa)->user_id);
        $emp       = Empresa::findOrFail(User_Empresa::findOrFail($auditoria->user_empresa)->empresa_id);
        $fecha     = Carbon::now();

        $old_data  = explode("|s.g.r.t|", $auditoria->old_data);
        $new_data  = Detalle_Reserva::findOrFail($old_data[0]);

        //return view('auditorias.empresa.pdf', compact('auditoria', 'old_data', 'new_data', 'tabla', 'user', 'emp', 'fecha'));

        $pdf = PDF::loadView('auditorias.reserva.pdf', [
            'auditoria' => $auditoria, 
            'old_data'  => $old_data,
            'new_data'  => $new_data,
            'user'      => $user,
            'emp'       => $emp,
            'fecha'     => $fecha
        ]);
        
        $pdf->setPaper('a4'); // , 'landscape' pone la hoja en horizontal

        return $pdf->stream();
    }
*/