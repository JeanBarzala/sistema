@extends('layouts.app')

@section('content')
<div class="login">
<div class="container m_top_30 login">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default shadow">
                <div class="panel-heading text-center">
                    <img src="{{ url('img/default-avatar.png') }}" class="img-circle" style="width: 100px;"><br>
                    Bienvenido/a de vuelta

                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 text-center"><p>Ingresa tu nombre de usuario y contraseña<br>y conectate a tu espacio de trabajo</p></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            
                        
            
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                                {{ csrf_field() }}
                                <div class="col-lg-12">

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                                   
                                        <input id="password" type="password" class="form-control" name="password" required placeholder="Contraseña">

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    
                                </div>
                                {{--
                                <div class="form-group">
                                   
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recordarme
                                            </label>
                                        </div>

                                       
                                
                                </div>
                                --}}
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group text-center">
                                   
                                        <button type="submit" class="btn btn-primary-inverse" style="width: 100%;">
                                            Iniciar
                                        </button>

                                        <!--
                                        <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                            Forgot Your Password?
                                        </a>
                                        -->
                                    
                                </div>
                                </div>

                                
                                
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>


@endsection
