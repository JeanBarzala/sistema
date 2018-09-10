@extends('layouts.app')
@section('header')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
@endsection
@section('content')
<div class="header-page">
	<div class="container">
	    <div class="row">
	        <div class="col-lg-9">
	            <h3>Cobros</h3>
	        </div>
	        {{--
	        <div class="col-lg-3">
	            <ul class="nav-nav navbar-right">
	                <li><a href="{{ url('/clientes/create') }}" class="btn btn-primary">Nuevo contacto</a></li>
	                <li class="sub-menu">
	                    <a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true"><i class="fa fa-bars" aria-hidden="true"></i></a>
	                    <ul class="dropdown-menu" role="menu">                        
	                      <li><a href="{{ url('clientes') }}"><i class="fa fa-address-book" aria-hidden="true"></i> Todos los contactos</a></li>
	                    </ul>
	                </li>
	            </ul>
	        </div>
	        --}}
	    </div>
	</div>
</div>
<div class="container">
	<form method="post" action="{{ route('ventas.cobros.consultar') }}">
		@csrf
        <div class="panel panel-default panel-content">
            <div class="panel-heading">
                Filtrar cobros
            </div>
            <div class="panel-body">
                <div class="row">
                	<div class="col-lg-3">
                    	<label>Cliente</label>
                    	<input type="text" name="cliente" class="form-control cliente">
                    	<input type="hidden" name="id_cliente" class="id_cliente">
                    </div>
                    <div class="col-lg-3">
                        <label>Nro. Pedido</label>
                        <input type="text" name="nro_pedido" class="form-control nro_pedido" autocomplete="off">
                    </div>
                    
                    <div class="col-lg-3">
                        <label>Desde</label>
                        <input type="date" name="desde" class="form-control desde" value="{{ old('desde') }}">
                    </div>
                    <div class="col-lg-3">
                        <label>Hasta</label>
                        <input type="date" name="hasta" class="form-control hasta" value="{{ old('hasta') }}">
                    </div>
                </div>
            </div>
            <div class="panel-footer text-right">
            	<button class="btn btn-primary reset" type="reset">Borrar campos</button>
                <button class="btn btn-primary-inverse">Consultar</button>
            </div>
        </div>
    </form>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Resultados
				</div>
				<div class="panel-body">

					@if(count($cobros))
					@foreach($cobros as $pedido)
					<table class="table table-condensed">
						<thead>
							<th># Pedido</th>
							<th>Cliente</th>
							<th>Fecha de cobro</th>
							<th>Hasta</th>
							<th>Dirección</th>
							<th>Teléfono P.</th>
							<th>Acciones</th>
						</thead>
						<tbody>
							<tr>
								<td>{{ $pedido->id_pedido }}</td>
								<td>{{ $pedido->cliente->persona->getFullName() }}</td>
								<td>{{ $pedido->fecha_hora_cobro_pedido }}</td>
								<td>{{ $pedido->hora_cobro_hasta }}</td>
								<td>{{ $pedido->direccion_cobro->getFullDireccion() }}</td>
								<td>{{ $pedido->hora_cobro_hasta }}</td>
								<td class="text-right">
									<a href="#" class="btn btn-xs btn-primary-inverse">Cobrar</a>
								</td>
							</tr>
						</tbody>
					</table>
					@endforeach
					@else
					<p class="text-center">No tenemos resultados para tu búsqueda.</p>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
@section('footer')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
	$('.reset').click(function () {
		$('.desde').val('');
		$('.hasta').val('');
		$('.nro_pedido').val('');
		$('.cliente').val('');
		$('.id_cliente').val('');
	})

	$(".cliente").autocomplete({
	  source: '{{ route('pedidos.buscarCliente') }}',
	  minLength: 1,
	  select: function(event, ui) {
	      event.preventDefault();
	      $(".id_cliente").val(ui.item.id_cliente);
	   }
	});
</script>
@endsection