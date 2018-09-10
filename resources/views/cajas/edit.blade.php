@extends('layouts.app')

@section('content')
<div class="header-page">
  <div class="container">
      <div class="row">
          <div class="col-lg-4">
              <h3>Editar caja: {{ $caja->descripcion_caja }}</h3>
          </div>
          <div class="col-lg-8">
              <ul class="nav-nav navbar-right">
                  <li>
                    <a href="{{ route('cajas.index') }}" class="btn btn-primary">
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
    <form method="post" action="{{ route('cajas.update', ['id' => $caja->id_caja]) }}" enctype="multipart/form-data">
      <div class="panel-body">

        <div class="row">

          {{ csrf_field() }}

          <div class="col-lg-6">
              <div class="form-group">
                  <label>Descripción</label>
                  <input type="text" name="descripcion_caja" class="form-control" value="{{ $caja->descripcion_caja }}">
              </div>
          </div>

          <div class="col-lg-6">
            <div class="form-group">
              <label>Estado</label>
              <select name="estado_caja" class="form-control">
                <option value="HABILITADA" {{ $caja->estado_caja == 'HABILITADA' ? 'selected' : '' }}>Activo</option>
                <option value="" {{ $caja->estado_caja != 'HABILITADA' ? 'selected' : '' }}>Inactivo</option>
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
