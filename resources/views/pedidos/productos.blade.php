@if(count($productos))
<div class="col-lg-12 text-left" style="margin-bottom: 8px;">
	<p><a href="#" class="return-back _n26"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a></p>
</div>
@foreach($productos as $producto)

<div class="col-lg-6 show-product ">
  <div class="row">
    <div class="col-lg-12">
      <div class="inner bg shadow adjust-height">
        <div class="row">
          <div class="col-lg-4">
            @if ($producto->image_path)
            <img src="{{ url('upload/productos/img_normal/' .$producto->image_path) }}" class="img-responsive center-block">
            @else
            <img src="{{ url('img/no-image.svg') }}" class="img-responsive center-block">
            @endif
          </div>
          <div class="col-lg-8">
            <h4 class="item_name">{{ $producto->nombre_producto ? $producto->nombre_producto : $producto->descripcion_producto }}</h4>
            <h5 class="">{{ gs($producto->precio_producto, 1) }}</h5>
            <p><b>Codigo: </b>{{ $producto->codigo_producto }}</p>
            <p><b>Stock: </b>{{ $producto->stock_actual ? $producto->stock_actual : '0' }}</p>
            <input type="hidden" value="1" class="form-control">
            <input type="hidden" name="item_price" class=" hidden-field" value="{{ $producto->precio_producto }}">
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
            <br>
            <div class="action" style="left: 15px; right: 15px;">
              <a class="btn btn-primary add-to-cart" href="#" data-name="{{ $producto->nombre_producto }}" data-price="{{ $producto->precio_producto }}" data-id="{{ $producto->id_producto }}" data-url='{{ route('pedidos.consultaStock') }}'><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar</a>
              <a class="btn btn-primary info-producto" href="#" data-name="{{ $producto->nombre_producto }}" data-price="{{ $producto->precio_producto }}" data-id="{{ $producto->id_producto }}" data-url='{{ route('pedidos.consultaStock') }}'><i class="fa fa-eye" aria-hidden="true"></i> Info</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endforeach
@else
<h1 class="text-center"><i class="fa fa-frown-o" aria-hidden="true"></i></h1>
<p class="text-center">No hay resultados para tu búsqueda, intenta nuevamente</p>
<p class="text-center"><a href="#" class="return-back _n26"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a></p>
@endif