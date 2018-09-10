@extends('layouts.app')
@section('header')
<link href="{{ url('plugins/fileuploader/fileuploader.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="header-page">
<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <h3>Editando: <b>{{ $producto->nombre_producto }}</b></h3>
        </div>
        <div class="col-lg-8">
            <ul class="nav-nav navbar-right">
                <!--<li>
                    <div class="search-input">
                        <i class="fa fa-search" aria-hidden="true"></i>
                        <input type="text" name="b" placeholder="Buscar">
                    </div>
                </li>-->
                <li><a href="{{ url('/productos') }}" class="btn btn-primary">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                    Atrás
                </a></li>
            </ul>
        </div>
    </div>
</div>
</div>

<div class="container">

    @if ($errors->any())
    <div class="panel panel-default panel-content">
      <div class="panel-heading">¡Error!</div>
      <div class="panel-body">
        <div class="row">
          <div class="col-lg-12">
            <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
                </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif

    <div class="panel panel-default panel-content">
        <form method="post" action="{{ route('productos.update', ['id' => $producto->id_producto]) }}" enctype="multipart/form-data">
        <div class="panel-body">
            
            <div class="row">
        
                <div class="col-lg-12">

                    
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Imagen</label>
                                            <input type="file" name="imagen" class="form-control" data-fileuploader-files="{{ $files }}">
                                        </div>
                                    </div>
                                </div>
                                {{--
                                <div class="row">
                                    <div class="col-lg-12">
                                        @if($producto->image_path)
                                        <label>Imagen actual</label>
                                        <img src="{{ url('upload/productos/img_normal/'.$producto->image_path) }}" class="img-responsive center-block">
                                        @else
                                        <p class="text-center">Producto sin imagen :(</p>
                                        @endif
                                    </div>
                                </div>
                                --}}
                            </div>
                            <div class="col-lg-8">
                                <div class="row">

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Código <small><em>(Sólo lectura)</em></small> <span class="help" data-toggle="tooltip" title="El sistema asigna automaticamente un código a cada producto, el código es asignado luego de haber creado el producto y no es posible editar">[?]</span></label>
                                            <input type="text" name="codigo_producto" class="form-control" readonly value="{{ $producto->codigo_producto }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <label>Nombre</label>
                                            <input type="text" name="nombre_producto" class="form-control" value="{{ old('nombre') ? old('nombre') : $producto->nombre_producto }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Descripción</label>
                                            <input type="text" name="descripcion_producto" class="form-control" value="{{ old('descripcion') ? old('descripcion') : $producto->descripcion_producto }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Observación</label>
                                            <input type="text" name="observaciones_producto" class="form-control" value="{{ old('obs') ? old('obs') : $producto->observaciones_producto }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Stock mínimo</label>
                                            <input type="text" name="stock_minimo" class="form-control" value="{{ old('stock_minimo') ? old('stockmin') : $producto->stock_minimo }}">
                                        </div>
                                    </div>
                                   
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Precio de compra</label>
                                            <input type="text" name="costo" class="form-control" value="{{ old('costo') ? old('precioc') : $producto->costo }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Precio de venta</label>
                                            <input type="text" name="precio_producto" class="form-control" value="{{ old('precio_producto') ? old('preciov') : $producto->precio_producto }}">
                                        </div>
                                    </div>
                                     <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Stock actual</label>
                                            <input type="text" name="stock_actual" class="form-control" value="{{ $producto->stock_actual }}" readonly disabled>
                                        </div>
                                    </div>
                                     <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Abastecer</label>
                                            <input type="text" name="abastecer" class="form-control" value="{{ old('stock_actual') ? old('stockmin') : '' }}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Asignar categorías <span class="help" data-toggle="tooltip" title="Puedes asignar mas de una categoría a un producto">[?]</span></label>
                                            <select name="categoria[]" class="form-control select" multiple="multiple">
                                                @php $i = 1; @endphp
                                                @foreach ($categorias as $categoria)
                                                @if($categoriasproductos)
                                                @foreach($categoriasproductos as $actual)
                                                <option value="{{ $categoria->id_agrupador }}" {{ $categoria->id_agrupador == $actual->id_agrupador ? 'selected' : '' }}>{{ $i++ .' | '. titleCase($categoria->nombre_agrupador) }}</option>
                                                @endforeach
                                                @else
                                                <option value="{{ $categoria->id_agrupador }}">{{ $i++ .' | '. titleCase($categoria->nombre_agrupador) }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Impuesto</label>
                                            <select class="form-control" name="impuesto_producto">
                                                <option value="10" selected>10%</option>
                                                <option value="5">5%</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>¿Control de stock? <span class="help" data-toggle="tooltip" title="Indica si se llevará a cabo un control de stock del producto (Inventario)">[?]</span></label>
                                            <select class="form-control" name="control_stock">
                                                <option value="1" selected>Si</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Estado</label>
                                            <select class="form-control" name="estado_producto">
                                                <option value="1" selected>Activo</option>
                                                <option value="0">Inactivo</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>

            </div>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-lg-12 text-right">
                    <button class="btn btn-primary">Actualizar</button>
                </div>
            </div>
        </div>
        </form>

    </div>

</div>



@endsection

@section('script')
<script src="{{ url('plugins/fileuploader/jquery.fileuploader.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".select").select2({
          language: "es",
        });
    })
