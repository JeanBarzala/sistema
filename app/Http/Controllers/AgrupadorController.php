<?php

namespace App\Http\Controllers;

use App\Agrupador;
use Illuminate\Http\Request;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class AgrupadorController extends Controller
{
    //


	public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$categorias = Agrupador::where('estado_agrupador', '!=', 'ELIMINADO')->orderBy('id_agrupador', 'DESC')->paginate(16);

    	return view('categoria.index')->with('categorias', $categorias);
    }

    public function create(Request $request)
    {
        
        return view('categoria.create');

    }

    public function edit($id)
    {

        $categoria = Agrupador::find($id);
        
        return view('categoria.edit')->with('categoria', $categoria);

    }

    public function store(Requests\StoreAgrupadorRequest $request)
    {


        try
        {
            if ($request->file('portada')) {
                $image = $request->file('portada')->store('agrupadores');
                $image = basename($image);
            }else
            {
                $image = '';
            }
            


            $categoria = new Agrupador();
            $categoria->nombre_agrupador           	=$request->nombre;
            $categoria->descripcion_agrupador      	=$request->descripcion;
			$categoria->portada_agrupador       	=$image;
            $categoria->estado_agrupador            =1;
	            
            $categoria->save();

            Session::flash('message', '¡Bien! La categoría ha sido creada'); 

            return redirect('/categorias/editar/'.$categoria->id_agrupador);
        }
        catch(Exception $e)
        {
            return "Fatal error - "-$e->getMessage();
        }
    }

}
