@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <h3>Editando cliente: {{ $clientes->nombre }}</h3>
        </div>
        <div class="col-lg-8">
            <ul class="nav-nav navbar-right">
                <li><a href="{{ url('/clientes') }}" class="btn btn-primary">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                </a></li>
            </ul>
        </div>
    </div>
</div>

<div class="container">

<div class="panel panel-default panel-content">
<div class="panel-body">
    <div class="row">
    
        <div class="col-lg-12">

            <form method="post" action="{{ url('clientes' . '/update' . '/' .$clientes->id ) }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="nombre" class="form-control" value="{{ $clientes->nombre }}">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Apellido</label>
                            <input type="text" name="apellido" class="form-control" value="{{ $clientes->apellido }}">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Ruc</label>
                            <input type="text" name="ruc" class="form-control" value="{{ $clientes->ruc }}">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Telefono</label>
                            <input type="text" name="telefono" class="form-control" value="{{ $clientes->telefono }}">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" value="{{ $clientes->email }}">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Direccion</label>
                            <input type="text" name="direccion" class="form-control" value="{{ $clientes->direccion }}">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Ciudad</label>
                            <input type="text" name="ciudad" class="form-control" value="{{ $clientes->ciudad }}">
                        </div>
                    </div>        

                
                
                
                </div>
                <div class="row">
                    <div class="col-lg-12 text-right">
                        <button class="btn btn-primary">Actualizar</button>
                    </div>
                </div>

            </form>
            

        </div>

    </div>
    </div>
    </div>

</div>



@endsection
