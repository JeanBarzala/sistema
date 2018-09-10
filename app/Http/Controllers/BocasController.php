<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;


use App\Boca;
use App\Caja;
use App\Talon;

class BocasController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$bocas = Boca::paginate(15);

    	return view('bocas.index', compact('bocas'));
    }


    public function create()
    {
    	
        $talones = Talon::all();
        $cajas = array_pluck(config('cms.pos'), 'name', 'id');
    	return view('bocas.create', compact('talones', 'cajas'));
    }

    public function edit($id)
    {
        $boca = Boca::find($id);
        $talones = Talon::all();
        $cajas = Caja::all()->pluck('descripcion_caja', 'id_caja');

        return view('bocas.edit', compact('boca', 'talones', 'cajas'));
    }
    public function update($id, Request $request)
    {
        $boca = Boca::find($id);
        $boca->numero_boca_facturacion = $request->numero_boca_facturacion;
        $boca->host_facturacion = $request->host_facturacion;
        $boca->tipo_impresora = $request->tipo_impresora;
        $boca->uri_print = $request->uri_print;
        $boca->estado_boca_facturacion = $request->estado_boca_facturacion;
        $boca->id_pos = $request->pos;
        $boca->id_talon = $request->talon;
        $boca->save();

        Session::flash('message', 'La boca ha sido actualizada.');

        return redirect()->back();
    }

    public function store(Request $request)
    {
        $boca = new Boca;
        $boca->numero_boca_facturacion = $request->numero_boca_facturacion;
        $boca->host_facturacion = $request->host_facturacion;
        $boca->tipo_impresora = $request->tipo_impresora;
        $boca->uri_print = $request->uri_print;
        $boca->id_pos = $request->pos;
        $boca->id_talon = $request->talon;
        $boca->estado_boca_facturacion = $request->estado_boca_facturacion;
        $boca->save();

        Session::flash('message', 'La boca ha sido creada.');

        return redirect()->back();
    }
}
