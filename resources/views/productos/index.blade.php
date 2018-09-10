
@extends('layouts.app')

@section('content')
<div class="header-page">
<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <h3>Productos</h3>
        </div>
        <div class="col-lg-8">
            <ul class="nav-nav navbar-right">
                <!--<li>
                    <div class="search-input">
                        <i class="fa fa-search" aria-hidden="true"></i>
                        <input type="text" name="b" placeholder="Buscar">
                    </div>
                </li>-->
                <li><a href="{{ url('/productos/create') }}" class="btn btn-primary">Nuevo producto</a></li>
                
                <li class="sub-menu">
                    <a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true"><i class="fa fa-bars" aria-hidden="true"></i></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ url('/categorias/crear') }}">Crear categoría</a></li>
                        <li><a href="{{ url('categorias') }}">Listar categorías</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
</div>

<div class="container m_top_30 productosList" id="productosList">
  <div class="row">
      <div class="col-lg-12">
          <div class="panel panel-default">
              <div class="panel-body ">
                  <div class="row">
                      <div class="col-lg-12">
                          <div class="form-group">
                              <label>Buscar un producto</label>
                              <input type="text" class="form-control buscador" name="q" placeholder="Buscar por nombre, descripción, codigo o precio">
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
    @include('productos.productos')
  </div>
</div>

<div class="container result-organic boxes">
  <div class="row flex-row">
    @forelse($productos as $producto)
    <div class="col-inline col-lg-3">
      <div class="panel panel-default producto-item">
          <div class="panel-body boxAlto">
              <div class="row">
                  <div class="col-lg-12">
                      <div class="img-container">
                      @if ($producto->image_path)
                      <img src="{{ url('upload/productos/img_normal/' .$producto->image_path) }}" class="img-responsive center-block" alt="Imagen no encontrada">
                      @else
                      <img src="{{ url('img/no-image.svg') }}" class="img-responsive center-block no-image">
                      @endif
                      </div>
                  </div>
                  <div class="col-lg-12 text-left">
                      <h4 class="nombre">{{ $producto->descripcion_producto }}</h4>
                      <h5>{{ gs($producto->precio_producto, 1) }}</h5>
                      <p class="codigo"><b>Codigo: </b>{{ $producto->codigo_producto }}</p>
                      <p><b>Stock: </b>{{ $producto->stock_actual ? $producto->stock_actual : '0' }}</p>
                      <p><b>Categoría:</b>
                        @if(count($producto->categories))
                        @foreach($producto->categories as $category)
                          {{ $category->nombre_agrupador }}
                          @if(!$loop->last), 
                          @endif
                        @endforeach
                        @else
                        <em>Sin categoría</em>
                        @endif
                      </p>
                  </div>
              </div>
          </div>
          <div class="panel-footer text-right">
              <button data-target=".bs-example-modal-lg" data-toggle="modal" class="btn btn-primary" type="button" href="#" title="Ver detalles del producto" data-detail="{{ url('productos/detail') }}/{{ $producto->id_producto }}">
                  <i class="fa fa-eye" aria-hidden="true" ></i>&nbsp;
                  Ver
              </button>
              <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-bars" aria-hidden="true"></i> {{--<span class="caret"></span>--}}
                </button>
                <ul class="dropdown-menu">
                  <li><a href="{{ url('productos/editar') }}/{{ $producto->id_producto }}" title="Editar este producto"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a></li>
                  <li><a href="#" title="Ver historial completo de este producto"><i class="fa fa-history" aria-hidden="true"></i> Ver historial</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="{{ url('productos/borrar') }}/{{ $producto->id_producto }}" class="Eliminar este producto"><i class="fa fa-trash-o" aria-hidden="true"></i> Elimnar</a></li>
                </ul>
              </div>
          </div>
      </div>
    </div>
    @empty
    <div class="col-lg-6 col-lg-offset-3 col-sm-6 col-md-4 col-xs-12 item-cliente m_top_30">
        <div class="panel panel-default">
            <div class="panel-body text-center">
                No encontramos resultados para tu búsqueda :(, intenta nuevamente.
            </div>
        </div>
    </div>
    @endforelse
  </div>
  <div class="row">
    <div class="col-lg-12 text-center">{{ $productos->links() }}</div>
  </div>
</div>

<div class="container" style="display: none;">
    <div class="timeline-wrapper">
        <div class="timeline-item col-lg-4">
            <div class="animated-background">
                <div class="background-masker header-top"></div>
            </div>
        </div>
        <div class="timeline-item col-lg-4">
            <div class="animated-background">
                <div class="background-masker header-top"></div>
            </div>
        </div>
        <div class="timeline-item col-lg-4">
            <div class="animated-background">
                <div class="background-masker header-top"></div>
            </div>
        </div>

    </div>
</div>





<!-- Large modal -->

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel"></h4>
      </div>

      <div class="modal-body">

          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>


    </div>
  </div>
</div>

<script type="text/javascript">
$('.modal').on('show.bs.modal', function (event) {
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
            $('.modal-body').html(data);
        }
    })
  
})  


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
              url: "{{ url('productos/buscar') }}",
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
              $(".result-content > .row").html("Error en la busqueda.");
              },
              success: function(data){                                                    
              $(".result-content > .row").empty();
              $(".result-content > .row").append(data);                                                             
              }
        });                                                                         
  
}

buscar();

/*
$(".buscador").keyup(function(e){
  buscar();
})
*/


$('.buscador').on('keyup change', function() {
    if (this.value.length > 0) {
      $('.result-organic').hide();
      $('.result-content').show();
      $(".result-content > .row").empty();
      clearTimeout(typingTimer);
      if ($('#in').val) {
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


})







    function redirect(val){
        var value = $('.select-categoria').val();
        var url = "{{ url('productos') }}";
        var link = url + '?filter=' + value;

        window.location.href = link;
        console.log(url);
    }

    $(window).on('hashchange', function() {
        /*if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            } else {
                getPosts(page);
            }
        }*/

        alert('El navegador soporta');
    });



        


</script>







@endsection
