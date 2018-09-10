@extends('layouts.app')

@section('content')
<div class="header-page">
  <div class="container">
      <div class="row">
          <div class="col-lg-4">
              <h3>Crear una boca de impresión</h3>
          </div>
          <div class="col-lg-8">
              <ul class="nav-nav navbar-right">
                  <li>
                    <a href="{{ route('bocas.index') }}" class="btn btn-primary">
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
    <form method="post" action="{{ route('bocas.store') }}" enctype="multipart/form-data">
      <div class="panel-body">
        <div class="row">
          {{ csrf_field() }}

          <div class="col-lg-4">
            <div class="form-group">
                <label>Descripción</label>
                <input type="text" name="numero_boca_facturacion" class="form-control">
            </div>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
                <label>Host</label>
                <input type="text" name="host_facturacion" class="form-control" value="{{ old('$boca->host_facturacion') }}">
            </div>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
                <label>URL de la impresora</label>
                <input type="text" name="uri_print" class="form-control" value="{{ old('$boca->uri_print') }}">
            </div>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
              <label>Tipo de impresora</label>
              <select name="tipo_impresora" class="form-control">
                <option disabled>Seleccione un tipo de impresora</option>
                <option value="IPP">IPP</option>
                <option value="LPD">LPD</option>
              </select>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
              <label>Talon</label>
              <select class="form-control" name="talon">
                @if($talones)
                @foreach($talones as $talon)
                <option value="{{ $talon->id_talon }}">{{ $talon->tipo_talon }} | Serie: {{ $talon->serie_talon }} | Inicio: {{ $talon->nro_inicio_talon }} | Fin: {{ $talon->nro_final_talon }} | Nro. Final: {{ $talon->ultimo_nro_talon }}</option>
                @endforeach
                @endif
              </select>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
              <label>POS</label>
              {!! Form::select('pos', $cajas, null, ['class' => 'form-control']) !!}
            </div>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
              <label>Estado</label>
              <select name="estado_boca_facturacion" class="form-control">
                <option value="ACTIVO">Activo</option>
                <option value="INACTIVO">Inactivo</option>
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
