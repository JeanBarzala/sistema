@extends('layouts.app')

@section('content')
<div class="header-page">
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <h3>Editando cliente: {{ $clientes->nombre_persona }}</h3>
        </div>
        <div class="col-lg-4">
            <ul class="nav-nav navbar-right">
                <li><a href="{{ url('/clientes') }}" class="btn btn-primary">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i> Atrás
                </a></li>
                <li class="sub-menu">
                    <a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true"><i class="fa fa-bars" aria-hidden="true"></i></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#"  data-toggle="modal" data-target="#modal-direccion-registrar"><i class="fa fa-phone" aria-hidden="true"></i> Registrar dirección</a></li>           
                      <li><a href="#"  data-toggle="modal" data-target="#modal-telefono-registrar"><i class="fa fa-phone" aria-hidden="true"></i> Registrar teléfono</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
</div>
<div class="container m_top_30">
  @if ($errors->any())
    <div class="panel panel-default panel-content">
      <div class="panel-heading">¡Detectamos un error!</div>
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
  
  <div class="row">
    <div class="col-lg-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          Direcciónes
        </div>
        <div class="panel-body">
          <div class="list-group row">
            @if(count($clientes->direccion))
            @foreach($clientes->direccion as $direccion)
            <a href="#" class="list-group-item edit-direccion" data-direccion-id="{{ $direccion->id_direccion }}" data-toggle="modal" data-target="#modal-direccion" data-route="{{ route('clientes.direccion.update', ['id_direccion' => $direccion->id_direccion]) }}" data-get="{{ route('clientes.direccion.edit', ['id_direccion' => $direccion->id_direccion]) }}">
              <i class="fa fa-caret-right" aria-hidden="true"></i> {{ $direccion->getFullDireccion() }}
            </a>
            @endforeach
            @else
            <p class="list-group-item">No tiene direcciónes registradas.</p>
            @endif
          </div>
        </div>
      </div>

      <div class="panel panel-default">
        <div class="panel-heading">
          Teléfonos
        </div>
        <div class="panel-body">
          <div class="list-group row">
            @if(count($clientes->telefonos))
            @foreach($clientes->telefonos as $telefono)
            <a href="#" class="list-group-item edit-telefono" data-telefono-id="{{ $telefono->id_telefono }}" data-toggle="modal" data-target="#modal-telefono" data-route="{{ route('clientes.telefono.update', ['id_telefono' => $telefono->id_telefono]) }}" data-get="{{ route('clientes.telefono.edit', ['id_telefono' => $telefono->id_telefono]) }}">
              <i class="fa fa-caret-right" aria-hidden="true"></i> {{ $telefono->getFullTelefono() }}
            </a>
            @endforeach
            @else
            <p class="list-group-item">No tiene teléfonos registrados.</p>
            @endif
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-8">
      <form method="post" action="{{ route('clientes.update', ['id' => $clientes->id_persona, 'id_cliente' => $clientes->clientes->id_cliente]) }}">
        {{ csrf_field() }}
        <div class="panel panel-default">
          <div class="panel-heading">
            Datos generales
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-4">
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{ old('nombre') ? old('nombre') : $clientes->nombre_persona }}">
                </div>
              </div>
              <div class="col-lg-4">
                  <div class="form-group">
                      <label>Apellido</label>
                      <input type="text" name="apellido" class="form-control" value="{{ old('apellido') ? old('apellido') : $clientes->apellido_persona }}" autocomplete="off">
                  </div>
              </div>
              <div class="col-lg-4">
                  <div class="form-group">
                    <label>Fecha de nacimiento</label>
                    <div class='input-group datetime'>
                        <input type='text' class="form-control" autocomplete="off" name="fecha_nacimiento" value="{{ $clientes->fecha_ncto_persona }}">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
              </div>
              <div class="col-lg-4">
                  <div class="form-group">
                      <label>Tipo de Documento</label>
                      <select class="form-control" name="tipo_documento">
                          <option value="" disabled @if(empty($clientes->tipo_doc_persona)) selected @endif>Seleccion el tipo de documento</option>
                          <option value="CI" @if($clientes->tipo_doc_persona == 'CI') selected @endif>CI</option>
                          <option value="DNI" @if($clientes->tipo_doc_persona == 'DNI') selected @endif>DNI</option>
                          <option value="Pasaporte" @if($clientes->tipo_doc_persona == 'Pasaporte') selected @endif>Pasaporte</option>
                      </select>
                  </div>
              </div>
              <div class="col-lg-4">
                  <div class="form-group">
                      <label>N° de documento</label>
                      <input type="text" name="num_doc_persona" class="form-control" value="{{ old('num_doc_persona') ? old('num_doc_persona') : $clientes->num_doc_persona }}" autocomplete="off">
                  </div>
              </div>
              <div class="col-lg-4">
                  <div class="form-group">
                      <label>Razón Social</label>
                      <input type="text" name="razon_social" class="form-control" value="{{ old('razon_social') ? old('razon_social') : $clientes->razon_social_persona }}" autocomplete="off">
                  </div>
              </div>
              <div class="col-lg-4">
                  <div class="form-group">
                      <label>Ruc</label>
                      <input type="text" name="ruc" class="form-control" value="{{ old('ruc') ? old('ruc') : $clientes->ruc_persona }}" autocomplete="off">
                  </div>
              </div>
              <div class="col-lg-4">
                  <div class="form-group">
                      <label>Estado Civil</label>
                      <select class="form-control" name="estado_civil">
                          <option value="" disabled {{ $clientes->id_estado_civil ? '' : 'selected' }}>Seleccion el estado civil</option>
                          @foreach ($estado_civil as $estado_civil)
                          <option value="{{ $estado_civil->id_estado_civil }}" {{ $estado_civil->id_estado_civil == $clientes->id_estado_civil ? 'selected' : '' }} >{{ $estado_civil->nombre_estado_civil }}</option>
                          @endforeach
                      </select>
                  </div>
              </div>
              <div class="col-lg-4">
                  <div class="form-group">
                      <label>Sexo</label>
                      <select class="form-control" name="sexo">
                          <option value="" disabled @if(empty($clientes->sexo_persona)) selected @endif>Selecciona el sexo</option>
                          <option value="M" @if($clientes->sexo_persona == 'M') selected @endif>Hombre</option>
                          <option value="F" @if($clientes->sexo_persona == 'F') selected @endif>Mujer</option>
                      </select>
                  </div>
              </div>
              <div class="col-lg-4">
                  <div class="form-group">
                      <label>Email</label>
                      <input type="email" name="email" class="form-control" value="{{ old('email') ? old('email') : $clientes->email_persona }}" autocomplete="off">
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
        </div><!-- fin .panel -->
      </form>
    </div>
  </div>
  

