@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <h3>Proveedores</h3>
        </div>
        <div class="col-lg-8">
            <ul class="nav-nav navbar-right">
                <li><a href="{{ url('/proveedores/create') }}" class="btn btn-primary">Nuevo cliente</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="container m_top_30">

    <div class="row">

        @if (count($proveedores) >= 1)
    
        @foreach ($proveedores as $proveedor)

        <div class="col-lg-3 col-sm-6 col-md-4 col-xs-12 item-proveedor ">
            <div class="thumbnail item-alto">
              <div class="caption">
                <h3>{{ $proveedor->nombre . ' ' . $proveedor->apellido }}</h3>
                <p><b>Ruc: </b>{{ $proveedor->ruc }}</p>
                <p><b>Teléfono: </b>{{ $proveedor->telefono }}</p>
                <p><b>Email: </b>{{ $proveedor->email }}</p>
                <p><b>Dirección: </b>{{ $proveedor->direccion }}</p>
                <p><b>Ciudad: </b>{{ $proveedor->ciudad }}</p>
                
              </div>
              <div class="action">
                  <p><a href="{{ url('proveedores' . '/edit' . '/' .$proveedor->id ) }}" class="btn btn-primary" role="button">Editar</a> 
                <a href="{{ url('proveedores' . '/delete' . '/' .$proveedor->id ) }}" class="btn btn-default" role="button">Eliminar</a></p>
              </div>
            </div>
        </div>

        @endforeach

        @else
        <div class="col-lg-4 col-lg-offset-4 col-sm-6 col-md-4 col-xs-12 item-cliente m_top_30">
            <div class="thumbnail">
                <div class="caption">
                    <p class="text-center">Aun no hay proveedores, registra un nuevo cliente.</p>
                </div>
            </div>
        </div>

        @endif

        <div class="row">
            <div class="col-lg-12 text-center">{{ $proveedores->links() }}</div>
        </div>

    </div>

</div>


<div class="modal fade" id="exampleModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">

        

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Registrar un nuevo cliente</h4>
        </div>
        <div class="modal-body">
          <div class="container">
          <div class="row">
<form method="post" action="{{ url('/clientes/insert') }}" >
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
                      <input type="text" name="nombre" class="form-control">
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
              <button type="button" class="btn btn-primary" rol="button">Registrar cliente</button>
              </form>

          </div>
        </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            
        </div>
          
      </div>
      
    </div>
  </div>



@endsection
