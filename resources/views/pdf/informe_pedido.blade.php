<!DOCTYPE html>
<html>
<head>
	<title>{{ env('APP_NAME') }} - Informe completo de Pedido</title>
</head>

<link href="{{ url('css/bootstrap.css') }}" rel="stylesheet" type="text/css" media="all" />
<style type="text/css">
/*tbody:nth-child(odd) { background: #f5f5f5;  border: solid 1px #ddd; }
tbody:nth-child(even) { background: #e5e5e5;  border: solid 1px #ddd; }*/
body {
	font-size: 16px;
}
.second-tr {
	background-color: #f2f2f2;
}
</style>
<body>
	<div class="content">
		<div class="container">
			<img src="{{ url('img/brand.png') }}" class="img-responsive center-block" style="display: block; max-width: 100px; margin-bottom: 15px;">
			<h2 style="background: #f2f2f2; padding-top: 15px; padding-bottom: 15px; padding-left: 15px;">Informe de pedido: <b>#{{ $pedido->id_pedido }}</b></h2>
			<table class="table table-bordered">
				<tr class="active">
					<td>{{ $pedido->fecha_hora_pedido }}</td>
					<td>{{ gs($pedido->total_importe_pedido, '') }}</td>
					<td>{{ $pedido->estado_pedido }}</td>
				</tr>
			</table>
			<div class="row">
				<div class="col-lg-6">
					<p>Fecha y hora: <b>{{ $pedido->fecha_hora_pedido }}</b></p>
					<p>Cliente: <b>@if($pedido->cliente){{ $pedido->cliente->persona->getFullName() }}@endif</b></p>
					<p>Destinatario: <b>@if($pedido->persona){{ $pedido->persona->getFullName() }}@elese - @endif</b></p>
					<p>Usuario: <b>{{ $pedido->usuario->name }} - {{ $pedido->usuario->persona->getFullName() }}</b></p>
				</div>
			</div>
		</div>
		<div class="container">
			<h2>Venta</h2>
			<table class="table table-bordered">
				<thead>
					<th>Producto</th>
					<th>Código Int.</th>
					<th>Cantidad</th>
					<th>Precio</th>
					<th>Total</th>
				</thead>
				
				<tbody>
					@foreach($pedido->comprobantes as $detalle)
					<tr>
						<td>
							<b>{{ $detalle->productos->nombre_producto }}</b><br>
							{{ $detalle->productos->descripcion_producto }}
						</td>
						<td>
							{{ $detalle->productos->codigo_producto }}
						</td>
						<td>
							{{ $detalle->cantidad_detalle_pedido }}
						</td>
						<td>
							{{ gs($detalle->monto_detalle_pedido, '') }}
						</td>
						<td>
							{{ gs($detalle->monto_detalle_pedido * $detalle->cantidad_detalle_pedido, '')  }}
						</td>
					</tr>
					@endforeach
					<tr>
						<td colspan="4" style="text-align: right;">Total:</td>
						<td>{{ gs($pedido->total_importe_pedido, '') }}</td>
					</tr>
				</tbody>
				
			</table>

			<table class="table table-bordered">
				<tr>
					<td><b>Forma de pago:</b></td>
					<td class="text-left">@if($pedido->estado_pedido == 'A PAGAR') - @else $pedido->condicion_venta_pedido @endif</td>
				</tr>
				<tr class="active">
					<td><b>I.V.A</b></td>
					<td class="text-left">{{ gs(iva($pedido->total_importe_pedido, 10))  }}</td>
				</tr>
				<tr>
					<td><b>Estado toma:</b></td>
					<td class="text-left">{{ $pedido->estado_toma_pedido }}</td>
				</tr>
				<tr class="active">
					<td><b>Motivo:</b></td>
					<td class="text-left">{{ $pedido->motivo->nombre_motivo }}</td>
				</tr>
				<tr>
					<td><b>Observación:</b></td>
					<td class="text-left">{{ $pedido->observacion_pedido }}</td>
				</tr>
				<tr class="active">
					<td><b>Realiza Pedido:</b></td>
					<td class="text-left">{{ $pedido->nombre_contacto_pedido }}</td>
				</tr>
				<tr>
					<td><b>Teléfono Contacto:</b></td>
					<td class="text-left">{{ $pedido->telefono_entrega_pedido }}</td>
				</tr>
				<tr class="active">
					<td><b>Teléfono adicional:</b></td>
					<td class="text-left">{{ $pedido->telefono_adicional_pedido }}</td>
				</tr>
			</table>
			<h2>Impresiones</h2>
			<table class="table table-bordered">
				<tr>
					<td><b>Notas de Pedido:</b></td>
					<td class="text-left"> {{ $pedido->nro_impresion_nota_pedido ? $pedido->nro_impresion_nota_pedido : '0' }}</td>
				</tr>
				<tr>
					<td><b>Imprimir Factura:</b></td>
					<td class="text-left">@if($pedido->imprimir_pedido) Sí @else No @endif</td>
				</tr>
				<tr>
					<td><b>Imprimir Remisión:</b></td>
					<td class="text-left">@if($pedido->remision_pedido) Sí @else No @endif</td>
				</tr>
			</table>
		</div>
	</div>
</body>
</html>