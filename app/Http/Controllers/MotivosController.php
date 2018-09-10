<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use App\Motivo;

class MotivosController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$motivos = Motivo::where('deleted', 0)->orderBy('id_motivo', 'DESC')->paginate(15);


    	return view('motivos.index', compact('motivos'));
    }

    public function create()
    {
    
    	return view('motivos.create');
    }

    public function edit($id)
    {
    	$motivo = Motivo::find($id);

    	return view('motivos.edit', compact('motivo'));
    }

    public function store(Requests\StoreMotivosRequest $request)
    {

    	$motivo = new Motivo;
        $motivo->nombre_motivo              =$request->nombre;
        $motivo->descripcion_motivo         =$request->descripcion;
        $motivo->estado_motivo              =$request->estado;
        $motivo->save();

    	session()->flash('message', 'El motivo ha sido creado con éxito.');
    	return redirect(route('motivos.edit', ['id' => $motivo->id_motivo])); 
    }

    public function update(Requests\UpdateMotivosRequest $request, $id)
    {
        $motivo = Motivo::find($id);
       	$motivo->nombre_motivo              =$request->nombre;
        $motivo->descripcion_motivo         =$request->descripcion;
        $motivo->estado_motivo              =$request->estado;
        $motivo->save();

        session()->flash('message', 'El motivo ha sido actualizado.');

        return redirect()->back();   

        //return view('clientes.index');

    }

    public function destroy($id)
    {

    	$motivo = Motivo::find($id);
    	$motivo->deleted = 1;
    	$motivo->save();

    	session()->flash('message', 'El motivo ha sido eliminado.');
    	return redirect()->back();
    }
}
