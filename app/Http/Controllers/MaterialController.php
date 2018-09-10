<?php

namespace App\Http\Controllers;
use App\Material;
use App\UnidadMedida;
use Illuminate\Http\Request;




class MaterialController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    private $request;
    private $materiales;
    private $medida;
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        //$materiales = Material::paginate();

        //$materiales = App\Material::all();

        //$materiales = Material::with('medida')->all();
        $materiales = Material::with('medida')->get();
       // $materiales = Material::all();
        



        //return view('clientes.index', compact('clientes'));
        //return view('materiales.index')->with('materiales', $materiales);
        return view('materiales.index', compact('materiales'));

    }

    public function create()
    {  
        $medidas = UnidadMedida::all();
        return view('materiales.create', compact('medidas'));

        //return view('auth.login');
    }

    public function store(Request $request)
    {

        try
        {
            $material = new Material();
            $material->nombre       =$request->nombre;
            $material->precio     =$request->precio;
            $material->unidad_medida =$request->unidadmedida;
            $material->save();

            return redirect('/materiales');
        }
        catch(Exception $e)
        {
            return "Fatal error - "-$e->getMessage();
        }
    }


}
