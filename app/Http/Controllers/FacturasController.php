<?php

namespace App\Http\Controllers;

use App\Factura;


use App\Http\Controllers\Session;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class FacturasController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function facturacion(Request $request)
    {
        $facturas = Factura::orderBy('id_factura', 'DESC')->paginate(15);
        return view('facturas.index', compact('facturas'));
    }
}
