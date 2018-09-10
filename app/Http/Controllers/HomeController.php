<?php

namespace App\Http\Controllers;
use App\Venta;
use App\Producto;
use App\Persona;
use App\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $producto;
    private $venta;


    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$request->user()->authorizeRoles(['user', 'GERENTE']);

        $productos = Producto::where('estado_producto', 1)->where('es_tarjeta', 0)->limit('5')->orderBy('id_producto', 'desc')->get();

        $desde = Carbon::today()->addDays(-5);

        $today = Carbon::today();
        
        $hoy = $today->format('m/d');
        
        $desdeCompleto = $desde->format('m/d');
        
        $desdeDia = $desde->format('d');

        $hastaCompleto = $today->format('m/d');
        
        $hastaDia = $today->format('d');
        //$today->addYears(5);

        //$total = DB::table('comprobantes')->sum('total');

        $prueba = Carbon::create(2010, 9, 23);
        $prueba = $prueba->format('Y/m/d');

        //$pedidos = Pedido::where('fecha_hora_registro_recibe_pedido', $hoy)->count();

        $pedidos = DB::select(DB::raw('SELECT * FROM pedidos WHERE DATE_FORMAT(fecha_hora_registro_recibe_pedido, "y/%m/%d") = DATE_FORMAT("'.$hoy.'",  "y/%m/%d")'));
        $pedidos = count($pedidos);

        //$aniversario = DB::select(DB::raw('SELECT * FROM personas WHERE estado_persona = 1 AND DATE_FORMAT(fecha_ncto_persona, "%m/%d") BETWEEN "'.$desdeCompleto.'" AND "'.$hastaCompleto.'"  LIMIT 15'));
        $aniversario = [];

        $pedidosTotal = DB::table('pedidos')->count();
        
        $clientesTotal = DB::table('clientes')->count();
        
        $pedidosSum = DB::table('pedidos')->where('estado_pedido', 'COBRADO')->sum('total_importe_pedido');
        
        $ultimos = Pedido::orderBy('id_pedido', 'DESC')->take(10)->get();



        return view('dashboard', compact('productos', 'desde', 'hoy', 'aniversario', 'desdeMes', 'desdeDia', 'hastaMes', 'hastaDia', 'pedidos', 'desdeCompleto', 'hastaCompleto', 'pedidosTotal', 'clientesTotal', 'pedidosSum', 'ultimos'));
    }
}
