<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use App\Tarjeta;


class TarjetasController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $tarjetas = Tarjeta::where('es_tarjeta', 1)->where('deleted', 0)->paginate(15);
        
        
        return view('tarjetas.index', compact('tarjetas'));
    }

    public function create()
    {
    
        return view('tarjetas.create');
    }

    public function edit($id)
    {
        $tarjeta = Tarjeta::find($id);

        return view('tarjetas.edit', compact('tarjeta'));
    }

    public function store(Requests\StoreTarjetaRequest $request)
    {
        

        $tarjeta = new Tarjeta;
        $tarjeta->nombre_producto           =$request->nombre;
        $tarjeta->descripcion_producto      =$request->descripcion;
        $tarjeta->estado_producto           =$request->estado;
        $tarjeta->es_tarjeta                =1;
        $tarjeta->save();
        

        session()->flash('message', 'La tarjeta ha sido creada con éxito.');
        return redirect(route('tarjeta.edit', ['id' => $tarjeta->id_producto])); 
    }

    public function update(Requests\UpdateTarjetaRequest $request, $id)
    {
        $tarjeta = Tarjeta::find($id);
        $tarjeta->nombre_producto              =$request->nombre;
        $tarjeta->descripcion_producto         =$request->descripcion;
        $tarjeta->estado_producto              =$request->estado;
        $tarjeta->save();

        session()->flash('message', 'La tarjeta ha sido actualizada.');

        return redirect()->back();   

        //return view('clientes.index');

    }

    public function destroy($id)
    {

        $tarjeta = Tarjeta::find($id);
        $tarjeta->deleted = 1;
        $tarjeta->save();

        session()->flash('message', 'La tarjeta ha sido eliminada.');
        return redirect()->back();
    }
}
