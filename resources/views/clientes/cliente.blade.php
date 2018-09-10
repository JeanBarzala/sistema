@if($cliente)
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<h4><b>Detalles de contacto</b></h4>
			<div class="table-list">
				<p><b>Nombre y Apellido: </b>{{ titleCase($cliente->nombre_persona) }}&nbsp;@if($cliente->apellido_persona) {{ titleCase($cliente->apellido_persona) }} @endif</p>

				<p><b>CI: </b>{{ $cliente->num_doc_persona ? $cliente->num_doc_persona : '-' }}</p>

				<p><b>Razón Social: </b> {{ $cliente->razon_social ? $cliente->razon_social : '-' }}</p>

				<p><b>RUC: </b>{{ $cliente->ruc_persona ? $cliente->ruc_persona : '-' }}</p>

				<p><b>Email: </b>{{ $cliente->email_persona ? $cliente->email_persona : '-' }}</p>

				<p><b>Fecha de nacimiento: </b>{{ $cliente->fecha_nac_persona ? $cliente->fecha_nac_persona : '-' }}</p>

				<p><b>Fecha de registro: </b>{{ $cliente->fecha_registro_persona ? $cliente->fecha_registro_persona : $cliente->created_at }}</p>

				<p><b>Observaciones: </b>{{ $cliente->observacion_persona }}</p>
			</div>

			<div class="line"></div>

			<h4><b>Teléfonos</b></h4>
			<ul class="list-default list-direcciones">
				@php $i = 1; @endphp
				@forelse($telefonos as $telefono)
				<li>
				<span><b>{{ $i++ }}.</b></span>

				<p>@if($telefono->tipo_telefono == 'F') Fijo -  @elseif($telefono->tipo_telefono == 'M') Movil - @endif {{ $telefono->numero_telefono }}</p>
				</li>
				@empty
				<li>
				<p>No hay teléfonos registrados para este contacto</p>
				</li>
				@endforelse
			</ul>

			<div class="line"></div>

			<h4><b>Direcciones</b></h4>
			<ul class="list-default list-direcciones">
				@php $i = 1; @endphp
				@forelse($direcciones as $direccion)
				<li>
				<span><b>{{ $i++ }}.</b></span>

				<p>{{ makeDireccion($direccion->calle_direccion, $direccion->interseccion1_direccion, $direccion->interseccion2_direccion, $direccion->numero_direccion, $direccion->nombre_barrio, $direccion->nombre_ciudad) }}</p>
				</li>
				@empty
				<li>
				<p>No hay direcciones para este contacto</p>

				</li>
				@endforelse
			</ul>

		</div>
	</div>
</div>
@endif