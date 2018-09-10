@extends('layouts.app')

@section('content')
<div class="header-page">
<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <h3>Clientes</h3>
        </div>
        <div class="col-lg-8">
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
    </div>
</div>
</div>
<div class="container m_top_30">

  <div class="row">
      <div class="col-lg-12">
          <div class="panel panel-default">
              <div class="panel-body ">
                  <div class="row">
                      <div class="col-lg-12">
                          <div class="form-group">
                              <label>Buscar un cliente</label>
                              <input type="text" class="form-control buscador" name="q" placeholder="Buscar por nombre, apellido, razon social, ruc o ci" autocomplete="off">
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>

<!-- Resultados de la búsqueda, si se presiona una tecla se muestra .result-content y se oculta .result-organic -->
<div class="container result-content">
  <div class="row">
    @include('clientes.clientes')
  </div>
</div>

<div class="container result-organic">
  <div class="row">
    @forelse ($clientes as $cliente)
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="row full-list">
            <div class="col-lg-12 full-list-row">
                <ul>
                    <li class="cliente-id" data-idPersona="{{ $cliente->id_persona }}" data-idCliente="{{ $cliente->clientes->id_cliente }}">
                        <a data-target="#modal-detail" data-toggle="modal" type="button" href="#" title="Ver info de {{ $cliente->getFullName() }}" data-detail="{{ url('clientes/find/'.$cliente->id_persona) }}">
                            <div class="pull-left letter" style="background-color: {{ randColor() }};">{!! $cliente->nombre_persona ? firstLetter($cliente->nombre_persona) : firstLetter($cliente->apellido_persona) !!}</div>
                            <h4 class="colum pull-left">{{ titleCase($cliente->nombre_persona) . ' '. titleCase($cliente->apellido_persona) }}</h4>
                            <h5 class="colum pull-right">{{ $cliente->email_persona }}</h5>
                            <h5 class="colum pull-right">{{ $cliente->num_doc_persona }}</h5>
                        </a>
                        <div class="action-list">
                            <a href="{{ url('clientes' . '/editar' . '/' .$cliente->id_persona ) }}" role="button">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a>
                            <a href="{{ route('informes.estadoCuenta.consultar', ['id_cliente' => $cliente->clientes->id_cliente]) }}" title="Estado de cuenta" target="_blank">
                              <i class="fa fa-file-text-o" aria-hidden="true"></i>
                            </a>
                            <a href="{{ route('clientes.pedidos', ['id' => $cliente->id_persona]) }}" role="button" title="Ver historial {{ $cliente->nombre_persona ? 'de '.titleCase($cliente->nombre_persona) : 'del cliente' }}">
                            <i class="fa fa-history" aria-hidden="true"></i>
                        </a>
                          <a href="#" class="btn-delete" data-toggle="modal" data-target="#modal-cliente" title="Eliminar a {{ $cliente->getFullName() }}" data-title="{{ $cliente->getFullName() }}" data-route="{{ route('clientes.delete', ['id_persona' => $cliente->id_persona]) }}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @empty
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3 col-sm-6 col-md-4 col-xs-12 item-cliente m_top_30">
            <div class="panel panel-default">
                <div class="panel-body text-center">
                    Aún no hay clientes registrados.
                </div>
            </div>
        </div>
    </div>
    @endforelse
  </div>
  @if(count($clientes))
  <div class="row">
    <div class="col-lg-12 text-center">
      {{ $clientes->links() }}
    </div>
  </div>
  @endif
</div>


<div class="modal modal-detail fade" id="modal-detail" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
              <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Cliente</h4>
          </div>
      <div class="modal-body">
      
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
        
    </div>
    
  </div>
</div>



<div class="modal fade" id="modal-cliente">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Eliminar cliente</h4>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de eliminar el cliente <b><span id="cliente_title"></span></b>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                {!! Form::open(['method' => 'post']) !!}
                    {!! Form::button('Sí, eliminar cliente', ['class' => 'btn btn-danger', 'type' => 'submit']) !!}
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
$(document).on('click', '.btn-delete', function(){
  $('.modal form').attr('action', $(this).data('route'));
  $('#cliente_title').text($(this).data('title'));
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
              url: "{{ url('clientes/buscar') }}",
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

$('.modal-detail').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('detail') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)

    $.ajax({
        method: "POST",
        url: recipient,
        dataType:  'html',
        beforeSend: function(){
              //imagen de carga
              //$(".modal-body .loader").html("<div class='carga'><img src='{{ url('img/loader.gif') }}' /></div>");
        },
        success : function(data) {
            console.log(recipient);
            $('.modal-detail .modal-body').html(data);
        }
    })
  
})                              
});    


</script>
@endsection
