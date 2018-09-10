@extends('layouts.app')
@section('header')
<link href="{{ url('plugins/fileuploader/fileuploader.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="header-page">
<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <h3>Registar un nuevo producto</h3>
        </div>
        <div class="col-lg-8">
            <ul class="nav-nav navbar-right">
                <li>
                    <a href="{{ url('/productos') }}" class="btn btn-primary">
                        <i class="fa fa-chevron-left" aria-hidden="true"></i>
                        Atrás
                    </a>
                </li>
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
              @foreach ($errors->all() as $error)
              <p>{{ $error }}</p>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif

    <div class="panel panel-default panel-content">

        <form method="post" action="{{ url('/productos') }}" enctype="multipart/form-data">
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
                                            <input type="file" name="imagen" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Prefijo <span class="help" data-toggle="tooltip" title="En caso de no asignar un prefijo el sistema asigna automaticamente el prefijo {{ config('cms.prefijo') }}">[?]</span></label>
                                            <input type="text" name="prefijo" id="prefijo" class="form-control" value="{{ config('cms.prefijo') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Código <small><em>(Sólo lectura)</em ></small> <span class="help" data-toggle="tooltip" title="El sistema asigna automaticamente un código a cada producto, el código es asignado luego de haber creado el producto">[?]</span></label>
                                            <input type="text" name="codigo" id="codigo" class="form-control" readonly value="{{ config('cms.prefijo') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <label>Nombre</label>
                                            <input type="text" name="nombre_producto" class="form-control" value="{{ old('nombre_producto') ? old('nombre_producto') : '' }}" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Descripción</label>
                                            <input type="text" name="descripcion_producto" class="form-control" value="{{ old('descripcion') ? old('descripcion_producto') : '' }}" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Observación</label>
                                            <input type="text" name="observaciones_producto" class="form-control" value="{{ old('observaciones_producto') ? old('observaciones_producto') : '' }}" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Stock mínimo</label>
                                            <input type="text" name="stock_minimo" class="form-control" value="{{ old('stock_minimo') ? old('stock_minimo') : 15 }}" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Stock incial</label>
                                            <input type="text" name="stock_actual" class="form-control" value="{{ old('stock_actual') ? old('stock_actual') : '' }}" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Precio de compra</label>
                                            <input type="text" name="costo" class="form-control" value="{{ old('costo') ? old('costo') : '' }}" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Precio de venta</label>
                                            <input type="text" name="precio_producto" class="form-control" value="{{ old('precio_producto') ? old('precio_producto') : '' }}" autocomplete="off">
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Asignar categorías <span class="help" data-toggle="tooltip" title="Puedes asignar mas de una categoría a un producto">[?]</span></label>
                                            <select name="categoria[]" class="form-control select" multiple="multiple">
                                                @foreach ($categorias as $categoria)
                                                <option value="{{ $categoria->id_agrupador }}">{{ titleCase($categoria->nombre_agrupador) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Impuesto</label>
                                            <select class="form-control" name="impuesto">
                                                <option value="10" selected>10%</option>
                                                <option value="5">5%</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>¿Control de stock? <span class="help" data-toggle="tooltip" title="Indica si se llevará a cabo un control de stock de existencias del producto.">[?]</span></label>
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
                    <button class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Crear producto</button>
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
        $('#prefijo').on('keyup', function(){
            var val = $(this).val();
            val = val + '-'
            $('#codigo').val(val);
        });
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
<script type="text/javascript">
 
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
