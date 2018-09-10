@extends('layouts.app')

@section('content')
<div class="header-page">
  <div class="container">
      <div class="row">
          <div class="col-lg-4">
              <h3>Editar tarjeta: {{ $tarjeta->nombre_producto }}</h3>
          </div>
          <div class="col-lg-8">
              <ul class="nav-nav navbar-right">
                  <li>
                    <a href="{{ route('tarjeta.index') }}" class="btn btn-primary">
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
    <form method="post" action="{{ route('tarjeta.update', ['id' => $tarjeta->id_producto]) }}" enctype="multipart/form-data">
      <div class="panel-body">

        <div class="row">

          {{ csrf_field() }}

          <div class="col-lg-4">
              <div class="form-group">
                  <label>Nombre</label>
                  <input type="text" name="nombre" class="form-control" value="{{ $tarjeta->nombre_producto }}">
              </div>
          </div>

          <div class="col-lg-4">
            <div class="form-group">
                <label>Descripción</label>
                <input type="text" name="descripcion" class="form-control" value="{{ $tarjeta->descripcion_producto }}">
            </div>
          </div>

          <div class="col-lg-4">
            <div class="form-group">
              <label>Estado</label>
              <select name="estado" class="form-control">
                <option value="1" {{ $tarjeta->estado_producto == 1 ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ $tarjeta->estado_producto != 1 ? 'selected' : '' }}>Inactivo</option>
              </select>
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
