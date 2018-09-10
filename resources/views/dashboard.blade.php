@extends('layouts.app')

@section('content')
<div class="home" style="min-height: calc(100vh - 50px); background-image: /*url('https://source.unsplash.com/category/nature/1600x900');*/">
	<div class="jumbotron" style="background-image: url('img/4858eb73.jpg'); background-size: cover; margin-bottom: 0px; background-position: center center; padding-top: 100px;">
	    <div class="container">
	        <div class="row">
	            <div class="col-lg-12 text-center title">
	                <h2 class="animated fadeInDown">Bienvenido, {{ Auth::user()->name }}</h2>
	                {{--<p>Tu último inicio de sesión fue el 25/05/2017 14:36</p>--}}
	                <p>
	                @if(Auth::user()->hasRole('GERENTE'))
					    Acceso como <b>administrador</b>
					@else
					    Acceso <b>usuario</b>
					@endif
					</p>
	            </div>
	        </div>
	    </div>
	</div>
	<div class="container m_top_30">
		@if(Auth::user()->hasAnyRole(['GERENTE']))
		<div class="row">
			<div class="col-lg-3">
				<div class="panel panel-default">
					<div class="panel-body">
						<span class="c-icon c-icon--info u-mb-small">
		                  <i class="fa fa-line-chart" aria-hidden="true"></i>
		                </span>
						<h4 class="c-text--subtitle">Ventas semanales</h4>
						<h3>0 {{-- gs($pedidos, '')  $hoy --}}</h3>
					</div>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="panel panel-default">
					<div class="panel-body">
						<span class="c-icon c-icon--danger u-mb-small">
		                  <i class="fa fa-shopping-cart" aria-hidden="true"></i>
		                </span>
						<h4 class="c-text--subtitle">Total pedidos</h4>
						<h3>@if($pedidosTotal){{ gs($pedidosTotal) }}@else 0 @endif</h3>
					</div>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="panel panel-default">
					<div class="panel-body">
						<span class="c-icon c-icon--success u-mb-small">
		                  <i class="fa fa-users" aria-hidden="true"></i>
		                </span>
						<h4 class="c-text--subtitle">Clientes</h4>
						<h3>@if($clientesTotal){{ gs($clientesTotal) }}@else 0 @endif</h3>
					</div>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="panel panel-default">
					<div class="panel-body">
						<span class="c-icon c-icon--warning u-mb-small">
		                  <i class="fa fa-area-chart" aria-hidden="true"></i>
		                </span>
						<h4 class="c-text--subtitle">Ingresos</h4>
						<h3>@if($pedidosSum){{ gs($pedidosSum, 1) }}@else 0 @endif</h3>
					</div>
				</div>
			</div>
		</div>
		@endif
		
		<div class="row">
			<div class="col-lg-6">
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-body">
								<h3>POS</h3>
								<p>Ingresa al POS para registrar un pedido. Puedes registrar y editar clientes y destinatarios</p>
								<a href="{{ route('ventas.pedidos.pos') }}" class="btn btn-primary-inverse">Comenzar</a>
							</div>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-body">
								<h3>Producción</h3>
								<p>Ingresa a la pantalla de producción y administra los pedidos.</p>
								<a href="#" class="btn btn-primary-inverse">Comenzar</a>
							</div>
						</div>
					</div>		
				</div>
			</div>
			<div class="col-lg-6">
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4>Pedidos recientes</h4>
							</div>
							<div class="panel-body">
								<ul class="list-group feed">
									@if(count($ultimos))
									@foreach($ultimos as $ultimo)
									<li class="list-group-item">
										<a href="#">
										<p>Pedido <b>#{{ $ultimo->id_pedido}}</b>@if($ultimo->cliente->persona->getFullName()) de <b>{{ $ultimo->cliente->persona->getFullName() }} </b>@endif</p>
										<p class="u-text-xsmall">{{ humans($ultimo->fecha_hora_recibe_pedido) }}</p>
										</a>
									</li>
									@endforeach
									@endif
								</ul>
							</div>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4>Productos recientes</h4>
							</div>
							<div class="panel-body">
								<ul class="list-group">
									@if($productos)
									@foreach ($productos as $producto)
								  	<li class="list-group-item">
								  		<p>{{ $producto->nombre_producto }} - {{ $producto->descripcion_producto }}</p>
								  		<small><em>{{ $producto->created_at }}</em></small>
								  	</li>
								 	@endforeach
								 	@else
								 	<li class="list-group-item">
								 		<p>No hay datos para mostrar</p>
								 	</li>
								 	@endif
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="row">
			
		</div>


		<div class="row">
			@if(count($aniversario))
			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4>Próximos aniversarios</h4>
					</div>
					<div class="panel-body">
						<ul class="list-group">
							
							@forelse($aniversario as $cliente)
							@if(!empty($cliente->fecha_ncto_persona))
							<li class="list-group-item">
						  		<p>{{ $cliente->getFullName() }}</p>

						  		<small><em>@if(date_format(date_create($cliente->fecha_ncto_persona), 'm/d') == $hoy) {!! '<i class="fa fa-birthday-cake" aria-hidden="true"></i> '. $cliente->fecha_ncto_persona . ' - Hoy es su cumpleaños' !!} @else {{ $cliente->fecha_ncto_persona }} @endif</em></small>
						  	</li>
						  	@endif
							@empty
							<li class="list-group-item"><p>No hay anirvesarios en esta temporada</p></li>
							@endforelse
							
						</ul>
					</div>
				</div>
			</div>
			@endif
		</div>
	</div>
</div>
@endsection

@section('script')
<script>
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Enero", "Febrero", "Marzo"],
        datasets: [{
            label: 'Datos',
            data: [0, 0, 0],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>
@endsection
