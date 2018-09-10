<?php

namespace App\Http\Controllers;

use Auth;

use App\Venta;
use App\Producto;
use App\Empresa;
use App\ComprobanteDetalle;
use Illuminate\Http\Request;
use App\Http\Controllers\Session;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Query\Builder;



class VentaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $request;
    private $venta;
    private $q;
    private $detalle;
    private $comprobantes;
    private $value;
    private $permiso;
    private $empresa;


    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $pedidos = Venta::where('estado', 1)->get();

        $comprobantes = Venta::where('estado', 1)->count();

        $total = Venta::where('estado', 1)->sum('total');

        $totalProductos = ComprobanteDetalle::sum('cantidad');

        //$user->hasPermissionTo($permissionName, $guardName);


        //return view('clientes.index', compact('clientes'));
        return view('pedidos.index')->with('pedidos', $pedidos)->with('comprobantes', $comprobantes)->with('total', $total)->with('totalProductos', $totalProductos);

    }

    public function detail($id)
    {

        $comprobante = Venta::find($id);

        $detalle = ComprobanteDetalle::where('comprobante_id', $id)->get();
        //$pedidos->comprobante();

        $total = Venta::where('estado', 1)->sum('total');

        return view('pedidos.detail')->with('detalle', $detalle)->with('total', $total)->with('comprobante', $comprobante);

    }

    public function create(Request $request)
    {
        

            //return view('pedidos.create', compact('productos'));

            

            $productos = Producto::search($request->get('nombre'))->paginate();

            return view('pedidos.create', compact('productos'));
            //return response($productos);


        

        //return view('clientes.index', compact('clientes'));
        //return view('pedidos.create')->with('productos', $productos);

        
        


        //return view('auth.login');
    }

    public function store(Request $request)
    {

        /*try
        {
            $venta = new Venta();
            $venta->nombre           =$request->nombre;
            $venta->apellido         =$request->apellido;
            $venta->ruc              =$request->ruc;
            $venta->telefono         =$request->telefono;
            $venta->email            =$request->email;
            $venta->direccion        =$request->direccion;
            $venta->ciudad           =$request->ciudad;
            $venta->save();

            return redirect('/pedidos');
        }
        catch(Exception $e)
        {
            return "Fatal error - "-$e->getMessage();
        }*/
        $i = 1;

        foreach ($venta as $venta) {
            $i++;
            $venta = new ComprobanteDetalle();
            $venta->comprobante_id           =$request->cartid;
            $venta->producto_id              =14;
            $venta->cantidad                 =$request->item_quantity_.$i;
            $venta->save();
        }

        //return response($productos);

    }

    public function edit($id)
    {

        $clientes = Cliente::find($id);

        return view('clientes.edit')->with('clientes', $clientes);
    }


    public function update($id, Request $request)
    {
        $cliente = Cliente::find($id);
        $cliente->nombre            =$request->nombre;
        $cliente->apellido          =$request->apellido;
        $cliente->ruc               =$request->ruc;
        $cliente->telefono          =$request->telefono;
        $cliente->email             =$request->email;
        $cliente->direccion         =$request->direccion;
        $cliente->ciudad            =$request->ciudad;
        $cliente->save();

        return redirect('/clientes');

    }

    public function destroy($id)
    {
        $clientes = Cliente::find($id);
        $clientes->delete();

        return redirect('/clientes');

    }

    public function search($q)
    {

        $search = urldecode($q);
        $productos = Producto::select()
                ->where('nombre', 'LIKE', '%'.$search.'%')
                ->orderBy('id', 'desc')
                ->get();

        //return view('pedidos.create', compact('productos'));
        
        return response($productos);


    }




}
