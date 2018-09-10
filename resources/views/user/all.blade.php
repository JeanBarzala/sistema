
@extends('layouts.app')

@section('content')
<div class="header-page">
<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <h3>Usuarios</h3>
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

        <div class="col-lg-12">
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                      <div class="panel-body result-organic">
                        <div class="row">
                          <div class="col-lg-12">
                            @if (count($users) >= 1)
                            <table class="table table-condensed table-hover">
                                <thead>
                                  <tr>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Usuario</th>
                                    <th>Role</th>
                                    
                                    <th class="text-right">Acciones</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach ($users as $user)
                                    <tr>
                                      <td>{{ $user->persona->nombre_persona }}</td>
                                      <td>{{ $user->persona->apellido_persona }}</td>
                                      <td>{{ $user->name }}</td>
                                      <td>
                                        @if($user->roles_user)
                                        @foreach($user->roles_user as $roles)
                                        {{ $roles->name }}@if(!$loop->last),@endif
                                        @endforeach
                                        @endif
                                      </td>
                                      <td class="text-right">
                                          <a href="{{ route('usuario.edit', ['id' => $user->id]) }}" class="btn btn-primary btn-sm">Editar</a>
                                          <a href="#" class="btn btn-default btn-sm">Eliminar</a>
                                      </td>
                                    </tr>
                                  @endforeach
                                </tbody>
                              </table>
                              @else
                              <div class="row">
                                <div class="col-lg-4 col-lg-offset-4 col-sm-6 col-md-4 col-xs-12 item-cliente m_top_30">
                                    <div class="thumbnail">
                                        <div class="caption">
                                            <p class="text-center">Aun no hay usuarios, registra un nuevo usuario.</p>
                                        </div>
                                    </div>
                                </div>
                              </div>
                              @endif
                          </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                {!! $users !!}
                            </div>
                        </div>
                      </div>
                      <div class="panel-body result-content">
                         <div class="row"></div>
                      </div>
                    </div>
                  </div>
            </div>
                
        </div>
    
    </div>
    
</div>







@endsection
