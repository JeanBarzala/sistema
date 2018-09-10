
  <div class="nav-extended" style="@if (Auth::guest())display: none;@endif">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container-fluid">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', '') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar 
                <ul class="nav navbar-nav navbar-left">
                    <li><a href="{{ url('/home') }}">Inicio</a></li>
                    <li><a href="{{ url('/clientes') }}">Clientes</a></li>
                    <li><a href="{{ url('/productos') }}">Productos</a></li>
                    <li><a href="{{ url('/materiales') }}">Materiales</a></li>
                    <li><a href="{{ url('/ventas') }}">Ventas</a></li>
                </ul>
                -->
                <div class="menu-container navbar-left">
                    <div class="menu dropdown">
                        <ul class="">
                            <li><a href="{{ url('/') }}">Dashboard</a></li>
                            <li><a href="{{ route('ventas.pedidos') }}" class="dropdown-toggle " type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">@lang('constans.menu.ventas.title') <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><h4>{{ __('constans.menu.ventas.submenu.pedidos.title') }}</h4>
                                        <ul>
                                            <li><a href="{{ route('ventas.pedidos') }}">{{ __('constans.menu.ventas.submenu.pedidos.action1') }}</a></li>
                                            <li><a href="{{ route('ventas.pedidos.pos') }}">{{ __('constans.menu.ventas.submenu.pedidos.action2') }}</a></li>
                                        </ul>
                                    </li>
                                    <li><h4>{{ __('constans.menu.ventas.submenu.facturacion.title') }}</h4>
                                        <ul>
                                            <li><a href="{{ route('ventas.facturacion') }}">{{ __('constans.menu.ventas.submenu.facturacion.action1') }}</a></li>
                                        </ul>
                                    </li>
                                    <li><h4>{{ __('constans.menu.ventas.submenu.remisiones.title') }}</h4>
                                        <ul>
                                            <li><a href="{{ route('ventas.remisiones') }}">{{ __('constans.menu.ventas.submenu.remisiones.action1') }}</a></li>
                                        </ul>
                                    </li>
                                    <li><h4>{{ __('constans.menu.ventas.submenu.cobros.title') }}</h4>
                                        <ul>
                                            <li><a href="{{ route('ventas.cobranzas') }}">{{ __('constans.menu.ventas.submenu.cobros.action1') }}</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="{{ url('/clientes') }}" class="dropdown-toggle " type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">@lang('constans.menu.contactos.title') <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><h4>@lang('constans.menu.contactos.submenu.clientes.title')</h4>
                                        <ul>
                                            <li><a href="{{ url('/clientes') }}">@lang('constans.menu.contactos.submenu.clientes.action1')</a></li>
                                            <li><a href="{{ url('/clientes/create') }}">@lang('constans.menu.contactos.submenu.clientes.action2')</a></li>
                                        </ul>
                                    </li>
                                    {{--
                                    <li><h4>Direcciones</h4>
                                        <ul>
                                            <li><a href="{{ url('/clientes') }}">Lista de direcciones</a></li>
                                            <li><a href="{{ url('/clientes/create') }}">Nueva dirección</a></li>
                                        </ul>
                                    </li>
                                    --}}
                                </ul>
                                
                            </li>


                            <li><a href="{{ url('/productos') }}" class="dropdown-toggle " type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Almacen <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><h4>Productos</h4>
                                        <ul>
                                            <li><a href="{{ url('/productos') }}">Lista de productos</a></li>
                                            <li><a href="{{ url('/productos/create') }}">Nuevo producto</a></li>
                                        </ul>
                                    </li>
                                    <li><h4>Categorías</h4>
                                        <ul>
                                            <li><a href="{{ url('/categorias') }}">Lista de categorias</a></li>
                                            <li><a href="{{ url('/categorias/crear') }}">Nueva categoría</a></li>
                                        </ul>
                                    </li>
                                    <li><h4>Control</h4>
                                        <ul>
                                            <li><a href="{{ url('/monitoreo') }}">Monitoreo de almacen</a></li>
                                        </ul>
                                    </li>
                                </ul>
                                
                            </li>
                            <li><a href="{{ url('/clientes') }}"  class="dropdown-toggle " type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Sistema <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><h4>Tarjetas</h4>
                                        <ul>
                                            <li><a href="{{ route('tarjeta.index') }}">Listar tarjetas</a></li>
                                            <li><a href="{{ route('tarjeta.create') }}">Nueva Tarjeta</a></li>
                                        </ul>
                                    </li>
                                    <li><h4>Motivos</h4>
                                        <ul>
                                            <li><a href="{{ route('motivos.index') }}">Listar motivos</a></li>
                                            <li><a href="{{ route('motivos.create') }}">Nuevo motivo</a></li>
                                        </ul>
                                    </li>
                                    @if(Auth::user())
                                    @if(Auth::user()->hasAnyRole(['ADMINISTRADOR', 'GERENTE', 'GERENTE_SUPERVISOR']))
                                    <li><h4>Usuarios</h4>
                                        <ul>
                                            <li><a href="{{ route('usuario.all') }}">Listar usuarios</a></li>
                                            <li><a href="{{ route('usuario.create') }}">Nuevo usuario</a></li>
                                        </ul>
                                    </li>
                                    <li><h4>Cajas</h4>
                                        <ul>
                                            <li><a href="{{ route('cajas.index') }}">Listar cajas</a></li>
                                            <li><a href="{{ route('cajas.create') }}">Nueva caja</a></li>
                                        </ul>
                                    </li>
                                    <li><h4>Talonarios</h4>
                                        <ul>
                                            <li><a href="{{ route('talonarios.index') }}">Listar talonarios</a></li>
                                            <li><a href="{{ route('talonarios.create') }}">Nuevo talon</a></li>
                                        </ul>
                                    </li>
                                    <li><h4>Bocas de impresión</h4>
                                        <ul>
                                            <li><a href="{{ route('bocas.index') }}">Listar bocas de impresión</a></li>
                                            <li><a href="{{ route('bocas.create') }}">Nueva boca de impresión</a></li>
                                        </ul>
                                    </li>
                                    @endif
                                    @endif
                                </ul>
                            </li>
                            <li><a href="#"  class="dropdown-toggle " type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Informes <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><h4>Estado de cuenta</h4>
                                        <ul>
                                            <li><a href="{{ route('informes.estadoCuenta.index') }}">Consultar</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">

                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Iniciar sesión</a></li>
                        <!--<li><a href="{{ url('/register') }}">Register</a></li>-->
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <div class="nav-avatar" style="background-image: url('{{ url('upload/') .'/'. Auth::user()->image }}');">
                                </div>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/account') }}">Mi perfil</a>
                                </li>
                                <li>
                                    <a href="{{ url('/logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Salir
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>

                            </ul>
                        </li>
                    @endif
                </ul>

            </div>
        </div>
    </nav>
</div>