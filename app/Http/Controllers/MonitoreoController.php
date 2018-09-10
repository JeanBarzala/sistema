<?php

namespace App\Http\Controllers;

use App\Producto;
use App\Agrupador;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MonitoreoController extends Controller
{
    //

    public function index()
    {

    	$productoDeleted = Producto::where('estado_producto', 'ELIMINADO')->limit(30)->get();

    	$productoStock = Producto::whereNull('stock_actual')->limit(30)->get();

    	return view('monitoreo.index', compact('productoDeleted', 'productoStock'));
    }
}
