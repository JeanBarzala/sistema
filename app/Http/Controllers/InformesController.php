<?php

namespace App\Http\Controllers;

use App\Pedido;

use Illuminate\Http\Request;


class InformesController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function pedido($id, Request $request)
    {
    	$pedido = Pedido::find($id);
    	return view('pdf.informe_pedido', compact('pedido'));
    }
}
