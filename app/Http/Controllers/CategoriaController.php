<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoriaController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {

        return view('categoria.create');
    }

    public function store(Request $request)
    {

        try
        {
            $categoria = new Categoria();
            $categoria->nombre           	=$request->nombre;
            $categoria->descripcion      	=$request->descripcion;
			$categoria->imagen       		=$request->file('portada')->store('categoria');
	            
            $categoria->save();

            return redirect('/productos');
        }
        catch(Exception $e)
        {
            return "Fatal error - "-$e->getMessage();
        }
    }

}