</script>

<script type="text/javascript">
    $(document).ready(function(){

        $('input[name="imagen"]').fileuploader({

            changeInput: '<div class="fileuploader-input text-center">' +
                          '<div class="fileuploader-input-inner" style="width: 100%;">' +
                              '<img src="{{ url('plugins/fileuploader/fileuploader-dragdrop-icon.png') }}" style="display:block; margin: auto;">' +
                              '<h3 class="fileuploader-input-caption" style="font-size:14px;"><span>Arrastra aquí una imagen</span></h3>' +
                              '<p>o</p>' +
                              '<div class="fileuploader-input-button"><span>Buscar imagen</span></div>' +
                          '</div>' +
                      '</div>',
            theme: 'dragdrop',
            limit: 1,
            onRemove: function(item, listEl, parentEl, newInputEl, inputEl) {
                $.post('{{ url('productos/image/remove') }}', { id: item.data.id });
                return true;
            },


            // captions
            captions: {
                button: function(options) { return 'Seleccionar ' + (options.limit == 1 ? 'imagen' : 'imagenes'); },
                feedback: function(options) { return 'Seleccionar ' + (options.limit == 1 ? 'imagen' : 'imagenes') + ' to upload'; },
                feedback2: function(options) { return options.length + ' ' + (options.length > 1 ? ' imagenes han sido' : ' imagen ha sido') + ' seleccionadas'; },
                confirm: 'Confirmar',
                cancel: 'Cancelar',
                name: 'Nombre',
                type: 'Tipo',
                size: 'Tamaño',
                dimensions: 'Dimensiones',
                duration: 'Duración',
                crop: 'Cortar',
                rotate: 'Rotar',
                download: 'Descargar',
                remove: 'Eliminar',
                drop: 'Arrastra aquí la imagen para subir',
                paste: '<div class="fileuploader-pending-loader"><div class="left-half" style="animation-duration: ${ms}s"></div><div class="spinner" style="animation-duration: ${ms}s"></div><div class="right-half" style="animation-duration: ${ms}s"></div></div> Pasting a file, click here to cancel.',
                removeConfirmation: 'Are you sure you want to remove this file?',
                errors: {
                    filesLimit: 'Only ${limit} files are allowed to be uploaded.',
                    filesType: 'Only ${extensions} files are allowed to be uploaded.',
                    fileSize: '${name} is too large! Please choose a file up to ${fileMaxSize}MB.',
                    filesSizeAll: 'Files that you chose are too large! Please upload files up to ${maxSize} MB.',
                    fileName: 'File with the name ${name} is already selected.',
                    folderUpload: 'You are not allowed to upload folders.'
                }
            }

        });

    })
</script>


<style type="text/css">
    .fileuploader {
        background-color: #fff;
    }
    .fileuploader-input-button, .fileuploader-input-button:active {
        background-color: #4080ff;
    }
    .fileuploader-input-button:hover {
        background-color: #4080ffc7;
    }
    .fileuploader-input-caption {
        color: #4080ff;
        border: 1px solid #4080ffc7;
    }
    .fileuploader-popup {
        z-index: 90000;
    }
</style>
<script type="text/javascript">
    @if (Session::has('message'))
    var mensaje = '{{ Session::get('message') }}';
    report(mensaje);
    @endif
</script>
@endsection
