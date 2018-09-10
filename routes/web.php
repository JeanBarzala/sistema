<?php

use App\Pedido;
use Illuminate\Support\Facades\View;
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;
use Codedge\Fpdf\Fpdf\Fpdf;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});
*/
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', function(){
    return redirect('/');
});

Auth::routes();


/* Usuario */
Route::get('/account', 'UsuarioController@index');

Route::get('/usuarios', 'UsuarioController@all')->name('usuario.all');
Route::get('/account/create', 'UsuarioController@create')->name('usuario.create');

Route::get('/account/editar/{id}', 'UsuarioController@edit')->name('usuario.edit');
Route::post('/account/creaer', 'UsuarioController@store')->name('usuario.store');
Route::post('/account/editar/{id}/{id_persona}', 'UsuarioController@update')->name('usuario.update');

/* Clientes */
Route::get('/clientes', 'ClienteController@index');
Route::get('/clientes/create', 'ClienteController@create');
Route::post('/clientes', 'ClienteController@store');
Route::get('/clientes/editar/{id}', 'ClienteController@edit');
Route::post('/clientes/editar/{id}/{id_cliente}', 'ClienteController@update')->name('clientes.update');
Route::post('/clientes/editar/ajax', 'ClienteController@updateAjax')->name('clientes.update.ajax');

Route::post('/clientes/direccion/editar/get/{id_direccion}', 'ClienteController@editDireccion')->name('clientes.direccion.edit');
Route::post('/clientes/direccion/editar/{id_direccion}', 'ClienteController@updateDireccion')->name('clientes.direccion.update');

Route::post('/clientes/telefono/editar/get/{id_telefono}', 'ClienteController@editTelefono')->name('clientes.telefono.edit');
Route::post('/clientes/telefono/editar/{id_telefono}', 'ClienteController@updateTelefono')->name('clientes.telefono.update');

Route::post('/clientes/direccion/crear/{id_persona?}', 'ClienteController@storeDireccion')->name('clientes.direccion.store');
Route::post('/clientes/telefono/crear/{id_persona?}', 'ClienteController@storeTelefono')->name('clientes.telefono.store');

Route::get('/clientes/eliminar/{id}', 'ClienteController@destroy');

Route::post('/clientes/find/{id}', 'ClienteController@find');
Route::get('/clientes/pedidos/{id}', 'ClienteController@pedidos')->name('clientes.pedidos');
Route::get('/clientes/estado-cuenta/{id_cliente}', 'ClienteController@estadoCuenta')->name('clientes.estadoCuenta');

/* Gastos */
Route::get('/gastos', 'GastosController@index');


/* Materiales */
Route::get('/materiales', 'MaterialController@index');
Route::get('/materiales/create', 'MaterialController@create');
Route::post('/materiales', 'MaterialController@store');
Route::get('/materiales/edit/{id}', 'MaterialController@edit');
Route::post('/materiales/update/{id}', 'MaterialController@update');
Route::get('/materiales/delete/{id}', 'MaterialController@destroy');


/* Productos */
Route::get('/productos', 'ProductosController@index');
Route::get('/productos/create', 'ProductosController@create');
Route::post('/productos', 'ProductosController@store');
Route::get('/productos/editar/{id}', 'ProductosController@edit');
Route::post('/productos/update/{id}', 'ProductosController@update')->name('productos.update');
Route::get('/productos/delete/{id}', 'ProductosController@destroy');
Route::get('/productos/borrar/{id}', 'ProductosController@softDelete');
Route::post('/productos/detail/{id}', 'ProductosController@detail');
Route::get('/productos/movimiento/{id}', 'ProductosController@movimiento');
Route::post('/productos/image/remove', 'ProductosController@removeFile');


/* Clientes */
Route::get('clientes/buscar', 'ClienteController@buscar');
Route::post('clientes/delete/{id_persona}', 'ClienteController@delete')->name('clientes.delete');

Route::get('productos/buscar', 'ProductosController@buscar');

Route::get('/ciudad/json', 'CiudadController@buscarJson');
Route::get('/barrio/json', 'BarrioController@buscarJson');

Route::get('/categorias', 'AgrupadorController@index');
Route::get('/categorias/crear', 'AgrupadorController@create');
Route::post('/categorias', 'AgrupadorController@store');
Route::get('/categorias/editar/{id}', 'AgrupadorController@edit');

