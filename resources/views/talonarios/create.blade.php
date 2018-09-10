@extends('layouts.app')

@section('content')
<div class="header-page">
  <div class="container">
      <div class="row">
          <div class="col-lg-4">
              <h3>Crear una talonario</h3>
          </div>
          <div class="col-lg-8">
              <ul class="nav-nav navbar-right">
                  <li>
                    <a href="{{ route('talonarios.index') }}" class="btn btn-primary">
                      <i class="fa fa-chevron-left" aria-hidden="true"></i> Atrás
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
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      </div>

    @endif
    
  <div class="panel panel-defautl panel-content">
    <form method="post" action="{{ route('talonarios.store') }}" enctype="multipart/form-data">
      <div class="panel-body">

        <div class="row">

          {{ csrf_field() }}

          <div class="col-lg-4">
              <div class="form-group">
                  <label>Serie</label>
                  <input type="text" name="serie_talon" class="form-control" value="{{ old('serie_talon') }}">
              </div>
          </div>

          <div class="col-lg-4">
            <div class="form-group">
                <label>Nro. Inicio</label>
                <input type="text" name="nro_inicio_talon" class="form-control" value="{{ old('nro_inicio_talon') }}">
            </div>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
                <label>Vencimiento</label>
                <input type="date" name="fecha_vencimiento_talon" class="form-control" value="{{ old('fecha_vencimiento_talon') }}">
            </div>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
                <label>Nro. Final</label>
                <input type="text" name="nro_final_talon" class="form-control" value="{{ old('nro_final_talon') }}">
            </div>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
                <label>Timbrado</label>
                <input type="text" name="timbrado_talon" class="form-control" value="{{ old('timbrado_talon') }}">
            </div>
          </div>

          <div class="col-lg-4">
            <div class="form-group">
              <label>Tipo</label>
              <select name="tipo_talon" class="form-control">
                <option value="">Selecciona un tipo de talon</option>
                <option value="FACTURA" @if(old('tipo_talon') == 'FACTURA')selected @else @endif>FACTURA</option>
                <option value="REMISION" @if(old('tipo_talon') == 'REMISION')selected @else @endif>REMISION</option>
              </select>
            </div>
          </div>

        </div>

      </div>

      <div class="panel-footer">
        <div class="row">
          <div class="col-lg-12 text-right">
              <button class="btn btn-primary">Guardar</button>
          </div>
        </div>
      </div>

    </form>
  </div>

</div>



@endsection
