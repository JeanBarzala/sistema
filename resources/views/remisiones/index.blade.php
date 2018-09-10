@extends('layouts.app')

@section('content')
<div class="header-page">
<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <h3>Facturas</h3>
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
                                <label>Buscar una remisión</label>
                                <input type="text" name="b" placeholder="Ingrese número de remisión" class="form-control buscador">
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
          <div class="panel-body result-organic">
            <div class="row">
              <div class="col-lg-12">
                @if (count($remisiones) >= 1)
                <table class="table table-condensed table-hover">
                    <thead>
                      <tr>
                        <th>Remision N°</th>
                        <th>Persona-Recibe</th>
                        <th>Fecha/Hora recepeión</th>
                        <th>Fecha/Hora registro</th>
                        <th>Obs</th>
                        <th>Estado</th>
                        
                        <th class="text-right">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($remisiones as $remision)
                        <tr>
                          <td>{{ $remision->makeNumero() }}</td>
                          <td>{{ $remision->persona_recibe_remision ? $remision->persona_recibe_remision : '-' }}</td>
                          <td>{{ $remision->fecha_hora_recepcion ? $remision->fecha_hora_recepcion : '-' }}</td>
                          <td>{{ $remision->fecha_registro_recepcion }}</td>
                          <td>{{ $remision->observacion_remision ? $remision->observacion_remision : '-' }}</td>
                          <td>
                            @if ($remision->fecha_anulacion_remision)
                            <span class="label label-danger">{{ $remision->fecha_anulacion_remision }}</span>
                            @else
                            <span class="label label-success">APROBADA</span>
                            @endif
                          </td>
                          <td class="text-right">
                              
                              @if(Auth::user()->hasAnyRole('GERENTE', 'ADMINISTRADOR'))
                              <a href="#" class="btn btn-default btn-sm">Anular</a>
                              @endif
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                  @else
                  <div class="row">
                    <div class="col-lg-4 col-lg-offset-4 col-sm-6 col-md-4 col-xs-12 item-cliente m_top_30">
                        <div class="thumbnail">
                            <div class="caption">
                                <p class="text-center">Aun no hay comprobanates, registra un nuevo comprobante.</p>
                            </div>
                        </div>
                    </div>
                  </div>
                  @endif
              </div>
            </div>
          </div>
          <div class="panel-body result-content">
             <div class="row"></div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12 text-center">
        {!! $remisiones->links() !!}
      </div>
    </div>
        



</div>

@endsection

@section ('script')
<script type="text/javascript">
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
                $(".result-content > .row").html("<div id='preloader'><div class='loader'>&nbsp;</div></div>");
                },
                ajaxSend: function(){
                //imagen de carga
                $(".result-content > .row").html("<div id='preloader'><div class='loader'>&nbsp;</div></div>");
                },
                error: function(){
                $(".result-content > .row").html("Error en la búsqueda.");
                },
                success: function(data){                                                    
                $(".result-content > .row").empty();
                $(".result-content > .row").append(data);                                                             
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
        $(".result-content > .row").empty();
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

</script>
@endsection
