<?php

namespace App\Http\Controllers;
use App\Producto;
use App\UnidadMedida;
use App\Agrupador;
use App\Ciudad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use App\Http\Requests;
use DB;
use Storage;
use Session;

class ProductosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $request;
    private $producto;
    private $productos;
    private $medida;
    private $familias;
    private $familia;
    private $result;
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
            $q      = $request->q;
            $list   = $request->list;

            // Compruebo si la variable $q esta vacia, si no esta vacia procedo 
            // 
            if (!empty($q)) {
                $result =   Producto::where('descripcion_producto', 'LIKE', '%'.$q.'%')
                            ->where('estado_producto', 1)
                            ->where('es_tarjeta', 0)
                            ->where('deleted', 0)
                            ->orWhere('nombre_producto', 'LIKE', '%'.$q.'%')
                            ->orWhere('precio_producto', 'LIKE', '%'.$q.'%')
                            ->orWhere('codigo_producto', 'LIKE', '%'.$q.'%')
                            ->orderBy('descripcion_producto', 'DESC')->limit(14)->get();

                $total = count($result);
            }
            // Compruebo si la variable $list es igual a "all" lo cual significa que 
            // no se esta realizando una busqueda si no que hay que listar todos los
            // productos
            elseif($list = 'all') {
                $result = Producto::where('estado_producto', 1)->where('es_tarjeta', 0)->paginate('15');
                $total = 0;
            }

             
        }
        // Si la variable $q esta vicia entonces listo todos los productos
        else {

            $result = Producto::where('estado_producto', 1)->where('es_tarjeta', 0)->paginate('15');
            $total = count($result);

        }

        
        // Preparo la vista con los resultados para luego pasarle a la función de javascript
        // Eso es todo
        return View::make('productos.productos')->with('result', $result)->with('total', $total);
    }

    public function index(Request $request)
    {

        $productos = Producto::where('estado_producto', 1)->where('es_tarjeta', 0)->orderBy('id_producto', 'DESC')->paginate('16');
        
        return view('productos.index')->with('productos', $productos); 

    }
    public function create()
    {

        $categorias = Agrupador::where('estado_agrupador', 1)->get();

        return view('productos.create')->with('categorias', $categorias);
    }

    public function store(Requests\StoreProductoRequest $request)
    {
    
        try
        {

            if ($request->file('imagen')) {
                $image = $request->file('imagen')->store('productos/img_normal');
                //$image = Storage::putFile('productos/img_normal', $request->file('imagen'));
                $image = basename($image);
            }else
            {
                $image = '';
            }

            $producto = new Producto();
            $producto->fill($request->only(
                'nombre_producto',
                'descripcion_producto',
                'stock_minimo',
                'costo',
                'stock_actual',
                'precio_producto',
                'observaciones_producto',
                'control_stock',
                'impuesto_producto',
                'estado_producto'
            ))->save();
            //return $producto->id_producto;
            $id = $producto->id_producto;
            $codigo = $request->codigo.$id;
            $producto->fill(['codigo_producto' => $codigo, 'image_path' => $image, 'es_tarjeta' => 0])->save();


            try
            {
                //abort(404);
                DB::table('productos')->where('id_producto', $id)->update(['codigo_producto' => $codigo]);

            }
            catch(Exception $e)
            {
                return "El producto fue creado exitosamente pero hubo un error al generar el código - "-$e->getMessage();
            }

            if ($request->categoria) {
                try
                {
                    
                    foreach ($request->categoria as $value) {
                        //echo $value;
                        DB::table('agrupadores_productos')->insert(
                            ['id_agrupador' => $value, 'id_producto' => $producto->id_producto, 'estado_agrupador_producto' => 'activo', 'created_at' => date("Y-m-d H:i:s")]
                        );
                    }
                }
                catch(Exception $e)
                {
                    return "Error al relacionar categorías con productos - "-$e->getMessage();
                }
            }
            
            

            try
            {
                $saldo = $request->stock_actual * $request->precio_producto;
                
                DB::table('productos_movim')->insert(
                    ['tipo_mov' => 'Entrada', 'id_producto' => $id, 'fecha' => date("Y-m-d H:i:s"), 'cantidad' => $request->stock_actual, 'saldo' => $saldo, 'obs' => 'Existencia incial']
                );
                $producto->fill(['saldo_actual' => $saldo])->save();
                
            }

            catch(Exception $e)
            {
                return "Error al registrar el inventario - "-$e->getMessage();
            }

            
            /*
            */


            $message = 'Producto creado exitosamente';
        
            return redirect('/productos/editar/'.$id)->with('message', $message);
        }
        catch(Exception $e)
        {
            return "Fatal error - "-$e->getMessage();
        }
    }

    public function update(Requests\UpdateProductoRequest $request, $id)
    {
    
        try
        {

            $producto = Producto::find($id);
            $producto->fill($request->only(
                'nombre_producto',
                'descripcion_producto',
                'stock_minimo',
                'costo',
                'precio_producto',
                'observaciones_producto',
                'control_stock',
                'impuesto_producto',
                'estado_producto'
            ))->save();

            $id = $producto->id_producto;
            $codigo = config('cms.prefijo').$id;
            $producto->fill(['codigo_producto' => $codigo, 'es_tarjeta' => 0])->save();

            if ($request->file('imagen')) {
                Storage::delete('productos/img_normal'.$producto->image_path);
                $image = $request->file('imagen')->store('productos/img_normal');
                $image = basename($image);
                $producto->fill(['image_path' => $image])->save();
            }

            try
            {
                DB::table('productos')->where('id_producto', $id)->update(['codigo_producto' => $codigo]);

            }
            catch(Exception $e)
            {
                return "El producto fue creado exitosamente pero hubo un error al generar el código - "-$e->getMessage();
            }

            try
            {
               DB::table('agrupadores_productos')->where('id_producto', $producto->id_producto)->delete();

            }
            catch(Exception $e)
            {
                return "El producto fue creado exitosamente pero hubo un al intentar asingar las nuevas categorías, intentelo de nuevo.  - "-$e->getMessage();
            }

            if ($request->categoria) {
                try
                {
                    foreach ($request->categoria as $value) {
                        DB::table('agrupadores_productos')->insert(
                            ['id_agrupador' => $value, 'id_producto' => $producto->id_producto, 'estado_agrupador_producto' => 'activo', 'created_at' => date("Y-m-d H:i:s")]
                        );
                    }
                }
                catch(Exception $e)
                {
                    return "Error al relacionar categorías con productos - "-$e->getMessage();
                }
            }
            
            if ($request->abastecer) {            
                $saldo = $request->abastecer * $request->precio_producto + $producto->saldo_actual;
                DB::table('productos_movim')->insert(
                    ['tipo_mov' => 'Entrada', 'id_producto' => $id, 'fecha' => date("Y-m-d H:i:s"), 'cantidad' => $request->abastecer, 'saldo' => $saldo, 'obs' => 'Abastecimiento de stock']
                );
                $producto->fill(['saldo_actual' => $saldo])->save();
            }
            

            $message = 'Producto actualizado exitosamente.';
        
            return redirect('/productos/editar/'.$id)->with('message', $message);
        }
        catch(Exception $e)
        {
            return "Fatal error - "-$e->getMessage();
        }
    }


    

    public function edit($id)
    {

        $producto = Producto::find($id);
        $categoriasproductos = DB::select(DB::raw('SELECT * FROM agrupadores, agrupadores_productos WHERE agrupadores.id_agrupador = agrupadores_productos.id_agrupador AND agrupadores.estado_agrupador = 1 AND agrupadores_productos.id_producto = "'.$id.'"'));
        $categorias = Agrupador::where('estado_agrupador', 1)->get();

        if(!empty($producto->image_path)) {
            /*
          foreach($page->child as $child) {
            $files[] = [
              'name' => $child->title ?: $child->src,
              'type' => 'image/jpeg',
              'size' => File::size(public_path().'/uploads/'.$child->src),
              'file' => url('uploads/'.$child->src),
              'data' => [
                'url' => url('uploads/'.$child->src),
                'id' => $child->id,
                'attr' => $child->attr
              ]
            ];
          }*/
          $files[] = [
              'name' => $producto->image_path,
              'type' => 'image/jpeg',
              'size' => 1024,
              'file' => url('upload/productos/img_normal/'.$producto->image_path),
              'data' => [
                'url' => url('upload/productos/img_normal/'.$producto->image_path),
                'id' => $producto->id_producto,
                'attr' => 1
              ]
            ];
          $files = json_encode($files);
        } else {
          $files = null;
        }

        return view('productos.edit', compact('producto', 'categorias', 'categoriasproductos', 'files'));
    }
    public function removeFile(Request $request)
    {
        $image = Producto::select('image_path')->where('id_producto', $request->id)->first();
        Storage::delete(public_path('upload/productos/img_normal/'.$image->image_path));
        

        return 'ok';
    }

    public function detail($id, Request $request)
    { 

        $producto = Producto::find($id);
        $categorias = DB::select(DB::raw('SELECT * FROM agrupadores, agrupadores_productos WHERE agrupadores.id_agrupador = agrupadores_productos.id_agrupador AND agrupadores_productos.id_producto = "'.$id.'"'));

        return View::make('productos.producto', compact('producto', 'categorias'));
    }


    public function softDelete($id, Request $request)
    {
        $producto = Producto::find($id);
        $producto->deleted             =1;
        $producto->save();

        session()->flash('message', 'El producto ha sido eliminado correctamente.');

        return redirect('/productos');

    }


    public function movimiento($id)
    {

        return view('productos.movimiento');
    }
    
}
