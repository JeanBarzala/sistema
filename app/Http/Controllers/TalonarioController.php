<?php

namespace App\Http\Controllers;
use App\Talon;

use Illuminate\Http\Request;
use App\Http\Requests;
use Session;

class TalonarioController extends Controller
{
    //

    public function index()
    {

    	$talonarios = Talon::orderBy('id_talon', 'DESC')->paginate(15);

    	return view('talonarios.index', compact('talonarios'));
    }

    public function create()
    {

        return view('talonarios.create');
    }

    public function edit($id)
    {

    	$talon = Talon::find($id);


    	return view('talonarios.edit', compact('talon'));
    }

    public function store(Requests\StoreTalonariosRequest $request)
    {

        $talon = new Talon;
        $talon->serie_talon = $request->serie_talon;
        $talon->nro_inicio_talon = $request->nro_inicio_talon;;
        $talon->nro_final_talon = $request->nro_final_talon;
        $talon->timbrado_talon = $request->timbrado_talon;
        $talon->fecha_vencimiento_talon = $request->fecha_vencimiento_talon;
        $talon->tipo_talon = $request->tipo_talon;
        $talon->save();
        
        Session::flash('message', 'El talonario ha sido creado correctamente.');
        return redirect(route('talonarios.index'));
    }

    public function update($id, Request $request)
    {
        $talon = Talon::find($id);
        $talon->serie_talon = $request->serie_talon;
        $talon->nro_inicio_talon = $request->nro_inicio_talon;;
        $talon->nro_final_talon = $request->nro_final_talon;
        $talon->timbrado_talon = $request->timbrado_talon;
        $talon->fecha_vencimiento_talon = $request->fecha_vencimiento_talon;
        $talon->tipo_talon = $request->tipo_talon;
        $talon->save();
        
        Session::flash('message', 'El talonario ha sido actualizado correctamente.');
        return view('talonarios.edit', compact('talon'));
    }
}
