<!DOCTYPE html>
<html>
<head>
	<title>Estado de cuenta</title>
</head>

<link href="{{ url('css/bootstrap.css') }}" rel="stylesheet" type="text/css" media="all" />
<style type="text/css">
/*tbody:nth-child(odd) { background: #f5f5f5;  border: solid 1px #ddd; }
tbody:nth-child(even) { background: #e5e5e5;  border: solid 1px #ddd; }*/
.second-tr {
	background-color: #f2f2f2;
}
</style>
<body>
	<div class="content">
		<div class="container">
			<img src="{{ url('img/brand.png') }}" class="img-responsive center-block" style="display: block; max-width: 200px; margin-bottom: 15px;">
			<h4 style="background: #f2f2f2; padding-top: 15px; padding-bottom: 15px;"><b>Estado de cuenta</b></h4>
			
			<div class="row">
				<div class="col-lg-6">
					<p><b>Fecha y hora: {{ date('Y-m-d h:m:s') }}</b></p>
					<p><b>Cliente: {{ $cliente->persona->getFullName() }}</b></p>
					<p><b>Ruc: {{ $cliente->persona->ruc_persona }}</b></p>
					<p><b>Deuda total: {{ gs($deuda, 1) }}</b></p>
				</div>
			</div>
		</div>
		<div class="container">
			<table class="table table-bordered">
				<thead>
					<th>Pedido #</th>
					<th>Fecha</th>
					<th>Realizó el Pedido</th>
					<th>Factura #</th>
					<th>T.Importe</th>
					<th>Saldo</th>
					<th>Usuario</th>
				</thead>
				@foreach($pedidos as $pedido)
				<tbody>
					<tr>
						<td>
							{{ $pedido->id_pedido }}
						</td>
						<td>
							{{ $pedido->fecha_hora_pedido }}
						</td>
						<td>
							{{ $pedido->nombre_contacto_pedido }}
						</td>
						<td>
							@if($pedido->facturas)$pedido->facturas->makeNumero()@else-@endif
						</td>
						<td>
							{{ gs($pedido->total_importe_pedido) }}
						</td>
						<td>
							{{ gs($pedido->saldo_importe_pedido) }}
						</td>
						<td>
							@if($pedido->usuario){{ $pedido->usuario->name }}@endif
						</td>
					</tr>
					@if(count($pedido->movimientos))
					@foreach($pedido->movimientos as $movimiento)
					<tr class="">
						<td colspan="4"></td>
						<td class="second-tr" style="background-color: #f2f2f2;"><b>Detalle de pago:</b></td>
						<td class="second-tr" style="background-color: #f2f2f2;">
							{{ $movimiento->fecha_registro_movimiento_caja }}
						</td>
						<td class="second-tr" style="background-color: #f2f2f2;">
							{{ $movimiento->modalidad_movimiento_caja }}  -  {{ $movimiento->nro_comprobante_pago }}
						</td>
						<td class="second-tr" style="background-color: #f2f2f2;">{{ gs($movimiento->monto_movimiento_caja) }}</td>
					</tr>
					@endforeach
					@else
					<tr class="active">
						<td colspan="8">No se registran pagos para este pedido</td>
					</tr>
					@endif
				</tbody>
				@endforeach
			</table>
		</div>
	</div>
</body>
</html>