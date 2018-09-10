<?php

namespace App\Http\Controllers;

use App\Caja;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Session;

class CajasController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $cajas = Caja::orderBy('id_caja', 'DESC')->paginate(15);

        return view('cajas.index', compact('cajas'));
    }

    public function edit($id)
    {

        $caja = Caja::find($id);

        return view('cajas.edit', compact('caja'));
    }

    public function create()
    {


        return view('cajas.create');
    }

    public function update(Request $request, $id)
    {

        $caja = Caja::find($id);
        $caja->descripcion_caja = $request->descripcion_caja;
        $caja->estado_caja = $request->estado_caja;
        $caja->save();

		Session::flash('message', '¡Bien! La caja ha sido actualizada.');

        return view('cajas.edit', compact('caja'));
    }

    public function store(Requests\StoreCajasRequest $request)
    {
    	$date =  Carbon::today()->format('Y-m-d h:m:s');

        $caja = new Caja;
        $caja->descripcion_caja = $request->descripcion_caja;
        $caja->fecha_registro_caja = $date;
        $caja->estado_caja = $request->estado_caja;
        $caja->save();

		Session::flash('message', '¡Bien! La caja ha sido actualizada.');

        return view('cajas.edit', compact('caja'));
    }
}
