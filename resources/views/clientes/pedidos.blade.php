@extends('layouts.app')

@section('content')
<div class="header-page">
	<div class="container">
	    <div class="row">
	        <div class="col-lg-6">
	            <h3>Resumen</b></h3>
	        </div>
	        <div class="col-lg-6">
	            <ul class="nav-nav navbar-right">
	                <li>
						<a href="{{ url('/clientes') }}" class="btn btn-primary">
						<i class="fa fa-chevron-left" aria-hidden="true"></i>
						Atrás
						</a>
	              	</li>
	                <li class="sub-menu">
	                    <a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true"><i class="fa fa-bars" aria-hidden="true"></i></a>
	                    <ul class="dropdown-menu" role="menu">
	                        
	                        <li><a href="{{ url('clientes') }}"><i class="fa fa-address-book" aria-hidden="true"></i> Todos los contactos</a></li>
	                        <li><a href="{{ url('contactos/frecuentes') }}"><i class="fa fa-history" aria-hidden="true"></i> Contactos frecuentes</a></li>

	                    </ul>
	                </li>
	            </ul>
	        </div>
	    </div>
	</div>
</div>

<div class="container m_top_30">
	<div class="row">
		<div class="col-lg-12">
			<div class="jumbotron bg-default">
		      <div class="container">
		        <div class="row">
		          <div class="col-lg-12">
		            <div class="title">
		              <h2>{{ $cliente->persona->getFullName() }}</h2>
		            </div>
		          </div>
		        </div>
		        <div class="row">
		          <div class="col-lg-4 text-left">
		            <div class="title">
		              <h3>Total pedidos, <b><br>{{ gs($totalpedidos) }}</b></h3>
		            </div>
		          </div>
		          <div class="col-lg-4 text-center">
		            <div class="title">
		              <h3>Total productos, <b><br>{{ $detalle }}</b></h3>
		            </div>
		          </div>
		          <div class="col-lg-4 text-right">
		            <div class="title">
		              <h3>Total en guaranies, <b><br>{{ gs($totalgs, 1) }}</b></h3>
		            </div>
		          </div>
		        </div>
		      </div>

		  </div>
		</div>
	</div>
	@forelse($pedidos as $pedido)
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default panel-content">
				<div class="panel-heading panel-heading-flex">
					<div class="heading">
						<p>Pedido realizado el:</p>
						<p>{{ $pedido->fecha_hora_recibe_pedido }}</p>
					</div>
					<div class="heading">
						<p>Total:</p>
						<p>{{ gs($pedido->total_importe_pedido, 1) }}</p>
					</div>
					<div class="heading">
						<p>Enviado a:</p>

						@if($pedido->id_direccion_envio_pedido)
						<p>{{ $pedido->direccion->getFullDireccion() }}</p>
						@else
						<p>Retirado desde el salón</p>
						@endif						
					</div>
					<div class="heading text-right">
						<p>Pedido N.° {{ $pedido->id_pedido }}</p>
						{{--<p><a href="#">Detalles del pedido</a> | <a href="#">Ver factura</a> | <a href="#">Ver nota de pedido</a></p>--}}
					</div>
				</div>
				<div class="panel-body">
					@if($pedido->id_direccion_envio_pedido)
					@if($pedido->estado_envio_pedido == 'ENTREGADO')
					<h4>Entregado el: <b>{{ $pedido->fecha_hora_registro_recibe_pedido }}</b></h4>
					<p>El recibo de entrega fue firmado por <b>{{ $pedido->persona_recibe_pedido }}</b></p>
					<p>Vendido por: {{ $pedido->usuario->name .'- '. $pedido->usuario->persona->getFullName() }}</p>
					@endif
					@endif
					@if($pedido->comprobantes)
					<table class="table table-hover">
						<tbody>
							@foreach($pedido->comprobantes as $detalle)
							<tr>
								<td style="padding-right: 15px;">
                                    @if($detalle->imagen_path)
                                    <img src="{{ url('upload/preoductos/img_normal'.$detalle->imagen_path) }}" class="thumbnail">
                                    @else
                                    <img src="{{ url('img/no-image.png') }}" class="thumbnail" style="max-width: 100px;">
                                    @endif
                                </td>
								<td>
								<p>{{ $detalle->productos->nombre_producto .' | '. $detalle->productos->descripcion_producto  }}</p>
								
								<p>Obs: <b>{{ $detalle->observacion_detalle_pedido ? $detalle->observacion_detalle_pedido : 'No hay observaciones' }}</b></p>
								<p>Descripción: <b>{{ $detalle->descripcion_detalle_pedido }}</b></p>
								<p>Cantidad: <b>{{ $detalle->cantidad_detalle_pedido }}</b></p>
								<p>Sub-total: <b>{{ gs($detalle->monto_detalle_pedido, 1) }}</b></p>
								<p>Total: <b>{{ gs($detalle->monto_detalle_pedido * $detalle->cantidad_detalle_pedido, 1) }}</b></p>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					@endif
				</div>
			</div>
		</div>
	</div>
	@empty
	<div class="row">
		<div class="col-lg-12 text-center">
			<h1 class="text-center"><i class="fa fa-frown-o" aria-hidden="true"></i></h1>
			<p class="text-center">{{ $cliente->persona->nombre_persona }} aún no realizo pedidos</p>
			<p class="text-center"><a href="{{ url()->previous() }}" class="return-back _n26"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a></p>
		</div>
	</div>
	@endforelse
</div>
@endsection