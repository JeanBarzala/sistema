<?php

namespace App\Http\Controllers;
use App\Proveedor;
use Illuminate\Http\Request;

class ProveedoresController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $request;
    private $proveedor;

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

        $proveedores = Proveedor::paginate();

        //return view('proveedores.index', compact('proveedores'));
        return view('proveedores.index')->with('proveedores', $proveedores);

    }

    public function create()
    {
        return view('proveedores.create');

        //return view('auth.login');
    }

    public function store(Request $request)
    {

        try
        {
            $proveedor = new Proveedor();
            $proveedor->nombre     =$request->nombre;
            $proveedor->apellido     =$request->apellido;
            $proveedor->ruc     =$request->ruc;
            $proveedor->telefono     =$request->telefono;
            $proveedor->email     =$request->email;
            $proveedor->direccion     =$request->direccion;
            $proveedor->ciudad     =$request->ciudad;
            $proveedor->save();

            return redirect('/proveedores');
        }
        catch(Exception $e)
        {
            return "Fatal error - "-$e->getMessage();
        }
    }

    public function edit($id)
    {

        $proveedores = Proveedor::find($id);

        return view('proveedores.edit')->with('proveedores', $proveedores);
    }


    public function update($id, Request $request)
    {
        $proveedor = Proveedor::find($id);
        $proveedor->nombre     =$request->nombre;
        $proveedor->apellido     =$request->apellido;
        $proveedor->ruc     =$request->ruc;
        $proveedor->telefono     =$request->telefono;
        $proveedor->email     =$request->email;
        $proveedor->direccion     =$request->direccion;
        $proveedor->ciudad     =$request->ciudad;
        $proveedor->save();

        return redirect('/proveedores');

    }

    public function destroy($id)
    {
        $proveedores = Proveedor::find($id);
        $proveedores->delete();

        return redirect('/proveedores');

    }
}
