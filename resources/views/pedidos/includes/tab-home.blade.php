<div role="tabpanel" class="tab-pane active fade in" id="home">
          <div class="row">
            <div class="col-lg-12">
              <div class="panel panel-default">
                <div class="panel-body">
                  <form method="post" action="{{ route('pedidos.buscarProductos') }}" class="search-form">
                    <div class="row">
                      <div class="col-lg-8">
                        {{ csrf_field() }}
                        <label>Buscar un producto</label>
                        <div class="input-group">
                          <input type="text" name="q" placeholder="Buscar un producto" class="form-control q" autocomplete="off">
                          <span class="input-group-btn">
                            <button class="btn btn-default reset-q" type="reset">Borrar</button>
                          </span>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <label>Filtrar por categoría</label>
                        <select name="categories" class="form-control categoria">
                          @if($categorias)
                          <option value="">Todo</option>
                          @foreach($categorias as $categoria)
                          <option value="{{ $categoria->id_agrupador }}">{{ $categoria->nombre_agrupador }}</option>
                          @endforeach
                          @else
                          <option>No hay categorías</option>
                          @endif
                        </select>
                      </div>
                    </div>
                  </form>
                  <div class="result"></div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="result-organic">
            <div class="row">
              @foreach($categorias as $categoria)
              <div class="col-lg-3">
                <div class="item-categoria bg shadow" data-route="{{ route('pedidos.buscarProductos', ['categoria' => $categoria->id_agrupador]) }}" data-categoria="{{ $categoria->id_agrupador }}">
                  <div class="img-container">
                    @if($categoria->portada_agrupador)
                    <img src="{{ url('upload/agrupadores/'.$categoria->portada_agrupador) }}">
                    @else
                    <img src="{{ url('img/no-image.png')}}">
                    @endif
                  </div>
                  <div class="text">
                    <h3 class="title">{{ $categoria->nombre_agrupador }}</h3>
                    <p><em>{{ $categoria->productos->count() }} productos</em></p>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
          <div class="result-content ">
            <div class="row adjust"></div>
          </div>
          <div class="row" style="display: none;">
            @if (count($productos) >= 1)
            @foreach ($productos as $producto)
            <div class="col-lg-6 show-product">
              <div class="row">
                <div class="col-lg-12">
                  <div class="inner bg shadow">
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
                        <p><b>Codigo: </b>{{ $producto->codigo }}</p>
                        <p><b>Stock: </b>{{ $producto->stock_actual }}</p>
                        <input type="text" value="1" class="form-control">
                        <input type="text" name="item_price" class=" hidden-field" value="{{ $producto->precio_producto }}">
                        
                        <p class="item_id">{{ $producto->id_producto }}</p>
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
                          <a class="btn btn-primary add-to-cart" href="#" data-name="{{ $producto->nombre_producto }}" data-price="{{ $producto->precio_producto }}" data-id="{{ $producto->id_producto }}" data-url="{{ route('pedidos.consultaStock') }}" data-comentario=""><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar</a>
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
            <div class="col-lg-4 col-lg-offset-4 col-sm-6 col-md-4 col-xs-12 item-cliente m_top_30">
                <div class="thumbnail">
                    <div class="caption">
                        <p class="text-center">Aun no hay productos, registra un nuevo producto.</p>
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-lg-12 text-center">{{ $productos->links() }}</div>
            </div>
          </div><!-- fin row-->

        </div><!-- fin tab panel 1 -->