@if(!empty($result))

@if($total > 0)
<div class="col-lg-12 text-center">
    <p>Se @if($total == 1) muestra @else muestran @endif <b>{{ $total }}</b> @if($total == 1) producto @else productos @endif como resultado</p>
</div>
@else

@endif
@forelse($result as $producto)

<div class="col-inline col-lg-3">
  <div class="panel panel-default producto-item">
      <div class="panel-body">
          <div class="row">
              <div class="col-lg-12">
                  <div class="img-container">
                  @if ($producto->image_path)
                  <img src="{{ url('upload/productos/img_normal/' .$producto->image_path) }}" class="img-responsive center-block">
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

@if($result->count() >= 15)
<div class="col-lg-12 text-center">{{ $result->links() }}</div>
@endif

@endif