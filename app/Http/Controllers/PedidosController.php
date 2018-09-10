<?php

namespace App\Http\Controllers;

use Auth;

use App\Pedido;
use App\Producto;
use App\Empresa;
use App\PedidoDetalle;
use App\Agrupador;
use App\Motivo;
use App\Persona;
use App\Direccion;
use App\Telefono;
use App\Factura;
use App\Remision;
use App\EstadoCivil;
use App\MovimientoCaja;
use App\Talon;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Permission;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Session;
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;
use Illuminate\Http\Response;
use App\Http\Requests;


class PedidosController extends Controller
{
    
    
    private $pedido;

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $pedidos = Pedido::orderBy('id_pedido', 'DESC')->paginate(15);
        /*$totalpedidos = Pedido::count();
        $totalgs = Pedido::where('estado_pedido', 'COBRADO')->sum('total_importe_pedido');
        $detalle = PedidoDetalle::all()->count('cantidad_detalle_pedido');     */

        return view('pedidos.index', compact('pedidos'));
    }
    public function create(Request $request)
    {

        $categorias = Agrupador::where('estado_agrupador', '1')->orderBy('nombre_agrupador', 'ASC')->get();      

        $productos = Producto::orderBy('id_producto', 'DESC')->paginate();
        $motivos = Motivo::all();
        $tarjetas  = Producto::where('es_tarjeta', 1)->get();
        $cajas = DB::table('cajas')->where('estado_caja', 'HABILITADA')->get();
        $estado_civil = EstadoCivil::all();

        return view('pedidos.create', compact('productos', 'categorias', 'motivos', 'tarjetas', 'cajas', 'estado_civil'));

    }

    public function cobrar(Request $request, $id_pedido = NULL)
    {

        /* primero verificamos que el usuario tenga una caja abierta */
        $user_caja = DB::table('estados_cajas')->where('id_usuario', \Auth::user()->id)->where('fecha_cierre_caja', NULL)->first();
        if (!$user_caja) {
            if($request->ajax())
            {
                $response = ['message' => 'No tienes caja abierta para el cobro.'];
                return response($response);
            }
            Session::flash('message', 'No tienes caja abierta para el cobro.');
            return redirect()->back();
        }
        $pedido = Pedido::find(11);
        
        if (!$pedido) {
            
            if($request->ajax())
            {
                $response = ['message' => 'No existe un pedido con este número de pedido.'];
                return response($response);
            }
            Session::flash('message', 'No existe un pedido con este número de pedido.');
            return redirect()->back();
        
        }
        if ($pedido->estado_pedido == 'COBRADO') {
            if($request->ajax())
            {
                $response = ['message' => 'Este pedido esta cobrado.'];
                return response($response);
            }
            Session::flash('message', 'Este pedido esta cobrado.');
            return redirect()->back();
        }

        $fecha_registro = Carbon::now();
        $forma_pago = [];
        foreach ($request['forma_pago'] as $clave=>$id) {
            $forma_pago[] = 
                [
                'forma_pago' => $request['forma_pago'][$clave],
                'monto_cobro' => $request['monto_cobro'][$clave]
                ];
            
        }
        $forma_pago_filtered = collect($forma_pago)->where('monto_cobro', '!=', NULL);


        if (!count(($forma_pago_filtered))) {
            if($request->ajax())
            {
                $response = ['message' => 'Debes ingresar un monto a cobrar.'];
                return response($response);
            }
            Session::flash('message', 'Debes ingresar un monto a cobrar.');
            return redirect()->back();
        }
        $total_recibido = $forma_pago_filtered->sum('monto_cobro');
        $total_cobro_pedido = NULL;
        $vuelto = NULL;
        $estado_pedido = 'A COBRAR';
        /* Si el total recibido es mayor al saldo pendiente del pedido hay vuelto y efectuamos la resta */
        if ($forma_pago_filtered->sum('monto_cobro') > $pedido->saldo_importe_pedido) {
            $vuelto = $forma_pago_filtered->sum('monto_cobro') - $pedido->saldo_importe_pedido;
        }
        /*
        if ($request->vuelto_cobrar) {
            $saldo_pedido_cobro = $forma_pago_filtered->sum('monto_cobro') - $request->vuelto_cobrar;
        }
        */
        /* Si el total recibido es menor al saldo pendiente del pedido es porque es un pago parcual y queda un saldo pendiente y el estado sigue siendo A PAGAR */
        if ($total_recibido < $pedido->saldo_importe_pedido) {
            $total_cobro_pedido = $pedido->saldo_importe_pedido - $total_recibido;
            $estado_pedido = 'A COBRAR';
        }
        /* si el total recibido es igual al saldo pendiente del pedido no queda saldo pendiente y el estado es COBRADO */
        if ($total_recibido == $pedido->saldo_importe_pedido) {
            $total_cobro_pedido = 0;
            $estado_pedido = 'COBRADO';
        }
        $pedido->saldo_importe_pedido = $total_cobro_pedido;
        $pedido->estado_pedido = $estado_pedido;
        $pedido->save();


        foreach ($forma_pago_filtered as $pago) {
            DB::table('movimientos_cajas')->insert(['id_pedido' => $id_pedido, 'monto_movimiento_caja' => $pago['monto_cobro'], 'concepto_movimiento_caja' => 'Cobro', 'modalidad_movimiento_caja' => $pago['forma_pago'], 'fecha_registro_movimiento_caja' => $fecha_registro, 'tipo_movimiento_caja' => 'INGRESO', 'id_estado_caja' => $user_caja->id_usuario]);
        }
        if ($vuelto) {
           DB::table('movimientos_cajas')->insert(['id_pedido' => $id_pedido, 'monto_movimiento_caja' => $request['vuelto_cobrar'], 'concepto_movimiento_caja' => 'Vuelto', 'modalidad_movimiento_caja' => 'EFECTIVO', 'fecha_registro_movimiento_caja' => $fecha_registro, 'tipo_movimiento_caja' => 'EGRESO', 'id_estado_caja' => $user_caja->id_usuario]);
        }

        if($request->ajax())
        {
            $response = ['message' => 'Cobro realizado con éxito, se ha cobrado '.$total_cobro_pedido];
            return response($response);
        }
        Session::flash('message', 'Cobro realizado con éxito, se ha cobrado '.$total_cobro_pedido);
        return redirect()->back();

    }

    public function store(Request $request)
    {   

        if (!$request['id_cliente']) {
            $response = ['message' => 'Debes seleccionar un cliente.'];
            return response($response);
        }
        if (!$request['id_motivo']) {
            $response = ['message' => 'Debes seleccionar un motivo.'];
            return response($response);
        }

        /* Primeramente validamos el detalle del carrito, si hay productos agregados */
        $id_producto = $request['id_producto'];
        $i = 0;
        if ($id_producto) {
            foreach ($request['id_producto'] as $clave=>$id) {
                $array_total[] = $request['price'][$clave] * $request['cantidad'][$clave];
            }
            $total = collect($array_total)->sum();
        }else
        {
            $response = ['message' => 'Aún no has agregado productos al detalle.'];
            return response($response);
        }

        $ahora =  Carbon::today()->format('Y-m-d h:m:s');
        // Tomo las solicitudes y alojo en una variable
        $estado_pedido          = 'A PAGAR';
        $observacion_pedido     = $request['pedido_observacion'] ? $request['pedido_observacion'] : NULL;
        $condicion_venta        = $request['condicion_venta'] ? $request['condicion_venta'] : NULL;

        $estado_toma_pedido     = 'PEDIDO';
        $estado_envio_pedido    = NULL;
        $fecha_hora_entrega_pedido = $request['pedido_fecha_hora_entrega'] ? $request['pedido_fecha_hora_entrega'] : NULL;
        $telefono_entrega_pedido    = $request['pedido_telefono_entrega'] ? $request['pedido_telefono_entrega'] : NULL;
        $telefono_envio_pedido    = $request['telefono_envio_pedido'] ? $request['telefono_envio_pedido'] : NULL;
        $id_tarjeta                = $request['tarjeta_id_pedido'] ? $request['tarjeta_id_pedido'] : NULL;
        $descripcion_tarjeta_pedido = $request['tarjeta_texto_pedido'] ? $request['tarjeta_texto_pedido'] : NULL;
        $fecha_hora_cobro_pedido = $request['pedido_fecha_hora_cobro'] ? $request['pedido_fecha_hora_cobro'] : NULL;
        $hora_cobro_hasta = $request['pedido_hora_hasta'] ? $request['pedido_hora_hasta'] : NULL;
        $nombre_contacto_pedido = $request['persona_pedido'] ? $request['persona_pedido'] : NULL;
        $observacion_entrega_pedido = $request['pedido_observacion'] ? $request['pedido_observacion'] : NULL;
        $documento_pedido = $request['documento_pedido'];
        $forma_pago = NULL;
        
        if ($request->moredata == 'cobrar') {
            /* si el pedido es a cobrar verificamos que el usuario tenga una caja abierta */
            $findCaja = DB::table('estados_cajas')->where('id_usuario', \Auth::user()->id)->where('fecha_cierre_caja', NULL)->first();
            if (!$findCaja) {
                $response = ['message' => 'No tienes caja abierta para el cobro.'];
                return response($response);
            }
            /* El monto del movimiento de caja es igual al total del carrito, por ahora no damos la posibilidad de cobros parciales */
            
            if (!$request['forma_pago_pedido']) {
                $response = ['message' => 'Debes seleccionar una forma de pago para proceder con el cobro.'];
                return response($response);
            }
            $forma_pago = $request['forma_pago_pedido'];
            $monto_movimiento_caja = $total;
            //$monto_cobro = $request['monto_cobro_pedido'];
            /* Cambiamos el estado del pedido a cobrado */
            $estado_pedido = 'COBRADO';
        }
        if ($request->moredata == 'guardar' AND !$request['id_direccion_cobro']) {
            $response = ['message' => 'Debes indicar una dirección de cobro para el pedido.'];
            return response($response);
        }
        
        $pedido =  new Pedido;
        $pedido->id_direccion_envio_pedido         = $request['id_direccion_envio'];
        $pedido->id_cliente                        = $request['id_cliente'];
        $pedido->id_persona                        = $request['id_destinatario'];
        $pedido->id_motivo                         = $request['id_motivo'];
        $pedido->id_usuario                        = $request['id_usuario'];
        $pedido->id_direccion_cobro_pedido         = $request['id_direccion_cobro'];
        $pedido->id_chofer                         = NULL;
        $pedido->fecha_hora_pedido                 = $ahora;
        $pedido->estado_pedido                     = $estado_pedido;
        $pedido->direccion_cobro_pedido            = NULL;
        $pedido->total_importe_pedido              = $total;
        $pedido->total_descuento_pedido            = NULL;
        $pedido->total_impuesto_pedido             = NULL;
        $pedido->observacion_pedido                = $observacion_pedido;
        $pedido->descuento_porcentaje_pedido       = NULL;
        $pedido->descuento_importe_pedido          = NULL;
        $pedido->motivo_des_pedido                 = NULL;
        $pedido->numero_factura_pedido             = NULL;
        $pedido->condicion_venta_pedido            = $condicion_venta;
        $pedido->forma_pago_pedido                 = $forma_pago;
        $pedido->estado_toma_pedido                = $estado_toma_pedido;
        $pedido->estado_envio_pedido               = $estado_envio_pedido;
        $pedido->fecha_hora_entrega_pedido         = $fecha_hora_entrega_pedido;
        $pedido->telefono_envio_pedido             = $telefono_envio_pedido;
        $pedido->id_tarjeta                        = $id_tarjeta;
        $pedido->descripcion_tarjeta_pedido        = $descripcion_tarjeta_pedido;
        $pedido->tipo_descuento_pedido             = NULL;
        $pedido->fecha_hora_cobro_pedido           = $fecha_hora_cobro_pedido;
        $pedido->fecha_anulacion_pedido            = NULL;
        $pedido->hora_cobro_hasta                  = $hora_cobro_hasta;
        $pedido->nro_comprobante_pago              = NULL;
        $pedido->nombre_contacto_pedido            = $nombre_contacto_pedido;
        $pedido->telefono_entrega_pedido           = $telefono_entrega_pedido;
        $pedido->saldo_importe_pedido              = $total;
        $pedido->id_pos                            = NULL;
        $pedido->nro_impresion_nota_pedido         = NULL;
        $pedido->id_usuario_final                  = NULL;
        $pedido->telefono_adicional_pedido         = NULL;
        $pedido->telefono_interno_pedido           = NULL;
        $pedido->fecha_factura_pedido              = NULL;
        $pedido->usuario_concedio_credito_pedido   = NULL;
        $pedido->persona_recibe_pedido             = NULL;
        $pedido->fecha_hora_recibe_pedido          = NULL;
        $pedido->fecha_hora_registro_recibe_pedido = NULL;
        $pedido->observacion_entrega_pedido        = $observacion_entrega_pedido;
        $pedido->imprimir_pedido                   = 0;
        $pedido->remision_pedido                   = 0;
        $pedido->cobrar_llamar_pedido              = NULL;
        $pedido->save();

        $id_new_pedido = $pedido->id_pedido;

        /* Guardamos el nuevo ID del nuevo pedido y luego procedemos a verificar si se guardo,
        de lo contrario hubo error y abortamos la transaccion */
        if (!$id_new_pedido) {
            $response = ['message' => 'Ocurrió un error al intentar guardar el pedido, intenta nuevamente o verifica los datos.'];
            return response($response);
        }

        $n = 1;
        if ($id_producto) {
            foreach ($request['id_producto'] as $clave=>$id) {
                $n = $n++;
                DB::table('detalles_pedidos')->insert([
                    [
                        'item_detalle_pedido' => $n,
                        'id_pedido' => $id_new_pedido,
                        'id_producto' => $request['id_producto'][$clave],
                        'cantidad_detalle_pedido' => $request['cantidad'][$clave],
                        'monto_detalle_pedido' => $request['price'][$clave],
                        'descuento_detalle_pedido' => '0',
                        'motivo_des_detalle_pedido' => '',
                        'observacion_detalle_pedido' => $request['comentario'][$clave],
                        'porc_impuesto_detalle_pedido' => 10,
                        'descripcion_detalle_pedido' => nombre_producto($request['id_producto'][$clave]),
                        'nombre_detalle_pedido'     => desc_producto($request['id_producto'][$clave])
                    ]
                ]);
            }            
        }else
        {
            $response = ['message' => 'Aún no has agregado productos al detalle.'];
            return response($response);
        }

        if ($request->moredata == 'cobrar') {
            $pedido = Pedido::find($id_new_pedido);
            $forma_pago = [];
            foreach ($request['forma_pago'] as $clave=>$id) {
                $forma_pago[] = 
                    [
                    'forma_pago' => $request['forma_pago'][$clave],
                    'monto_cobro' => $request['monto_cobro'][$clave]
                    ];
                
            }
            $forma_pago_filtered = collect($forma_pago)->where('monto_cobro', '!=', NULL);


            if (!count(($forma_pago_filtered))) {
                if($request->ajax())
                {
                    $response = ['message' => 'Debes ingresar un monto a cobrar.'];
                    return response($response);
                }
                Session::flash('message', 'Debes ingresar un monto a cobrar.');
                return redirect()->back();
            }
            $total_recibido = $forma_pago_filtered->sum('monto_cobro');
            $total_cobro_pedido = NULL;
            $vuelto = NULL;
            $estado_pedido = 'A COBRAR';
            $tipo_pago_factura = 'CREDITO';
            /* Si el total recibido es mayor al saldo pendiente del pedido hay vuelto y efectuamos la resta */
            if ($forma_pago_filtered->sum('monto_cobro') > $pedido->saldo_importe_pedido) {
                $vuelto = $forma_pago_filtered->sum('monto_cobro') - $pedido->saldo_importe_pedido;
            }
            /*
            if ($request->vuelto_cobrar) {
                $saldo_pedido_cobro = $forma_pago_filtered->sum('monto_cobro') - $request->vuelto_cobrar;
            }
            */
            /* Si el total recibido es menor al saldo pendiente del pedido es porque es un pago parcual y queda un saldo pendiente y el estado sigue siendo A PAGAR */
            if ($total_recibido < $pedido->saldo_importe_pedido) {
                $total_cobro_pedido = $pedido->saldo_importe_pedido - $total_recibido;
                $estado_pedido = 'A COBRAR';
                $tipo_pago_factura = 'CREDITO';
                $estado_factura = 'A PAGAR';
            }
            /* si el total recibido es igual al saldo pendiente del pedido no queda saldo pendiente y el estado es COBRADO */
            if ($total_recibido == $pedido->saldo_importe_pedido) {
                $total_cobro_pedido = 0;
                $estado_pedido = 'COBRADO';
                $tipo_pago_factura = 'CONTADO';
                $estado_factura = 'COBRADA';
            }
            $pedido->saldo_importe_pedido = $total_cobro_pedido;
            $pedido->estado_pedido = $estado_pedido;
            $pedido->save();


            foreach ($forma_pago_filtered as $pago) {
                DB::table('movimientos_cajas')->insert(['id_pedido' => $id_pedido, 'monto_movimiento_caja' => $pago['monto_cobro'], 'concepto_movimiento_caja' => 'Cobro', 'modalidad_movimiento_caja' => $pago['forma_pago'], 'fecha_registro_movimiento_caja' => $fecha_registro, 'tipo_movimiento_caja' => 'INGRESO', 'id_estado_caja' => $user_caja->id_usuario, 'created_at' => $ahora]);
            }
            if ($vuelto) {
               DB::table('movimientos_cajas')->insert(['id_pedido' => $id_pedido, 'monto_movimiento_caja' => $request['vuelto_cobrar'], 'concepto_movimiento_caja' => 'Vuelto', 'modalidad_movimiento_caja' => 'EFECTIVO', 'fecha_registro_movimiento_caja' => $fecha_registro, 'tipo_movimiento_caja' => 'EGRESO', 'id_estado_caja' => $user_caja->id_usuario, 'created_at' => $ahora]);
            }
        }
        /* si  se selecciono imprimir factura */
        if ($imprimir_factura == 'si') {
            $user = \Auth::user()->id;
            
            $hoy = Carbon::today()->format('Y-m-d');

            $id_pos = 1;
            $talon = DB::select(DB::raw('select * from bocas_facturacion, talonarios where bocas_facturacion.id_talon = talonarios.id_talon and talonarios.tipo_talon = "FACTURA" and bocas_facturacion.id_pos = "'.$id_pos.'" and bocas_facturacion.estado_boca_facturacion = "ACTIVO" and talonarios.fecha_vencimiento_talon > "'.$hoy.'" and bocas_facturacion.id_talon IS NOT NULL'));

            if (!count($talon)) {
                if($request->ajax())
                {
                    $response = ['message' => 'No hay boca de facturacción disponible para imprimir.', 'status' => 'error'];
                    return response($response);
                }
                Session::flash('message', 'No hay boca de facturacción disponible para imprimir.');
                return redirect()->back();
            }
            $talon_update = Talon::find($talon[0]->id_talon);
            $ultimo_numero_talon = $talon_update->ultimo_nro_talon+1;
            $talon_update->ultimo_nro_talon = $ultimo_numero_talon;
            $talon_update->save();

            $numero_factura = $talon_update->ultimo_nro_talon +1;


            $factura = new Factura;
            $factura->id_usuario = $user;
            $factura->id_pedido = $id_new_pedido;
            $factura->numero_factura = $numero_factura;
            $factura->tipo_pago_factura = $tipo_pago_factura;
            $factura->estado_factura = $estado_factura;
            $factura->fecha_registro_factura = $ahora;
            $factura->observacion_factura = NULL;
            $factura->id_talon = $talon[0]->id_talon;
            $factura->save();

            $pedido = Pedido::find($id_new_pedido);
            $pedido->numero_factura_pedido = $numero_factura;
            $pedido->imprimir_pedido = 1;
            $pedido->save();

            $pdf = view('test.factura');
            
            $html = new CssToInlineStyles();
            //$css = file_get_contents(url('css/bootstrap.css'));
            $make = response()->make($html->convert($pdf));
            $pdf = \PDF::loadHTML($make);
            
            $headers = [
                    'Content-Type'          => 'application/pdf',
                    //'Content-Disposition'   => 'attachment; filename="'.$filename.'"',
                    'Content-Disposition'   => 'filename="Documento.pdf"',
                ];
            $name = 'factura-'.$hoy.'-'.time().'.pdf';
            $pdf->save(public_path('facturas/'.$name), $headers);
            $file = public_path('facturas/'.$name);
            $host = $talon[0]->host_facturacion;
            $uri_print = $talon[0]->uri_print;

            
            $url = 'http://localhost/sistema/public/phpprint/legacy/testfiles/test.php?host='.$host.'&uri_print='.$uri_print.'&file='.$file;
            
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //Si lo deseamos podemos recuperar la salida de la ejecución de la URL
            $resultado = curl_exec($ch);
            //cerrar conexión
            curl_close($ch);
            //print_r($resultado);
        }

        $response = ['message' => 'Pedido registrado exitosamente, el número de pedido es: '.$id_new_pedido, 'confirm' => 'ok', 'id_pedido' => $id_new_pedido];

        return response($response);
    }

    public function detail($id)
    {

        $pedido = Pedido::findOrFail($id);
        $detalles = PedidoDetalle::where('id_pedido', $id)->get();
        $situaciones = Pedido::select('estado_toma_pedido')->groupBy('estado_toma_pedido')->get();
        $situaciones_envio = Pedido::select('estado_envio_pedido')->groupBy('estado_toma_pedido')->get();
        //$choferes = User::hasRole('CHOFER')->get();
        $choferes = User::whereHas('roles', function ($query) {
                $query->where('roles.name', '=', 'CHOFER');
            })->get();
        //return $choferes;

        return view('pedidos.detail', compact('pedido', 'detalles', 'total', 'situaciones', 'choferes'));
    }

    public function consultaStock(Request $request)
    {
        $id = $request->id;
        $producto = Producto::find($id);

        if ($producto->control_stock == 1) {
            if ($producto->stock_actual >= 1) {
                return response()->json(['stock' => $producto->stock_actual,'id' => $producto->id_producto]);
            }else {
                return '';
            }
        }

        //return view('pedidos.detail', compact('pedido', 'detalle', 'total'));
    }

    public function buscarProductos(Request $request)
    {

        if (empty($request->q) AND $request->categoria != 0)
        {
            /*
                Búsqueda por categoría.

                Si no se ingresa un termino en el buscador de texto y solo se selecciona una categoría,
                realizamos la siguiente busqueda, posteriormente pasamos los resultados a la vista.
            */
            //return 'Búsqueda por categoría.';

            $categoria = $request->categoria;
            $productos = Producto::whereHas('categories', function ($query) use ($categoria) {
                $query->where('agrupadores_productos.id_agrupador', '=', $categoria);
            })->where('es_tarjeta', 0)->get();
            
            return View::make('pedidos.productos')->with('productos', $productos);

        }elseif(!empty($request->q) AND empty($request->categoria))
        {
            /*
                Búsqueda por termino de búsqueda.

                De lo contrario, si se ingresa un termino de busqueda y no se selecciona una categoría,
                realizamos la búsqueda, posteriormente pasamos los resultados a la vista.
            */
            //return 'Búsqueda por termino de búsqueda.';
                
            $categoria = $request->categoria;
            $q = $request->q;
            $productos = Producto::where('nombre_producto', 'like', '%'.$q.'%')->orWhere('codigo_producto', $q)->where('es_tarjeta', 0)->orderBy('nombre_producto', 'ASC')->get();
            
            return View::make('pedidos.productos')->with('productos', $productos);

        }elseif (!empty($request->q) AND !empty($request->categoria)) {
            /*
                Búsqueda por ambos terminos.

                Por último, si las dos opciones esta seteadas, realizamos la búsqueda,
                posteriormente pasamos los resultados a la vista.
            */
            //return 'Búsqueda por ambos terminos.';

            $categoria = $request->categoria;
            $q = $request->q;
            $productos = Producto::whereHas('categories', function ($query) use ($categoria) {
                $query->where('agrupadores_productos.id_agrupador', '=', $categoria);
            })->where('nombre_producto', 'like', '%'.$q.'%')->orWhere('codigo_producto', '%'.$q.'%')->where('es_tarjeta', 0)->orderBy('nombre_producto', 'ASC')->get();
            
            return View::make('pedidos.productos')->with('productos', $productos);
        }
    }

    public function buscar(Request $request)
    {
        $id = $request->q;
        $pedidos = Pedido::where('id_pedido', $id)->get();

        return View::make('pedidos.pedido')->with('pedidos', $pedidos);
    }
    public function buscarCliente(Request $request)
    {
        
        $result = DB::select(DB::raw('SELECT * FROM personas, clientes WHERE personas.id_persona = clientes.id_persona AND personas.estado_persona != "ELIMINADO" AND MATCH(nombre_persona, apellido_persona, num_doc_persona, ruc_persona) AGAINST ("%'.$request->term.'%") ORDER BY personas.nombre_persona ASC LIMIT 80'));
        
        $collection = collect($result);
        
        foreach($collection as $cliente){
            $doc = $cliente->num_doc_persona ? ' | ' .$cliente->num_doc_persona : '';
            $ruc = $cliente->ruc_persona ? ' | Ruc: ' .$cliente->ruc_persona : '';
            $email = $cliente->email_persona ? ' | ' .$cliente->email_persona : '';
            $cliente->value = $cliente->nombre_persona . ' ' .$cliente->apellido_persona . $doc . $ruc . $email;
        }
        //dd($newCollection->all());
        return response($collection);
    }
    public function buscarTarjeta(Request $request)
    {
        $tarjeta = Producto::where('id_producto', $request->id)->first();
        return response($tarjeta);
    }
    public function ClienteDirecciones(Request $request)
    {
        $id_persona = $request->id;
        $direcciones = Direccion::whereHas('personas', function ($query) use ($id_persona) {
                $query->where('personas_direcciones.id_persona', '=', $id_persona);
            })->get();
        return View::make('pedidos.clienteDirecciones')->with('direcciones', $direcciones);
    }
    public function DestinatarioTelefonos(Request $request)
    {
        $id_persona = $request->id;
        $telefonos = Telefono::whereHas('personas', function ($query) use ($id_persona) {
                $query->where('personas_telefonos.id_persona', '=', $id_persona);
            })->get();
        return View::make('pedidos.DestinatarioTelefonos')->with('telefonos', $telefonos);
    }
    public function findCliente(Request $request)
    {
        /*if (empty($request->id)) {
           $collection = collect($result);
            return response($collection);
        }*/
        $result = DB::select(DB::raw('SELECT * FROM personas, clientes WHERE personas.id_persona = "'.$request->id.'" AND personas.id_persona = clientes.id_persona AND personas.estado_persona != "ELIMINADO"'));
        $collection = collect($result);
        
        return response($collection);
    }


    public function facturacion()
    {
        $facturas = Factura::orderBy('id_factura', 'DESC')->paginate(15);
        return view('pedidos.facturas', compact('facturas'));
    }

    public function remisiones()
    {
        $remisiones = Remision::orderBy('id_remision', 'DESC')->paginate(15);
        return view('pedidos.remisiones', compact('remisiones'));
    }

    public function posModern()
    {
        return view('pedidos.pos');
    }

    public function abrirCaja(Request $request)
    {
        /*  
            Si hay un registro con fecha_cierre_caja = NULL hay una caja abierta.
        */

        $user = \Auth::user()->id;
        $caja = $request->caja;
        $monto = $request->monto;
        if ($monto == '' OR $monto > 0) {
            $response = ['message' => 'Debes ingresar un monto para la apertura de la caja.', 'status' => 'error'];
            return response($response);
        }
        $caja_exist = DB::table('estados_cajas')->where('id_caja', $request->caja)->where('id_usuario', $user)->where('fecha_cierre_caja', NULL)->get();

        if (count($caja_exist)) {
            $response = ['message' => 'Esta caja está abierta desde '.$caja_exist[0]->fecha_apertura_caja.'.', 'status' => 'error'];
            return response($response);
        }else{
            $fecha_registro = Carbon::now();
            $caja_new = DB::table('estados_cajas')->insertGetId(['id_usuario' => $user, 'id_caja' => $caja, 'fecha_apertura_caja' => $fecha_registro, 'saldo_inicial_caja' => $monto, 'id_usuario_operacion' => $user]);

            $movimiento_caja = DB::table('movimientos_cajas')->insertGetId(['monto_movimiento_caja' => $monto, 'concepto_movimiento_caja' => 'Apertura', 'modalidad_movimiento_caja' => 'EFECTIVO', 'fecha_registro_movimiento_caja' => $fecha_registro, 'tipo_movimiento_caja' => 'INGRESO', 'id_estado_caja' => $caja_new]);


            if ($caja_new && $movimiento_caja) {
                //return 'se registró id: '.$caja_new;
                $response = ['message' => 'Caja abierta exitosamente.', 'status' => 'ok'];
                return response($response);
            }else {
                $response = ['message' => 'Error al intentar abrir la caja.' , 'status' => 'error'];
                return response($response);
            }
        }

        $response = ['message' => 'No hay acciones que realizar.' , 'status' => 'error'];
        return response($response);
    }
    public function cerrarCaja(Request $request)
    {
        /*  
            Si hay un registro con fecha_cierre_caja = NULL hay una caja abierta.
        */

        $user = \Auth::user()->id;
        $caja = $request->caja;
        
        
        $caja_exist = DB::table('estados_cajas')->where('id_caja', $request->caja)->where('id_usuario', $user)->where('fecha_cierre_caja', NULL)->get();

        if (count($caja_exist)) {
            $response = ['message' => 'Esta caja está abierta desde '.$caja_exist[0]->fecha_apertura_caja.'.', 'status' => 'error'];
            return response($response);
        }else{
            $fecha_registro = Carbon::now();
            $caja_new = DB::table('estados_cajas')->insertGetId(['id_usuario' => $user, 'id_caja' => $caja, 'fecha_apertura_caja' => $fecha_registro, 'saldo_inicial_caja' => $monto, 'id_usuario_operacion' => $user]);

            $movimiento_caja = DB::table('movimientos_cajas')->insertGetId(['monto_movimiento_caja' => $monto, 'concepto_movimiento_caja' => 'Apertura', 'modalidad_movimiento_caja' => 'EFECTIVO', 'fecha_registro_movimiento_caja' => $fecha_registro, 'tipo_movimiento_caja' => 'INGRESO', 'id_estado_caja' => $caja_new]);


            if ($caja_new && $movimiento_caja) {
                //return 'se registró id: '.$caja_new;
                $response = ['message' => 'Caja abierta exitosamente.', 'status' => 'ok'];
                return response($response);
            }else {
                $response = ['message' => 'Error al intentar abrir la caja.' , 'status' => 'error'];
                return response($response);
            }
        }

        $response = ['message' => 'No hay acciones que realizar.' , 'status' => 'error'];
        return response($response);
    }
    public function anular($id_pedido)
    {
        $ahora =  Carbon::today()->format('Y-m-d h:m:s');

        $pedido = Pedido::where('estado_toma_pedido', 'PEDIDO')->where('estado_pedido', 'A PAGAR')->where('id_pedido', $id_pedido)->first();
        if (!$pedido) {
            Session::flash('message', 'Este pedido no se puede eliminar.');
            return redirect()->back(); 
        }

        $pedido->estado_toma_pedido = 'ELIMINADO';
        $pedido->fecha_anulacion_pedido = $ahora;
        $pedido->save();
        Session::flash('message', 'Pedido eliminado correctamente.');

        return redirect(route('ventas.pedidos'));
    }

    public function cambiarEstado(Request $request, $id_pedido)
    {

        $pedido = Pedido::find($id_pedido);
        $pedido->estado_toma_pedido = $request->estado_toma_pedido;
        $pedido->estado_pedido = $request->estado_pedido;
        $pedido->id_chofer = $request->chofer;
        $pedido->save();


        if($request->ajax())
        {
            $response = ['message' => 'Dirección actualizada correctamente.', 'status' => 'ok'];
            return response($response);
        }
        Session::flash('message', 'Dirección actualizada correctamente.');
        return redirect()->back();
        
    }

    public function imprimirNota($id_pedido)
    {
        $pedido = Pedido::findOrFail($id_pedido);
        $detalles = PedidoDetalle::where('id_pedido', $id_pedido)->get();

        $pdf = view('pdf.nota_pedido', compact('pedido', 'detalles'));
        
        $html = new CssToInlineStyles();
        $css = file_get_contents(url('css/bootstrap.css'));
        $make = response()->make($html->convert($pdf, $css));
        $pdf = \PDF::loadHTML($make)->setPaper('A4', 'portrait');
        return $make;
        $headers = [
                'Content-Type'          => 'application/pdf',
//                'Content-Disposition'   => 'attachment; filename="'.$filename.'"',
                'Content-Disposition'   => 'filename="Documento.pdf"',
            ];
        $name = 'nota_pedido -'.time().'.pdf';
        $pdf->save($name);


        //return view('pedidos.detail', compact('pedido', 'detalles'));
    }

    public function test()
    {
        $ahora =  Carbon::today()->format('Y-m-d h:m:s');

        $user = \Auth::user()->id;
        $id_pedido = 11;
        $hoy = Carbon::today()->format('Y-m-d');

        $id_pos = 1;
        $talon = DB::select(DB::raw('select * from bocas_facturacion, talonarios where bocas_facturacion.id_talon = talonarios.id_talon and talonarios.tipo_talon = "FACTURA" and bocas_facturacion.id_pos = "'.$id_pos.'" and bocas_facturacion.estado_boca_facturacion = "ACTIVO" and talonarios.fecha_vencimiento_talon > "'.$hoy.'" and bocas_facturacion.id_talon IS NOT NULL'));


        if (!count($talon)) {
            if($request->ajax())
            {
                $response = ['message' => 'No hay boca de facturacción disponible para imprimir.', 'status' => 'error'];
                return response($response);
            }
            Session::flash('message', 'No hay boca de facturacción disponible para imprimir.');
            return redirect()->back();
        }
        $talon_update = Talon::find($talon[0]->id_talon);
        $ultimo_numero_talon = $talon_update->ultimo_nro_talon+1;
        $talon_update->ultimo_nro_talon = $ultimo_numero_talon;
        $talon_update->save();

        $numero_factura = $talon_update->ultimo_nro_talon +1;


        $factura = new Factura;
        $factura->id_usuario = $user;
        $factura->id_pedido = $id_pedido;
        $factura->numero_factura = $numero_factura;
        $factura->tipo_pago_factura = 'CONTADO';
        $factura->estado_factura = 'PAGADA';
        $factura->fecha_registro_factura = $ahora;
        $factura->observacion_factura = NULL;
        $factura->id_talon = $talon[0]->id_talon;
        $factura->save();

        $pedido = Pedido::find($id_pedido);
        $pedido->numero_factura_pedido = $numero_factura;
        $pedido->imprimir_pedido = 1;
        $pedido->save();

        $pdf = view('test.factura');
        
        $html = new CssToInlineStyles();
        //$css = file_get_contents(url('css/bootstrap.css'));
        $make = response()->make($html->convert($pdf));
        $pdf = \PDF::loadHTML($make);
        
        $headers = [
                'Content-Type'          => 'application/pdf',
                //'Content-Disposition'   => 'attachment; filename="'.$filename.'"',
                'Content-Disposition'   => 'filename="Documento.pdf"',
            ];
        $name = 'factura-'.$hoy.'-'.time().'.pdf';
        $pdf->save(public_path('facturas/'.$name), $headers);
        $file = public_path('facturas/'.$name);
        $host = $talon[0]->host_facturacion;
        $uri_print = $talon[0]->uri_print;

        
        $url = 'http://localhost/sistema/public/phpprint/legacy/testfiles/test.php?host='.$host.'&uri_print='.$uri_print.'&file='.$file;
        
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //Si lo deseamos podemos recuperar la salida de la ejecución de la URL
        $resultado = curl_exec($ch);
        //cerrar conexión
        curl_close($ch);
        print_r($resultado);
        
    }

}
