@extends('layouts.app')

@section('content')
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
                  </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="container">
<div class="panel panel-defautl panel-content">
<div class="panel-body">

    <div class="row">

            <form method="post" action="{{ url('/clientes') }}">
                {{ csrf_field() }}
                <div class="col-lg-4">
                  <div class="form-group">
                      <label>Nombre</label>
                      <input type="text" name="nombre" class="form-control">
                  </div>
              </div>


              <div class="col-lg-4">
                  <div class="form-group">
                      <label>Apellido</label>
                      <input type="text" name="apellido" class="form-control">
                  </div>
              </div>

              <div class="col-lg-4">
                  <div class="form-group">
                      <label>Ruc - CI</label>
                      <input type="text" name="ruc" class="form-control">
                  </div>
              </div>

              <div class="col-lg-4">
                  <div class="form-group">
                      <label>Telefono</label>
                      <input type="text" name="telefono" class="form-control">
                  </div>
              </div>

              <div class="col-lg-4">
                  <div class="form-group">
                      <label>Email</label>
                      <input type="email" name="email" class="form-control">
                  </div>
              </div>

              <div class="col-lg-4">
                  <div class="form-group">
                      <label>Direccion</label>
                      <input type="text" name="direccion" class="form-control">
                  </div>
              </div>

              <div class="col-lg-4">
                  <div class="form-group">
                      <label>Ciudad</label>
                      <select class="form-control" name="ciudad">
                          <option>Asunción</option>
                          <option>Lambaré</option>
                          <option>San Lorenzo</option>
                          <option>Ñemby</option>
                      </select>
                  </div>
              </div>

              <div class="col-lg-12 text-right">
                  <button class="btn btn-primary">Registrar</button>
              </div>
                

            </form>
        

    </div>
    </div>
    </div>

</div>



@endsection
