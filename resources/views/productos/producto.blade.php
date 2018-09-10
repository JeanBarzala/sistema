<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <div>
                @if($producto->image_path)
                <img class="product-image img-responsive center-block" src="{{ url('/upload/productos/img_normal/'. $producto->image_path) }}">
                @else
                <img src="{{ url('img/no-image.svg') }}" class="img-responsive center-block">
                @endif
            </div>
        </div>
        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-3">
                    <p><b>Nombre: </b></p>
                </div>
                <div class="col-lg-9">
                    <p class="product-name">{{ $producto->nombre_producto}}<p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <p><b>Descripcion: </b></p>
                </div>
                <div class="col-lg-9">
                    <p class="product-descripcion">{{ $producto->descripcion_producto}}<p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <p><b>Stock: </b></p>
                </div>
                <div class="col-lg-9">
                    <p class="product-stock">{{ $producto->stock_actual }}<p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <p><b>Stock minimo: </b></p>
                </div>
                <div class="col-lg-9">
                    <p class="product-stockmin">{{ $producto->stock_minimo }}<p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <p><b>Precio de compra: </b></p>
                </div>
                <div class="col-lg-9">
                    <p class="product-precioc">{{ gs($producto->costo, 1) }}<p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <p><b>Precio de venta: </b></p>
                </div>
                <div class="col-lg-9">
                    <p class="product-preciov">{{ gs($producto->precio_producto, 1) }}<p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <p><b>Fecha de creacion: </b></p>
                </div>
                <div class="col-lg-9">
                    <p class="product-fechacreacion">{{ $producto->created_at }}<p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3">
                    <p><b>Categorías: </b></p>
                </div>
                <div class="col-lg-9">
                    <p class="product-categoria">
                        @forelse($categorias as $categoria)
                        {{ $categoria->nombre_agrupador }}@if(!$loop->last),@endif
                        @empty
                        Este producto no tiene categorías asignadas.
                        @endforelse
                    <p>
                </div>
            </div>

        </div>
    </div>
</div>