Route::get('/motivos', 'MotivosController@index')->name('motivos.index');
Route::get('/motivos/crear', 'MotivosController@create')->name('motivos.create');
Route::post('/motivos', 'MotivosController@store')->name('motivos.store');
Route::get('/motivos/editar/{id}', 'MotivosController@edit')->name('motivos.edit');
Route::post('/motivos/editar/{id}', 'MotivosController@update')->name('motivos.update');
Route::post('/motivos/eliminar/{id}', 'MotivosController@destroy')->name('motivos.destroy');



/* Ventas */
//Route::get('/pedidos', 'VentaController@index');

Route::get('/pedidos/edit/{id}', 'VentaController@edit');

Route::get('/pedidos/create/{search}', 'PedidosController@create');
Route::post('/pedidos', 'VentaController@store');
Route::post('/pedidos/update/{id}', 'VentaController@update');
Route::post('/pedidos/create/search', 'VentaController@search');
Route::post('/pedidos/consulta/stock', 'PedidosController@consultaStock')->name('pedidos.consultaStock');
Route::get('/pedidos/search/productos', 'PedidosController@buscarProductos')->name('pedidos.buscarProductos');
Route::get('/pedidos/search/pedido', 'PedidosController@buscar')->name('pedidos.buscarPedido');
Route::get('/pedidos/search/cliente', 'PedidosController@buscarCliente')->name('pedidos.buscarCliente');
Route::get('/pedidos/search/destinatario', 'PedidosController@buscarCliente')->name('pedidos.buscarDestinatario');
Route::post('/pedidos/search/tarjeta', 'PedidosController@buscarTarjeta')->name('pedidos.buscarTarjeta');
Route::post('/pedidos/search/clientesdirecciones', 'PedidosController@ClienteDirecciones')->name('pedidos.ClienteDirecciones');
Route::post('/pedidos/search/destinatariodirecciones', 'PedidosController@ClienteDirecciones')->name('pedidos.DestinatarioDirecciones');
Route::post('/pedidos/search/destinatariotelefonos', 'PedidosController@DestinatarioTelefonos')->name('pedidos.DestinatarioTelefonos');
Route::get('/pedidos/imprimir_nota/{id_pedido}', 'PedidosController@imprimirNota');
/* Cambiar estados */
Route::post('/pedidos/estados/{id_pedido}', 'PedidosController@cambiarEstado')->name('pedidos.cambiarEstado');


Route::post('/pedidos/checkout', 'PedidosController@store');
Route::post('/pedidos/cobrar/{id_pedido?}', 'PedidosController@cobrar')->name('pedidos.cobrar');

/* Pedidos */
Route::get('/ventas/pedidos', 'PedidosController@index')->name('ventas.pedidos');
Route::get('/ventas/pedidos/pos', 'PedidosController@create')->name('ventas.pedidos.pos');
Route::get('/ventas/pedidos/{id}', 'PedidosController@detail')->name('ventas.pedidos.detalle');
Route::post('/pedidos/anular/{id}', 'PedidosController@anular')->name('ventas.pedidos.anular');

Route::get('/tarjetas', 'TarjetasController@index')->name('tarjeta.index');
Route::get('/tarjetas/crear', 'TarjetasController@create')->name('tarjeta.create');
Route::post('/tarjetas/crear', 'TarjetasController@store')->name('tarjeta.store');
Route::get('/tarjetas/editar/{id}', 'TarjetasController@edit')->name('tarjeta.edit');
Route::post('/tarjetas/editar/{id}', 'TarjetasController@update')->name('tarjeta.update');
Route::get('/tarjetas/eliminar/{id}', 'TarjetasController@destroy')->name('tarjeta.delete');
Route::post('/ventas/pedidos/caja', 'PedidosController@abrirCaja')->name('ventas.pedidos.caja');

Route::get('/ventas/test', 'PedidosController@test');

Route::get('/monitoreo', 'MonitoreoController@index');
Route::get('/ventas/pedidos/pos/modern', 'PedidosController@posModern')->name('ventas.pedidos.posModern');

Route::post('/pedidos/findCliente', 'PedidosController@findCliente')->name('pedidos.findCliente');


/* Facturas */
Route::get('ventas/facturas', 'FacturasController@facturacion')->name('ventas.facturacion');


/* Remisiones */
Route::get('ventas/remisiones', 'RemisionesController@index')->name('ventas.remisiones');


