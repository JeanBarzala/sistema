<?php

namespace App\Http\Controllers;
use App\Pedido;

use Illuminate\Http\Request;

class CobrosController extends Controller
{
    //
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$cobros = Pedido::where('estado_pedido', 'A PAGAR')->paginate(15);

    	return view('cobros.index', compact('cobros'));
    }

    public function consultar(Request $request)
    {
    	$cobros = Pedido::where('estado_pedido', 'A PAGAR')->paginate(15);
    	if ($request->id_cliente AND empty($request->nro_pedido)) {
    		$cobros = Pedido::where('estado_pedido', 'A PAGAR')->where('id_cliente', $request->id_cliente)->paginate(15);
    	}
    	if ($request->nro_pedido AND empty($request->id_cliente)) {
    		$cobros = Pedido::where('estado_pedido', 'A PAGAR')->where('id_pedido', $request->nro_pedido)->paginate(15);
    	}
    	if ($request->desde AND $request->hasta AND empty($request->nro_pedido)) {
    		$cobros = Pedido::where('estado_pedido', 'A PAGAR')->whereDate('fecha_hora_cobro_pedido', '>=', $request->desde)->whereDate('fecha_hora_cobro_pedido', '<=', $request->hasta)->paginate(15);
    	}
    	
    	$request->flash();

    	return view('cobros.index', compact('cobros'));
    }
}