</div>

<!-- Editar -->
@include('clientes.includes.modal-direccion')
@include('clientes.includes.modal-telefono')

<!--Registrar -->
@include('clientes.includes.modal-registrar-telefono')
@include('clientes.includes.modal-registrar-ciudad')

@endsection

@section('script')
<script>
  $(document).ready(function(){
    $('#modal-direccion-registrar, #modal-direccion').on('shown.bs.modal', function () {
      $(".select-ciudad").select2({
        tags: true,
        ajax: {
          url: "{{ url('ciudad/json') }}",
          dataType: 'json',
          delay: 250,

          data: function (params) {
            return {
              search: params.term, // search term
              page: params.page
            };
          },
          processResults: function (data, params) {
                var data = $.map(data, function (obj) {
                    obj.id = obj.id_ciudad;
                    obj.text = obj.nombre_ciudad;
                    return obj;
                });
            // parse the results into the format expected by Select2
            // since we are using custom formatting functions we do not need to
            // alter the remote JSON data, except to indicate that infinite
            // scrolling can be used
            params.page = params.page || 1;

            return {
              results: data,
              pagination: {
                more: (params.page * 30) < data.total_count
              }
            };
          },
          cache: true
        },
        escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
        minimumInputLength: 1,
        "language": {
             "noResults": function(){
                 return "No encontramos resultados, puedes registrar una ciudad escribiendo el nombre.";
             },
             "inputTooShort": function(){
                 return "Ingresa 1 o más caracteres para realizar la búsqueda.";
             },
             "searching": function(){
                return 'Buscando...'
             }
         },

      });
    })

    $('#modal-direccion-registrar, #modal-direccion').on('shown.bs.modal', function () {
      $(".select-barrio").select2({
        tags: true,
        language: "es",
        ajax: {
          url: "{{ url('barrio/json') }}",
          dataType: 'json',
          delay: 250,


          data: function (params) {
            return {
              search: params.term, // search term
              page: params.page
            };
          },
          processResults: function (data, params) {
                var data = $.map(data, function (obj) {
                    obj.id = obj.id_barrio;
                    obj.text = obj.nombre_barrio;
                    return obj;
                });
            // parse the results into the format expected by Select2
            // since we are using custom formatting functions we do not need to
            // alter the remote JSON data, except to indicate that infinite
            // scrolling can be used
            params.page = params.page || 1;

            return {
              results: data,
              pagination: {
                more: (params.page * 30) < data.total_count
              }
            };
          },
          cache: true
        },
        placeholder: 'Buscar o registrar un Barrio',
        "language": {
             "noResults": function(){
                 return "No encontramos resultados, puedes registrar un barrio escribiendo el nombre.";
             },
             "inputTooShort": function(){
                 return "Ingresa 1 o más caracteres para realizar la búsqueda.";
             },
             "searching": function(){
                return 'Buscando...'
             }
         },

        escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
        

      });
    })

    $(document).on('click', '.edit-direccion', function(){
      $('#modal-direccion form').attr('action', $(this).data('route'));
      $.post($(this).data('get'), function(response) {
        $('#modal-direccion .modal-body').html(response);
        $("#modal-direccion .modal-body select").select2({});
        console.log(response);
      });
    });

    $(document).on('click', '.edit-telefono', function(){
      $('#modal-telefono form').attr('action', $(this).data('route'));
      $.post($(this).data('get'), function(response) {
        $('#modal-telefono .modal-body').html(response);
        //$("#modal-telefono .modal-body select").select2({});
        console.log(response);
      });

    });



    $(".select").select2({});
    $(".js-data-example-ajax").select2({
      ajax: {
        url: "{{ url('ciudad/json') }}",
        dataType: 'json',
        delay: 250,
        data: function (params) {
          return {
            search: params.term, // search term
            page: params.page
          };
        },
        processResults: function (data, params) {
              var data = $.map(data, function (obj) {
                  obj.id = obj.id_ciudad;
                  obj.text = obj.nombre_ciudad;
                  return obj;
              });
          // parse the results into the format expected by Select2
          // since we are using custom formatting functions we do not need to
          // alter the remote JSON data, except to indicate that infinite
          // scrolling can be used
          params.page = params.page || 1;

          return {
            results: data,
            pagination: {
              more: (params.page * 30) < data.total_count
            }
          };
        },
        cache: true
      },
      escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
      minimumInputLength: 1

    });

    $('.datetime').datetimepicker({
      viewMode: 'years',
      format: 'YYYY-MM-DD',
      locale: 'es'
    });
    @if (Session::has('message'))
    var mensaje = '{{ Session::get('message') }}';
    report(mensaje);
    @endif
  });
</script>
@endsection