/* Cobros */
Route::get('ventas/cobros', 'CobrosController@index')->name('ventas.cobranzas');
Route::post('ventas/cobros/consultar', 'CobrosController@consultar')->name('ventas.cobros.consultar');

/* Cajas */

Route::get('cajas', 'CajasController@index')->name('cajas.index');
Route::get('cajas/crear', 'CajasController@create')->name('cajas.create');
Route::get('cajas/editar/{id}', 'CajasController@edit')->name('cajas.edit');

Route::post('cajas/editar/{id}', 'CajasController@update')->name('cajas.update');
Route::post('cajas/crear', 'CajasController@store')->name('cajas.store');
Route::post('cajas/eliminar', 'CajasController@delete')->name('cajas.delete');


/* Bocas facturacion */
Route::prefix('bocas-facturacion')->group(function () {
    Route::get('/', 'BocasController@index')->name('bocas.index');
    Route::get('/crear', 'BocasController@create')->name('bocas.create');
    Route::post('/store', 'BocasController@store')->name('bocas.store');
    Route::get('/editar/{id}', 'BocasController@edit')->name('bocas.edit');
    Route::post('/editar/{id}', 'BocasController@update')->name('bocas.update');
    Route::post('/eliminar/{id}', 'BocasController@destroy')->name('bocas.destroy');
});

/* Talonarios */

Route::prefix('talonarios')->group(function () {
    Route::get('/', 'TalonarioController@index')->name('talonarios.index');
    Route::get('/crear', 'TalonarioController@create')->name('talonarios.create');
    Route::post('/store', 'TalonarioController@store')->name('talonarios.store');
    Route::get('/editar/{id}', 'TalonarioController@edit')->name('talonarios.edit');
    Route::post('/editar/{id}', 'TalonarioController@update')->name('talonarios.update');
    Route::post('/eliminar/{id}', 'TalonarioController@destroy')->name('talonarios.destroy');
});

/* Informes */
Route::prefix('informes')->group(function () {
    Route::get('/estado-de-cuenta', 'ClienteController@estadoCuentaIndex')->name('informes.estadoCuenta.index');
    Route::get('/estado-de-cuenta/{id_persona}', 'ClienteController@estadoCuenta')->name('informes.estadoCuenta.consultar');
    Route::get('/pedido/{id}', 'InformesController@pedido')->name('informes.pedidos');
});


Route::get('/lang/{locale}', function ($locale) {
    App::setLocale($locale);
    return redirect('/');
});

Route::get('/test/db/{valor}', function ($valor) {
    $data = DB::select(DB::raw('SELECT * FROM personas, clientes WHERE personas.id_persona = clientes.id_persona AND personas.estado_persona != "ELIMINADO" AND MATCH(nombre_persona, apellido_persona, num_doc_persona) AGAINST ("Rodrigo Troche") ORDER BY personas.nombre_persona ASC LIMIT 30'));

    return $data;
});

Route::get('/fpdf', function (Codedge\Fpdf\Fpdf\Fpdf $pdf) {

    $pdf->AddPage();
    $pdf->SetFont('Courier', 'B', 18);
    //$pdf->Cell(20,10,'Title',1,1,'C');
    //$fpdf->Output();
    $pdf->Cell(40,10, '<h1>Title</h1>');
    $name = 'pdf-factura-001-002-'.time().'.pdf';
    $header = ['Content-type:application/pdf'];
    //$pdf->Output('S')->store('');
    Storage::put('test/'.$name, $pdf->Output('S'));

});




Route::get('/pdf', function () {
    /*$clientes = App\Persona::has('clientes')->where('estado_persona', '!=', 'ELIMINADO')->where('nombre_persona', '!=', '')->orderBy('nombre_persona', 'ASC')->limit(50)->get();
    $pdf = view('pdf.prueba')->with('clientes', $clientes);
    $pdf = PDF::loadView('pdf.prueba', [
            'clientes' => $clientes,
        ])->setPaper('legal', 'portrait');
    $html = new CssToInlineStyles();
    $css = file_get_contents(url('css/bootstrap.css'));
    $make = response()->make($html->convert($pdf, $css));
    $pdf = PDF::loadHTML($make)->setPaper('A4', 'portrait');*/
    //return view('pdf.prueba', compact('clientes'));
   
   //return $pdf->download();
    //return $make;
    return view('pdf.prueba');
});

Route::get('/pass', function () {
    return bcrypt('123456');
});

Route::get('/test', 'TestController@index');


