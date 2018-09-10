@extends('layouts.app')

@section('content')
<div class="header-page">
<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <h3>Registrar usuario</h3>
        </div>
        <div class="col-lg-8">
            <ul class="nav-nav navbar-right">
                <!--<li>
                    <div class="search-input">
                        <i class="fa fa-search" aria-hidden="true"></i>
                        <input type="text" name="b" placeholder="Buscar">
                    </div>
                </li>-->
                <li><a href="{{ url('/account') }}" class="btn btn-primary">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                </a></li>
            </ul>
        </div>
    </div>
</div>
</div>
<div class="container m_top_30">

    <div class="row">
    
        <div class="col-lg-12">
        <form method="post" action="{{ route('usuario.store') }}" enctype="multipart/form-data">
        <div class="panel panel-default">

            <div class="panel-body">
            

                {{ csrf_field() }}

                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" name="nombre" class="form-control" >
                                </div>
                            </div>

                            <div class="col-lg-4">

                                <div class="form-group">
                                    <label>Apellido</label>
                                    <input type="text" name="apellido" class="form-control" >
                                </div>

                            </div>

                            <div class="col-lg-4">

                                <div class="form-group">
                                  <label>Rol de usuario</label>
                                  {!! Form::select('role[]', $roles, null, ['class' => 'form-control select', 'multiple' => '']) !!}
                                </div>

                            </div>

                            <div class="col-lg-4">

                                <div class="form-group">
                                    <label>CI</label>
                                    <input type="text" name="ci" class="form-control" >
                                </div>

                            </div>

                            <div class="col-lg-4">

                                <div class="form-group">
                                    <label>Correo electrónico</label>
                                    <input type="text" name="email" class="form-control" required="">
                                </div>

                            </div>

                            <div class="col-lg-4">

                                <div class="form-group">
                                    <label>Vehiculo</label>
                                    <input type="text" name="vehiculo" class="form-control">
                                </div>

                            </div>

                            <div class="col-lg-4">

                                <div class="form-group">
                                    <label>Matricula</label>
                                    <input type="text" name="matricula" class="form-control">
                                </div>

                            </div>

                            <div class="col-lg-4">

                                <div class="form-group">
                                    <label>Contraseña</label>
                                    <input type="text" name="password" class="form-control">
                                </div>

                            </div>

                            
                        </div>
                    </div>

                </div>
            </div>
            <div class="panel-footer text-right">

                <button class="btn btn-primary">Registrar</button>
            </div>

            

        </div>
        </form>
            

        </div>

    </div>

</div>



@endsection
@section('script')
<script type="text/javascript">
    $(".select").select2({
          language: "es",
        });
    @if (Session::has('message'))
    var mensaje = '{{ Session::get('message') }}';
    report(mensaje);
    @endif
</script>
@endsection
