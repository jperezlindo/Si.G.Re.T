<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

use Carbon\Carbon;
use PDF;
use App\Empresa;
use App\Ranking;
use App\Categoria;

class RankingController extends Controller
{

    public function index(Request $req)
    {
        
        $ranking = Ranking::where('categoria', $req->categoria_id)->get()->sortBy('puntos')->reverse();
        
        //if ($req->categoria_id)
        $categoria = Categoria::with('c_etario', 'c_sexo', 'c_categoria')->find($req->categoria_id);
        
        $posiciones = new Collection();

            foreach ($ranking as $rank) {
                $posiciones->push($rank);
            }
        
        if ($ranking->isEmpty() and $req->categoria_id){
           
           flash('LA CATEGORIA SELECCIONADA NO DISPONE DE UN RANKING, puede volver a seleccionar otra.')->error();
        }


        $categorias = Categoria::all();

        return view ('ranking.index', compact('posiciones', 'categoria','categorias'));
    }

    public function pdf_x_categoria(Request $req)
    {
        $emp     = Empresa::findOrFail($req->empresa_id);
        $fecha   = Carbon::now();
        $ranking = Ranking::where('categoria', $req->categoria_id)->get()->sortBy('puntos')->reverse();
        
        //if ($req->categoria_id)
        $categoria = Categoria::with('c_etario', 'c_sexo', 'c_categoria')->find($req->categoria_id);
        
        $posiciones = new Collection();

            foreach ($ranking as $rank) {
                $posiciones->push($rank);
            }

        if ($posiciones->isEmpty()){
            $notificacion = array(
                'message' => 'NO HAY RANKING!', 
                'alert-type' => 'danger'
            );

            return back()->with($notificacion);
        }

        //return view ('ranking.pdf_x_categoria', compact('posiciones','emp', 'fecha'));

        $pdf = PDF::loadView('ranking.pdf_x_categoria', [
            'posiciones' => $posiciones, 
            'emp'       => $emp,
            'fecha'     => $fecha
        ]);
        
        $pdf->setPaper('a4'); // , 'landscape' pone la hoja en horizontal

        return $pdf->stream();
    }  
}
