@extends('layouts.app')

@section('content')
<div class="header-page">
<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <h3>Pedidos</h3>
        </div>
        <div class="col-lg-8">
            <ul class="nav-nav navbar-right">
              <!--<li>
                  <div class="search-input">
                      <i class="fa fa-search" aria-hidden="true"></i>
                      <input type="text" name="b" placeholder="Buscar">
                  </div>
              </li>-->
              <li>
                <a href="{{ route('ventas.pedidos.pos') }}" class="btn btn-primary">Nuevo pedido</a>
              </li>
              
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
  {{--
    <div class="jumbotron bg-default">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="title">
              <h2>Resumen</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 text-left">
            <div class="title">
              <h3>Total pedidos, <b><br>{{ gs($totalpedidos, 1) }}</b></h3>
            </div>
          </div>
          <div class="col-lg-4 text-center">
            <div class="title">
              <h3>Total en ventas, <b><br>{{ gs($totalgs, 1) }}</b></h3>
            </div>
          </div>
          <div class="col-lg-4 text-right">
            <div class="title">
              <h3>Productos vendidos, <b><br>{{ $detalle }}</b></h3>
            </div>
          </div>
        </div>
      </div>
  --}}

  </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Buscar un comprobante</label>
                                <input type="text" name="b" placeholder="Ingrese número de pedido" class="form-control buscador">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-12">
                @if (count($pedidos) >= 1)
                <table class="table table-condensed table-hover">
                    <thead>
                      <tr>
                        <th>Comprobante N°</th>
                        <th>Cliente</th>
                        <th>Fecha/Hora Pedido</th>
                        <th>Fecha/Hora Entrega</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Situación</th>
                        <th class="text-right">Acciones</th>
                      </tr>
                    </thead>
                    <tbody class="result-organic">
                      @foreach ($pedidos as $pedido)
                        <tr>
                          <td>{{ $pedido->id_pedido }}</td>
                          <td>@if($pedido->cliente->persona->nombre_persona == 'N\N') {{ $pedido->cliente->persona->nombre_persona  }} @else {{ titleCase($pedido->cliente->persona->nombre_persona) . titleCase($pedido->cliente->persona->apellido_persona) }} @endif</td>
                          <td>{{ $pedido->fecha_hora_pedido ? $pedido->fecha_hora_pedido : '-' }}</td>
                          <td>{{ $pedido->fecha_hora_entrega_pedido ? $pedido->fecha_hora_entrega_pedido : '-' }}</td>
                          <td>GS {{ number_format($pedido->total_importe_pedido, '0','0','.') }}</td>
                          <td>
                            @if ($pedido->estado_pedido == 'A PAGAR')
                            <span class="label label-danger">{{ $pedido->estado_pedido }}</span>
                            @else
                            <span class="label label-success">{{ $pedido->estado_pedido }}</span>
                            @endif
                          </td>
                          <td><label class="label label-default">{{ $pedido->estado_toma_pedido }}</label></td>
                          <td class="text-right">
                            <a href="{{ route('ventas.pedidos.detalle', ['id' => $pedido->id_pedido])  }}" class="btn btn-primary btn-sm">Ver detalle</a>
                            <a href="{{ route('informes.pedidos', ['id' => $pedido->id_pedido]) }}" class="btn btn-primary btn-sm" target="_blank">Informe</a>
                            @if(Auth::user()->hasRole('GERENTE'))
                            <a href="#" class="btn btn-danger btn-sm btn-anular" data-toggle="modal" data-target="#modal-anular" data-title="{{ $pedido->id_pedido }}" data-route="{{ route('ventas.pedidos.anular', ['id' => $pedido->id_pedido]) }}">Eliminar</a>
                            @endif
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                    <tbody class="result-content"></tbody>
                  </table>
                  @else
                  <div class="row">
                    <div class="col-lg-4 col-lg-offset-4 col-sm-6 col-md-4 col-xs-12">  
                      <p class="text-center" style="margin-bottom: 0;">Aún no tenemos datos para mostrarte :(.</p>
                    </div>
                  </div>
                  @endif
              </div>
            </div>
          </div>
          
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12 text-center">
        {!! $pedidos->links() !!}
      </div>
    </div>
        



</div>

<div class="modal fade" id="modal-anular">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Anular pedido</h4>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de anular el pedido #<b><span id="pedido_title"></span></b>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                {!! Form::open(['method' => 'post']) !!}
                    {!! Form::button('Sí, anular pedido', ['class' => 'btn btn-danger', 'type' => 'submit']) !!}
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@endsection

@section ('script')
<script type="text/javascript">
$(document).on('click', '.btn-anular', function(){
  $('.modal form').attr('action', $(this).data('route'));
  $('#pedido_title').text($(this).data('title'));
});

$(document).ready(function(){

  //setup before functions
  var typingTimer;                //timer identifier
  var doneTypingInterval = 600;  //time in ms, 5 second for example

  var consulta;
  //hacemos focus al campo de búsqueda
  //$(".buscador").focus();


  function buscar()
  {
    //comprobamos si se pulsa una tecla
    
                                  
          //obtenemos el texto introducido en el campo de búsqueda
          consulta = $(".buscador").val();
          console.log(consulta);

          
          //hace la búsqueda                                                                                  
          $.ajax({
                url: "{{ route('pedidos.buscarPedido') }}",
                data: "q="+consulta,
                dataType: "html",
                beforeSend: function(){
                //imagen de carga
                $(".result-content").html("<div id='preloader'><div class='loader'>&nbsp;</div></div>");
                },
                ajaxSend: function(){
                //imagen de carga
                $(".result-content").html("<div id='preloader'><div class='loader'>&nbsp;</div></div>");
                },
                error: function(){
                $(".result-content").html("Error en la búsqueda.");
                },
                success: function(data){                                                    
                $(".result-content").empty();
                $(".result-content").append(data);                                                             
                }
          });                                                                         
    
  }

  //buscar();

  /*$(".buscador").keyup(function(e){

    buscar();
  })*/

  $('.buscador').on('keyup', function() {
      if (this.value.length > 0) {
        $('.result-organic').hide();
        $('.result-content').show();
        $(".result-content").empty();
        clearTimeout(typingTimer);
        if ($(this).val) {
            typingTimer = setTimeout(function(){
                //do stuff here e.g ajax call etc....
                 buscar();
            }, doneTypingInterval);
        }
      } else {
        $('.result-organic').show();
        $('.result-content').hide();
      }
  });
                          

});    
@if (Session::has('message'))
var mensaje = '{{ Session::get('message') }}';
report(mensaje);
@endif
</script>
@endsection
