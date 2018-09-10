@extends('layouts.app')

@section('content')
<div class="header-page">
  <div class="container">
      <div class="row">
          <div class="col-lg-4">
              <h3>Crear una categoría</h3>
          </div>
          <div class="col-lg-8">
              <ul class="nav-nav navbar-right">
                  <li>
                    <a href="{{ url('/categorias') }}" class="btn btn-primary">
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
      </div>

    @endif
    
  <div class="panel panel-defautl panel-content">
    <form method="post" action="{{ url('/categorias') }}" enctype="multipart/form-data">
      <div class="panel-body">

        <div class="row">

          {{ csrf_field() }}

          <div class="col-lg-4">
              <div class="form-group">
                  <label>Nombre</label>
                  <input type="text" name="nombre" class="form-control">
              </div>
          </div>

          <div class="col-lg-4">
            <div class="form-group">
                <label>Descripción</label>
                <input type="text" name="descripcion" class="form-control">
            </div>
          </div>

          <div class="col-lg-4">
            <div class="form-group">
              <label>Portada</label>
              <input type="file" name="portada" class="form-control">
            </div>
          </div>

        </div>

      </div>

      <div class="panel-footer">
        <div class="row">
          <div class="col-lg-12 text-right">
              <button class="btn btn-primary">Crear</button>
          </div>
        </div>
      </div>

    </form>
  </div>

</div>



@endsection
