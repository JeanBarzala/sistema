@extends('layouts.app')

@section('content')
<div class="header-page">
<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <h3>Informes</h3>
        </div>
        <div class="col-lg-8">
            <ul class="nav-nav navbar-right">
              <!--<li>
                  <div class="search-input">
                      <i class="fa fa-search" aria-hidden="true"></i>
                      <input type="text" name="b" placeholder="Buscar">
                  </div>
              </li>-->
              {{--
              <li>
                <a href="{{ route('ventas.pedidos.pos') }}" class="btn btn-primary">Nuevo pedido</a>
              </li>
              --}}
              
              {{--
              <li class="sub-menu">
                    <a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true"><i class="fa fa-bars" aria-hidden="true"></i></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#">Listar ventas</a></li>
                      <li><a href="#">Reporte de venta</a></li>
                      <li><a href="#">Filtro de venta</a></li>
                    </ul>
                </li>
              --}}
            </ul>
        </div>
    </div>
</div>
</div>
<div class="container m_top_30">
	<div class="row">
	    <div class="col-lg-12">
	        <div class="panel panel-default">
	            <div class="panel-body">
	                <div class="row">
	                    <div class="col-lg-12">
	                        <div class="form-group">
	                            <label>Buscar un cliente</label>
	                            <input type="text" name="b" placeholder="Ingrese nombre, apellido o ID de cliente" class="form-control buscador">
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</div>

@endsection