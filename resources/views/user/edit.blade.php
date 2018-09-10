@extends('layouts.app')

@section('content')
<div class="header-page">
<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <h3>Editando usuario: {{ $usuarios->persona->nombre_persona }}</h3>
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
        <form method="post" action="{{ route('usuario.update', ['id' => $usuarios->id, 'id_persona' => $usuarios->persona->id_persona] ) }}" enctype="multipart/form-data">
        <div class="panel panel-default">

            <div class="panel-body">

                {{ csrf_field() }}

                <div class="row">
                    <div class="col-lg-4">
                        @if($usuarios->image)
                        <img src="{{ url('upload/') .'/'. $usuarios->image  }}" class="img-responsive center-block">
                        @else
                        <p class="text-center">Ninguna foto ha sido seleccionada</p>
                        @endif
                    </div>
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Nombre de usuario</label>
                                    <input type="text" name="name" class="form-control" value="{{ $usuarios->name }}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" name="nombre" class="form-control" value="{{ $usuarios->persona->nombre_persona }}">
                                </div>
                            </div>

                            <div class="col-lg-4">

                                <div class="form-group">
                                    <label>Apellido</label>
                                    <input type="text" name="apellido" class="form-control" value="{{ $usuarios->persona->apellido_persona }}">
                                </div>

                            </div>
                            

                            <div class="col-lg-4">

                                <div class="form-group">
                                    <label>CI</label>
                                    <input type="text" name="ci" class="form-control" value="{{ $usuarios->persona->num_doc_persona }}">
                                </div>

                            </div>

                            <div class="col-lg-4">

                                <div class="form-group">
                                    <label>Correo electrónico</label>
                                    <input type="text" name="email" class="form-control" value="{{ $usuarios->persona->email_persona }}">
                                </div>

                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Foto</label>
                                    <input type="file" name="profile" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-12">

                                <div class="form-group">
                                    <label>Role</label>
                                    {!! Form::select('role[]', $roles, $roles_selected, ['class' => 'form-control select', 'multiple' => '']) !!}
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Nueva contraseña</label>
                                    <input type="password" name="password" class="form-control" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="panel-footer text-right">

                <button class="btn btn-primary">Actualizar</button>
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