<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Equipo;
use App\Categoria;
use App\Inscripcion;
use App\User_Empresa_Equipo;

class EquipoController extends Controller
{

    public function index()
    {
        $equipos = Equipo::with('categoria')->get();

        return view('equipo.index', compact('equipos'));
    }


    public function create()
    {
        
        if (User_Empresa_Equipo::where('user_empresa_id', Auth::user()->user_empresa->id)->where('activo', 1)->first())
            return redirect()->back()->with('warning', 'Ya perteneces a un equipo!');
        
        $categorias = Categoria::with('c_categoria', 'c_etario', 'c_sexo')->get();
        
        return view ('equipo.create', compact('categorias'));
    }


    public function store(Request $req)
    {
        $this->validate($req,[
            'name'         => 'required|unique:equipos',
            'categoria_id' => 'required'
            ]);
        
        try {
           
            $equipo = new Equipo;

            $equipo->name         = strtoupper($req->name);
            $equipo->categoria_id = $req->categoria_id;
            $equipo->descripcion  = $req->descripcion;
            $equipo->activo       = 1;
            $equipo->save();

            $uee = new User_Empresa_Equipo();

            $uee->equipo_id        = $equipo->id;
            $uee->user_empresa_id = Auth::user()->user_empresa->id;
            $uee->save();

          return redirect()->route('miequipo.show', Auth::user()->user_empresa->id)
            ->with('success', 'El equipo se creo correctamente. Ya perteneces al mismo.!'); 

        } catch (Exception $e) {
            
        }
    }

    public function edit($id)
    {
        $inscripcion = Inscripcion::where('equipo_id', $id)
                        ->where('activo', 1)->first();
            
            if ($inscripcion)
                return redirect()->back()
                    ->with('warning', 'NO SE PUEDE EDITAR EL EQUIPO, EL MISMO SE ENCUENTRA INSCRIPTO A UN TORNEO!.');
        
        $equipo = Equipo::with('categoria')->findOrFail($id); 

        $categorias = Categoria::with('c_categoria', 'c_etario', 'c_sexo')->get();

        return view ('equipo.edit', compact('categorias', 'equipo'));
    }


    public function update(Request $req, $id)
    {
      
        try {

            $equipo = Equipo::findOrFail($id);

            $this->validate($req,[
                'name'  => 'required|string|unique:equipos,name,'.$equipo->id
            ]);

            $equipo->name         = strtoupper($req->name);
            $equipo->categoria_id = $req->categoria_id;
            $equipo->descripcion  = $req->descripcion;
            $equipo->save();

            return redirect()->route('miequipo.show', Auth::user()->user_empresa->id)
                ->with('success', 'LOS DATOS DEL EQUIPO SE MODIFICARON CON EXITO');
        } catch (Exception $e) {
            
        }

    }

    public function show($id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
