
@extends('layouts.app')

@section('content')
<div class="header-page">
<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <h3>Mi pefil</h3>
        </div>
        <div class="col-lg-8">
            <ul class="nav-nav navbar-right">
                <li><a href="{{ url('/account/create') }}" class="btn btn-primary">Nuevo usuario</a></li>
            </ul>
        </div>
    </div>
</div>
</div>

<div class="container m_top_30">
    <div class="row">
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-body" style="overflow: hidden;">
                    <div class="head-avatar" style="background-image: url('{{ Auth::user()->image ? url('upload/'.Auth::user()->image) : url('img/user.png') }}');">
                        
                    </div>
                    <div class="content-card-user">
                        <div class="row">
                            <div class="col-lg-4 col-lg-offset-4">
                                <div class="thumbnail">
                                    @if (empty(Auth::user()->image))
                                    <img src="{{ url('img/user.png') }}">
                                    @else
                                    <img src="{{ url('upload/'. Auth::user()->image) }}">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <h1>{{ Auth::user()->persona->nombre_persona .' '. Auth::user()->persona->apellido_persona  }}</h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <table class="table">
                                        <tr>
                                            <td class="text-right">CI:</td>
                                            <td>{{ Auth::user()->persona->num_doc_persona }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-right">Correo:</td>
                                            <td>{{ Auth::user()->persona->email_persona }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <form method="post" action="{{ route('usuario.update', ['id' => Auth::user()->id, 'id_persona' => Auth::user()->persona->id_persona] ) }}" enctype="multipart/form-data">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Editar información
                    </div>
                    <div class="panel-body">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Nombre de usuario</label>
                                            <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Nombre</label>
                                            <input type="text" name="nombre" class="form-control" value="{{ Auth::user()->persona->nombre_persona }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Apellido</label>
                                            <input type="text" name="apellido" class="form-control" value="{{ Auth::user()->persona->apellido_persona }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>CI</label>
                                            <input type="text" name="ci" class="form-control" value="{{ Auth::user()->persona->num_doc_persona }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Correo electrónico</label>
                                            <input type="text" name="email" class="form-control" value="{{ Auth::user()->persona->email_persona }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Foto</label>
                                            <input type="file" name="profile" class="form-control">
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
    @if (Session::has('message'))
    var mensaje = '{{ Session::get('message') }}';
    report(mensaje);
    @endif
</script>

@endsection