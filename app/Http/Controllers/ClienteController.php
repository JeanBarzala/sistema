<?php

namespace App\Http\Controllers;
use App\Cliente;
use App\Persona;
use App\EstadoCivil;
use App\Ciudad;
use App\Barrio;
use App\Direccion;
use App\Telefono;
use App\Pedido;
use App\PedidoDetalle;
use App\PersonaDireccion;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Response;
use App\Http\Requests;
use DB;
use \Carbon\Carbon;
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;


class ClienteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $request;
    private $cliente;
    private $mensaje;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function buscar(Request $request)
    {
        
        // Compruebo si la consulta es ajax 
        if ($request->ajax())
        {
            // Guardo en una variable los valores por GET
            $q = $request->q;
            $list = $request->list;

            // Compruebo si la variable $q esta vacia, si no esta vacia procedo 
            // 
            if (!empty($q)) {
                $result = DB::select(DB::raw('SELECT * FROM personas, clientes WHERE personas.id_persona = clientes.id_persona AND personas.estado_persona != "ELIMINADO" AND MATCH(nombre_persona, apellido_persona, num_doc_persona, ruc_persona) AGAINST ("%'.$q.'%") ORDER BY personas.nombre_persona ASC LIMIT 80 '));

                $total = count($result);
            }
            // Compruebo si la variable $list es igual a "all" lo cual significa que 
            // no se esta realizando una busqueda si no que hay que listar todos los
            // productos
            else{
                $result = DB::select(DB::raw('SELECT * FROM personas, clientes WHERE personas.id_persona = clientes.id_persona AND personas.estado_persona != "ELIMINADO" ORDER BY personas.nombre_persona ASC LIMIT 100'));
                $total = 0;
            }

             
        }
        // Si la variable $q esta vicia entonces listo todos los clientes
        else {

            $result = DB::select(DB::raw('SELECT * FROM personas, clientes WHERE personas.id_persona = clientes.id_persona AND personas.estado_persona != "ELIMINADO" ORDER BY nombre_persona ASC LIMIT 30'));
            $total = count($result);

        }

        
        // Preparo la vista con los resultados para luego pasarle a la función de javascript
        // Eso es todo
        return View::make('clientes.clientes')->with('result', $result)->with('total', $total);
    }
    public function index()
    {

        $clientes = Persona::has('clientes')->where('estado_persona', '!=', 'ELIMINADO')->orderBy('nombre_persona', 'ASC')->paginate(16);
        $total = Persona::has('clientes')->count();

        //return view('clientes.index', compact('clientes'));
        return view('clientes.index')->with('clientes', $clientes)->with('total', $total);

    }

    public function create()
    {
        $estado_civil = EstadoCivil::all();
        $ciudades = Ciudad::limit(15)->get();
        $barrios = Barrio::limit(15)->get();

        return view('clientes.create')->with('estado_civil', $estado_civil)->with('ciudades', $ciudades)->with('barrios', $barrios);

        //return view('auth.login');
    }

    public function store(Requests\StoreClienteRequest $request)
    {

        try
        {
            $persona = new Persona();
            $persona->id_estado_civil               =$request->estado_civil;
            $persona->nombre_persona                =$request->nombre;
            $persona->apellido_persona              =$request->apellido;
            $persona->num_doc_persona               =$request->num_doc_persona;
            $persona->tipo_doc_persona              =$request->tipo_documento;
            $persona->fecha_ncto_persona            =$request->fecha_nacimiento;
            $persona->razon_social_persona          =$request->razon_social;
            $persona->ruc_persona                   =$request->ruc;
            $persona->email_persona                 =$request->email;         
            $persona->sitio_web_persona             =$request->sitio_web;
            $persona->sexo_persona                  =$request->sexo;
            $persona->observacion_persona           =$request->obs;
            $persona->id_tipo_persona               =0;
            $persona->tipo_persona                  =$request->tipo_persona;
            $persona->fecha_registro_persona        =date("Y-m-d H:i:s");
            $persona->estado_persona                =1;
            $persona->save();

            $cliente = new Cliente;
            $cliente->id_tipo_cliente               =null;
            $cliente->id_persona                    =$persona->id_persona;
            $cliente->contribuyente_cliente         =null;
            $cliente->calificacion_cliente          =1;
            $cliente->credito_cliente               =1;
            $cliente->save();

            //return $persona->id_persona;
            //return redirect('/clientes');
            Session::flash('message', '¡Bien! El cliente ha sido creado'); 

            return redirect('/clientes/editar/'.$persona->id_persona);
        }
        catch(Exception $e)
        {
            return "Fatal error - "-$e->getMessage();
        }
    }

    public function edit($id)
    {

        $clientes = Persona::find($id);
        $estado_civil = EstadoCivil::all();
        $ciudades = Ciudad::limit(5)->get();
        $barrios = Barrio::limit(5)->get();

        return view('clientes.edit')->with('clientes', $clientes)->with('estado_civil', $estado_civil)->with('ciudades', $ciudades)->with('barrios', $barrios);
    }


    public function update($id, $id_cliente, Requests\UpdateClienteRequest $request)
    {
        $persona = Persona::find($id);
        $persona->id_estado_civil               =$request->estado_civil;
        $persona->nombre_persona                =$request->nombre;
        $persona->apellido_persona              =$request->apellido;
        $persona->num_doc_persona               =$request->num_doc_persona;
        $persona->tipo_doc_persona              =$request->tipo_documento;
        $persona->fecha_ncto_persona            =$request->fecha_nacimiento;
        $persona->razon_social_persona          =$request->razon_social;
        $persona->ruc_persona                   =$request->ruc;
        $persona->email_persona                 =$request->email;         
        $persona->sitio_web_persona             =$request->sitio_web;
        $persona->sexo_persona                  =$request->sexo;
        $persona->observacion_persona           =$request->obs;
        //$persona->fecha_registro_persona        =date("Y-m-d H:i:s");
        $persona->estado_persona                =1;
        $persona->save();


        //$c = Cliente::where('id_persona', $id)->first();
        $cliente = Cliente::find($id_cliente);
        $cliente->id_tipo_cliente               =null;
        $cliente->id_persona                    =$persona->id_persona;
        $cliente->contribuyente_cliente         ='';
        $cliente->calificacion_cliente          =1;
        $cliente->credito_cliente               =1;
        $cliente->save();

        Session::flash('message', 'Cliente actualizado correctamente');

        //Session::flash('message', 'Los datos del cliente han sido actualizados');

        return redirect()->back();
    }

    public function updateAjax(Request $request)
    {

        
        if (empty($request->id_cliente_update)) {
            $persona = new Persona;
            $persona->id_estado_civil               =$request->estado_civil;
            $persona->nombre_persona                =$request->nombre;
            $persona->apellido_persona              =$request->apellido;
            $persona->num_doc_persona               =$request->num_doc_persona;
            $persona->tipo_doc_persona              =$request->tipo_doc_persona;
            $persona->fecha_ncto_persona            =$request->cumpleano_cliente;
            $persona->razon_social_persona          =$request->razon_social;
            $persona->ruc_persona                   =$request->ruc;
            $persona->email_persona                 =$request->email_cliente;         
            $persona->sitio_web_persona             =$request->sitio_web;
            $persona->sexo_persona                  =$request->sexo;
            $persona->observacion_persona           =$request->obs_cliente;
            $persona->estado_persona                =1;
            $persona->tipo_persona                  =$request->tipo_persona;
            $persona->save();

            $cliente = new Cliente;
            $cliente->id_tipo_cliente               =null;
            $cliente->id_persona                    =$persona->id_persona;
            $cliente->contribuyente_cliente         =null;
            $cliente->calificacion_cliente          =1;
            $cliente->credito_cliente               =1;
            $cliente->save();

            $response = ['message' => 'Cliente registrado exitosamente.', 'confirm' => 'ok', 'id_cliente' => $persona->id_persona];
            return response($response);
        }
        $persona = Persona::find($request->id_cliente_update);
        $persona->id_estado_civil               =$request->estado_civil;
        $persona->nombre_persona                =$request->nombre;
        $persona->apellido_persona              =$request->apellido;
        $persona->num_doc_persona               =$request->num_doc_persona;
        $persona->tipo_doc_persona              =$request->tipo_doc_persona;
        $persona->fecha_ncto_persona            =$request->cumpleano_cliente;
        $persona->razon_social_persona          =$request->razon_social;
        $persona->ruc_persona                   =$request->ruc;
        $persona->email_persona                 =$request->email_cliente;         
        $persona->sitio_web_persona             =$request->sitio_web;
        $persona->sexo_persona                  =$request->sexo;
        $persona->observacion_persona           =$request->obs_cliente;
        $persona->estado_persona                =1;
        $persona->tipo_persona                  =$request->tipo_persona;
        $persona->save();


        $response = ['message' => 'Cliente actualizado correctamente.', 'confirm' => 'ok'];

        //Session::flash('message', 'Los datos del cliente han sido actualizados');

        return response($response);
    }

    public function delete($id_persona)
    {
        $cliente = Persona::find($id_persona);
        $cliente->estado_persona = 0;
        $cliente->save();

        Session::flash('message', 'Cliente eliminado correctamente.');

        return redirect()->back();
    }

    public function find($id)
    {

        $cliente = Persona::find($id);

        //$direcciones = PersonaDireccion::where('id_persona', $id)->get();

        $direcciones = DB::select(DB::raw('SELECT * FROM direcciones, personas_direcciones, ciudades, barrios WHERE direcciones.id_direccion = personas_direcciones.id_direccion AND personas_direcciones.id_persona = "'.$id.'" AND ciudades.id_ciudad = direcciones.id_ciudad AND direcciones.id_barrio = barrios.id_barrio'));

        $telefonos = DB::select(DB::raw('SELECT * FROM telefonos, personas_telefonos WHERE telefonos.id_telefono = personas_telefonos.id_telefono AND personas_telefonos.id_persona = "'.$id.'"'));

        return View::make('clientes.cliente')->with('cliente', $cliente)->with('direcciones', $direcciones)->with('telefonos', $telefonos);
        
    }

    public function pedidos($id)
    {
        /*
        
        Buscamos el ID cliente por medio del ID persona que recibimos por GET

        */
        $cliente        = Cliente::where('id_persona', $id)->first();
        /*
        
        Buscamos el comprobante por medio del ID del cliente, el cual obtenemos por medio del ID persona

        */
        $pedidos        = Pedido::with('comprobantes')->where('id_cliente', $cliente->id_cliente)->orderBy('fecha_hora_recibe_pedido', 'DESC')->paginate(15);
        $totalpedidos   = Pedido::with('comprobantes')->where('id_cliente', $cliente->id_cliente)->count();
        $totalgs        = Pedido::with('comprobantes')->where('id_cliente', $cliente->id_cliente)->sum('total_importe_pedido');
        $ids            = Pedido::with('comprobantes')->where('id_cliente', $cliente->id_cliente)->pluck('id_pedido');
        $detalle        = PedidoDetalle::whereIn('id_pedido', $ids)->sum('cantidad_detalle_pedido');

        return view('clientes.pedidos', compact('cliente', 'pedidos', 'totalgs', 'totalpedidos', 'totalproducto', 'detalle'));
    }
    public function estadoCuentaIndex()
    {

        return view('informes.estado-cuenta');
    }
    public function estadoCuenta($id_cliente)
    {
        
        $pedidos = Pedido::where('estado_toma_pedido', '!=', 'ANULADO')->where('id_cliente', $id_cliente)->get();
        $cliente = Cliente::find($id_cliente);
        $deuda   = $pedidos->sum('saldo_importe_pedido');


        /*$pdf = view('pdf.estado-cuenta', compact('pedidos', 'cliente', 'deuda'));
        
        $html = new CssToInlineStyles();
        $css = file_get_contents(url('css/bootstrap.css'));
        $make = response()->make($html->convert($pdf, $css));
        $pdf = \PDF::loadHTML($make)->setPaper('A4', 'portrait');
        //return view('pdf.prueba', compact('clientes'));
        $headers = [
                'Content-Type'          => 'application/pdf',
//                'Content-Disposition'   => 'attachment; filename="'.$filename.'"',
                'Content-Disposition'   => 'filename="Documento.pdf"',
            ];
        $name = time().'.pdf';
        $pdf->download($name, $headers);*/
        //return redirect('phpprint/legacy/testfiles/test.php?file=1534712695.pdf?user=root=pass=1234');
        return view('pdf.estado-cuenta', compact('pedidos', 'cliente', 'deuda'));
    }

    public function storeClienteAjax($request)
    {



        $persona = new Persona;
        $persona->id_estado_civil               =$request->estado_civil;
        $persona->nombre_persona                =$request->nombre;
        $persona->apellido_persona              =$request->apellido;
        $persona->num_doc_persona               =$request->num_doc_persona;
        $persona->tipo_doc_persona              =$request->tipo_doc_persona;
        $persona->fecha_ncto_persona            =$request->cumpleano_cliente;
        $persona->razon_social_persona          =$request->razon_social;
        $persona->ruc_persona                   =$request->ruc;
        $persona->email_persona                 =$request->email_cliente;         
        $persona->sitio_web_persona             =$request->sitio_web;
        $persona->sexo_persona                  =$request->sexo;
        $persona->observacion_persona           =$request->obs_cliente;
        $persona->estado_persona                =1;
        $persona->tipo_persona                  =$request->tipo_persona;
        $persona->save();

        $cliente = new Cliente;
        $cliente->id_tipo_cliente               =null;
        $cliente->id_persona                    =$persona->id_persona;
        $cliente->contribuyente_cliente         =null;
        $cliente->calificacion_cliente          =1;
        $cliente->credito_cliente               =1;
        $cliente->save();


        
    }

    public function editDireccion($id_direccion)
    {
        $direccion = Direccion::find($id_direccion);
        $ciudades = Ciudad::all();
        $barrios = Barrio::all();

        return view('clientes.editDireccion')->with('direccion', $direccion)->with('ciudades', $ciudades)->with('barrios', $barrios);
    }

    public function updateDireccion($id_direccion, Request $request)
    {

        $direccion = Direccion::find($id_direccion);
        $direccion->calle_direccion = $request->calle_direccion;
        $direccion->numero_direccion = $request->numero_direccion;
        $direccion->complemento_direccion = $request->complemento_direccion;
        $direccion->interseccion1_direccion = $request->interseccion1_direccion;
        $direccion->interseccion2_direccion = $request->interseccion2_direccion;
        $direccion->referencia_direccion = $request->referencia_direccion;
        $direccion->observaciones_direccion = $request->observaciones_direccion;
        $direccion->id_ciudad = $request->ciudad;
        $direccion->id_barrio = $request->barrio;
        $direccion->save();
        
        if($request->ajax())
        {

            $response = ['message' => 'Dirección actualizada correctamente.', 'status' => 'ok'];
            return response($response);
        }else{

            Session::flash('message', 'Dirección actualizada correctamente.');
            return redirect()->back();
        }
    }

    public function editTelefono($id_telefono)
    {

        $telefono = Telefono::find($id_telefono);

        return view('clientes.editTelefono')->with('telefono', $telefono);
    }

    public function updateTelefono($id_telefono, Request $request)
    {
                
        $telefono = Telefono::find($id_telefono);
        $telefono->tipo_telefono = $request->tipo_telefono;
        $telefono->local_telefono = $request->local_telefono;
        $telefono->numero_telefono = $request->numero_telefono;
        $telefono->save();

        if($request->ajax())
        {

            $response = ['message' => 'Teléfono actualizado correctamente.', 'status' => 'ok'];
            return response($response);
        }else{

            Session::flash('message', 'Teléfono actualizado correctamente.');
            return redirect()->back();
        }

    }

    public function storeDireccion($id_persona = NULL, Request $request)
    {
        if (!$request->id_persona AND !$id_persona) {
            if($request->ajax())
            {
                $response = ['message' => 'No se puede registrar esta dirección, falta el id de la Porsona.', 'status' => 'error'];
                return response($response);
            }else{
                Session::flash('message', 'No se puede registrar esta dirección, falta el id de la Porsona.');
                return redirect()->back();
            }
        }

        $id_persona = $id_persona;

        if ($request->id_persona) {
            $id_persona = $request->id_persona;
        }
        

        $ciudad_id = null;
        $barrio_id = null;

        if (is_numeric($request->ciudad)) {           
            $ciudad_id = $request->ciudad;
        }else {
            $ciudad = new Ciudad;
            $ciudad->nombre_ciudad = $request->ciudad;
            $ciudad->save();
            $ciudad_id = $ciudad->id_ciudad;
        }
        if (is_numeric($request->barrio)) {           
            $barrio_id = $request->barrio;
        }else {
            $barrio = new Barrio;
            $barrio->nombre_barrio = $request->barrio;
            $barrio->id_ciudad = $ciudad_id;
            $barrio->save();
            $barrio_id = $barrio->id_barrio;
        }

        $direccion = new Direccion;
        $direccion->calle_direccion = $request->calle_direccion;
        $direccion->numero_direccion = $request->numero_direccion;
        $direccion->complemento_direccion = $request->complemento_direccion;
        $direccion->interseccion1_direccion = $request->interseccion1_direccion;
        $direccion->interseccion2_direccion = $request->interseccion2_direccion;
        $direccion->referencia_direccion = $request->referencia_direccion;
        $direccion->observaciones_direccion = $request->observaciones_direccion;
        $direccion->id_ciudad = $ciudad_id;
        $direccion->id_barrio = $barrio_id;
        $direccion->save();

        DB::table('personas_direcciones')->insert(['id_persona' => $id_persona, 'id_direccion' => $direccion->id_direccion]);
        
        if($request->ajax())
        {
            $response = ['message' => 'La dirección ha sido registrada.', 'status' => 'ok'];
            return response($response);
        }else{
            Session::flash('message', 'La dirección ha sido registrada.');
            return redirect()->back();
        }
    }

    public function storeTelefono($id_persona = NULL, Request $request)
    {
        if (!$request->id_persona AND !$id_persona) {
            if($request->ajax())
            {
                $response = ['message' => 'No se puede registrar esta dirección, falta el id de la Porsona.', 'status' => 'error'];
                return response($response);
            }else{
                Session::flash('message', 'No se puede registrar esta dirección, falta el id de la Porsona.');
                return redirect()->back();
            }
        }

        $id_persona = $id_persona;

        if ($request->id_persona) {
            $id_persona = $request->id_persona;
        }
                
        $telefono = new Telefono;
        $telefono->tipo_telefono = $request->tipo_telefono;
        $telefono->local_telefono = $request->local_telefono;
        $telefono->numero_telefono = $request->numero_telefono;
        $telefono->save();
        DB::table('personas_telefonos')->insert(['id_persona' => $id_persona, 'id_telefono' => $telefono->id_telefono]);

        if($request->ajax())
        {

            $response = ['message' => 'El Teléfono ha sido registrado correctamente.', 'status' => 'ok'];
            return response($response);
        }else{

            Session::flash('message', 'El Teléfono ha sido registrado correctamente.');
            return redirect()->back();
        }

    }



}
