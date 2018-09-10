@extends('layouts.app')

@section('content')
<div class="header-page">
<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <h3>Registar un nuevo cliente</h3>
        </div>
        <div class="col-lg-8">
            <ul class="nav-nav navbar-right">
                <li>
                  <a href="{{ url('/clientes') }}" class="btn btn-primary">
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

  <form method="post" action="{{ url('/clientes') }}">

    {{ csrf_field() }}


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
    @if(Session::has('message'))

      <div class="alert alert-info m_top_30">
        {{ Session::get('message') }}
      </div>

    @endif
  
    <div class="panel panel-default panel-content">
      <div class="panel-heading">
        Datos generales
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-lg-4">
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="nombre" class="form-control" value="{{ old('nombre') ? old('nombre') : '' }}">
            </div>
          </div>

          <div class="col-lg-4">
              <div class="form-group">
                  <label>Apellido</label>
                  <input type="text" name="apellido" class="form-control" value="{{ old('apellido') ? old('apellido') : '' }}">
              </div>
          </div>

          <div class="col-lg-4">
              <div class="form-group">
                <label>Fecha de nacimiento</label>
                <div class='input-group datetime'>
                    <input type='text' class="form-control" autocomplete="off" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') ? old('fecha_nacimiento') : '' }}">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
          </div>

          <div class="col-lg-4">
              <div class="form-group">
                  <label>Personería</label>
                  <select class="form-control" name="tipo_persona">
                      <option value="" disabled selected>Seleccion el tipo de persona</option>
                      <option value="F">Física</option>
                      <option value="N">Física/Nombre Fantasía</option>
                      <option value="J">Jurídica</option>
                      <option value="L">Libre de impuesto</option>
                  </select>
              </div>
          </div>

          <div class="col-lg-4">
              <div class="form-group">
                  <label>Tipo de Documento</label>
                  <select class="form-control" name="tipo_documento">
                      <option value="" disabled selected>Seleccion el tipo de documento</option>
                      <option value="CI">CI</option>
                      <option value="DNI">Pasaporte</option>
                  </select>
              </div>
          </div>

          <div class="col-lg-4">
              <div class="form-group">
                  <label>N° de documento</label>
                  <input type="text" name="num_doc_persona" class="form-control" value="{{ old('num_doc_persona') ? old('num_doc_persona') : '' }}">
              </div>
          </div>

          <div class="col-lg-4">
              <div class="form-group">
                  <label>Razón Social</label>
                  <input type="text" name="razon_social" class="form-control" value="{{ old('razon_social') ? old('razon_social') : '' }}">
              </div>
          </div>

          <div class="col-lg-4">
              <div class="form-group">
                  <label>Ruc</label>
                  <input type="text" name="ruc" class="form-control" value="{{ old('ruc') ? old('ruc') : '' }}">
              </div>
          </div>

          <div class="col-lg-4">
              <div class="form-group">
                  <label>Estado Civil</label>
                  <select class="form-control" name="estado_civil">
                      <option value="" disabled selected>Seleccion el estado civil</option>
                      @foreach ($estado_civil as $estado_civil)
                      <option value="{{ $estado_civil->id_estado_civil }}">{{ $estado_civil->nombre_estado_civil }}</option>
                      @endforeach
                  </select>
              </div>
          </div>

          <div class="col-lg-4">
              <div class="form-group">
                  <label>Sexo</label>
                  <select class="form-control" name="sexo">
                      <option value="" disabled selected>Selecciona el sexo</option>
                      <option value="F">Hombre</option>
                      <option value="M">Mujer</option>
                  </select>
              </div>
          </div>

          <div class="col-lg-4">
              <div class="form-group">
                  <label>Email</label>
                  <input type="email" name="email" class="form-control" value="{{ old('email') ? old('email') : '' }}">
              </div>
          </div>

          <div class="col-lg-8">
              <div class="form-group">
                  <label>Observaciones</label>
                  <input type="text" name="obs" class="form-control" value="{{ old('obs') ? old('obs') : '' }}">
              </div>
          </div>

        </div>
      </div>
      <div class="panel-footer">
          <div class="row">
              <div class="col-lg-12 text-right">
                  <button class="btn btn-primary">Registrar cliente</button>
              </div>
          </div>
      </div>
      
    </div><!-- fin .panel -->
    </form>
</div>



@endsection

@section('script')

<script>
  $(document).ready(function(){

    


    $(".select2").select2({
      language: "es",
      ajax: {
        url: '{{ url('ciudad/json') }}',
        dataType: 'json',
        data: function (params) {
          var query = {
            search: params.term
          }

          // Query parameters will be ?search=[term]&page=[page]
          return query;
        }
        // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
      }
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
      format: 'YYYY/MM/DD',
      locale: 'es'
    });

  });
</script>

@endsection
