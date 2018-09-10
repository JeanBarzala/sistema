<?php

namespace App\Http\Controllers;
use App\Gasto;
use Illuminate\Http\Request;

class GastosController extends Controller
{
    //

    public function index()
    {
    	$gastos = Gasto::paginate();
    	return view('gastos.index')->with('gastos', $gastos);
    }
}

