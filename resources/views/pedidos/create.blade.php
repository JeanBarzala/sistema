@extends('layouts.app')
@section('header')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<meta name="pedidos.buscarCliente" content="{{ route('pedidos.buscarCliente') }}">
<meta name="pedidos.buscarDestinatario" content="{{ route('pedidos.buscarDestinatario') }}">
<meta name="pedidos.buscarTargeta" content="{{ route('pedidos.buscarTarjeta') }}">
<meta name="pedidos.ClienteDirecciones" content="{{ route('pedidos.ClienteDirecciones') }}">
<meta name="pedidos.DestinatarioDirecciones" content="{{ route('pedidos.DestinatarioDirecciones') }}">
<meta name="pedidos.DestinatarioTelefonos" content="{{ route('pedidos.DestinatarioTelefonos') }}">
<meta name="pedidos.findCliente" content="{{ route('pedidos.findCliente') }}">
@endsection
@section('content')
<div class="header-page">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4">
            <h3>Registrar una pedido</h3>
        </div>
        <div class="col-lg-8">
            <ul class="nav-nav navbar-right">
                <li>
                  <a href="{{ route('ventas.pedidos') }}" class="btn btn-primary">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i> Atrás
                  </a>
                </li>
                <li class="sub-menu">
                    <a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                      Caja
                      <i class="fa fa-angle-down" aria-hidden="true"></i>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#" data-toggle="modal" data-target="#modal-default" data-title="" data-route="">Apertura/Cierre</a></li>
                        <li><a href="#">Pago/Ingreso</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#modal-descuento" data-title="" data-route="">Descuentos</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
</div>

<div class="page-pedidos">
<div class="container-fluid m_top_30">
  <div class="row">
    <div class="col-lg-2">
      @include('pedidos.includes.tab-nav')
    </div>
    <!-- contenedor lista de productos a agregar -->
    <div class="col-lg-6">
      <!-- Tab panes -->
      <div class="tab-content">
        @include('pedidos.includes.tab-home')
        @include('pedidos.includes.tab-general')
        @include('pedidos.includes.tab-cliente')
        @include('pedidos.includes.tab-envio')
        @include('pedidos.includes.tab-tarjeta')
      </div>
    </div><!-- fin lista de productos a agregar -->
    <div class="col-lg-4" >
      <div class="panel panel-default" >
        <div class="panel-body">
          <div class="cart-top">
            <h2>
              <div class="" id="total-cart"></div>
              <small><div class="" id="descuento-cart"></div></small>
            </h2>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <label>Transacción</label>
                <select class="form-control" name="transaccion">
                  <option value="venta" selected>Venta</option>
                  {{--<option value="pago">Pago</option>--}}
                </select>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>Usuario</label>
                <input type="text" name="nroventa" class="form-control" id="nroventa" value="{{ Auth::user()->name . ' - ' . Auth::user()->persona->nombre_persona }}" readonly>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>Documento</label>
                <select class="form-control" name="documento" id="documento">
                  <option value="factura" selected>Factura</option>
                  <option value="ticket">Ticket</option>
                </select>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>Condición de venta</label>
                <select class="form-control" name="condicion-venta" id="condicion-venta">
                  <option value="CONTADO">Contado</option>
                  <option value="CREDITO">Credito</option>
                </select>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>Forma de pago</label>
                <select class="form-control" name="forma-pago" id="forma-pago">
                  <option value="efectivo">Efectivo</option>
                  <option value="tarjeta">Tarjeta</option>
                  <option value="cheque">Cheque</option>
                  <option value="transferencia">Trans. Bancaria</option>
                  <option value="tigo-money">Tigo Money</option>
                </select>
              </div>
            </div>

            <div class="col-lg-12">
              <div class="form-group">
                <label>Motivo</label>
                <select class="form-control motivo-select" name="motivo" id="motivo">
                  <option value="">Selecciona un motivo</option>
                  @foreach($motivos as $motivo)
                  <option value="{{ $motivo->id_motivo }}">{{ $motivo->nombre_motivo }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" id="factura"> Imprimir factura
                  </label>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" id="remision"> Imprimir remisión
                  </label>
                </div>
              </div>
            </div>
            
            <div class="col-lg-12">
              <div class="form-group">
                <label>Observación</label>
                <textarea class="form-control" id="observacion"></textarea>
              </div>
            </div>
          </div>
          <div class="text-right">
            <button class="btn btn-primary-inverse btn-lg checkout text-right" value="guardar">Guardar pedido</button>
            <button class="btn btn-success btn-lg text-right"  data-toggle="modal" data-target="#modal-cobrar"><i class="fa fa-check-circle" aria-hidden="true"></i> ¡Cobrar!</button>
          </div>
        </div>
        <div></div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div id="results">

      </div>
    </div>
  </div>

</div>
</div>
@include('pedidos.includes.modal-cobrar')
@include('pedidos.includes.modal-caja')
@include('pedidos.includes.modal-descuento')
@include('clientes.includes.modal-registrar-telefono')

<div class="fix-loader"></div>
@include('pedidos.pedido-form')
@endsection
@section('script')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{ url('js/pedidos.js') }}"></script>

<style type="text/css">
.table-cart .item-count, .table-cart .item-comentario, .table-cart input {
  display: block;
  width: 100%;
  height: 100%;
  border: none;
  background: #e9ebee;
  padding: 8px;
  outline: none;
}
.select2 {
  display: block!important;
  width: 100%;
}
</style>
<script type="text/javascript">
var areYouReallySure = false;
function areYouSure() {
    if(allowPrompt){
        if (!areYouReallySure && true) {
            areYouReallySure = true;
            var confMessage = "Test";
            return confMessage;
        }
    }else{
        allowPrompt = true;
    }
}

var allowPrompt = true;
window.onbeforeunload = areYouSure;
</script>

@endsection