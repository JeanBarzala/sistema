
@extends('layouts.app')

@section('content')
<div class="header-page">

    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <h3>Monitoreo de productos</h3>
            </div>
            <div class="col-lg-8">
                <ul class="nav-nav navbar-right">
                    <!--<li>
                        <div class="search-input">
                            <i class="fa fa-search" aria-hidden="true"></i>
                            <input type="text" name="b" placeholder="Buscar">
                        </div>
                    </li>-->
                    
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="container m_top_30">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default panel-content">
                <div class="panel-heading">
                    Listado de categorías vacías:
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-condensed table-hover">
                                <thead>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default panel-content">
                <div class="panel-heading">
                    Listado de productos con stock vacío:
                    <span class="help" data-toggle="tooltip" title="Listado de productos que tiene un stock vacío.">[?]</span>
                </div>
                
                <div class="panel-body">
                    <table class="table table-condensed table-hover">
                        <thead>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th class="text-right">Acciones</th>
                        </thead>
                        <tbody>
                            @foreach($productoStock as $producto)
                            <tr>
                                <td>{{ $producto->id_producto }}</td>
                                <td>{{ $producto->nombre_producto }}</td>
                                <td>{{ $producto->descripcion_producto }}</td>
                                <td class="text-right">
                                <a href="{{ url('productos/editar') . '/' . $producto->id_agrupador }}" class="btn btn-primary btn-sm">Editar</a>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
               
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default panel-content">
                <div class="panel-heading">
                    Listado de productos eliminados:
                </div>
                
                <table class="table table-condensed table-hover">
                    <thead>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th class="text-right">Acciones</th>
                    </thead>
                    <tbody>
                        @foreach($productoDeleted as $producto)
                        <tr>
                            <td>{{ $producto->id_producto }}</td>
                            <td>{{ $producto->nombre_producto }}</td>
                            <td>{{ $producto->descripcion_producto }}</td>
                            <td class="text-right">
                                <a href="{{ url('productos/editar') . '/' . $producto->id_agrupador }}" class="btn btn-primary btn-sm">Editar</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
               
            </div>
        </div>
    </div>
    
</div>
<div class="resultado" id="resultado"></div>


{{--
<div class="container" style="display: none;">
    <div class="timeline-wrapper">
        <div class="timeline-item col-lg-4">
            <div class="animated-background">
                <div class="background-masker header-top"></div>
            </div>
        </div>
        <div class="timeline-item col-lg-4">
            <div class="animated-background">
                <div class="background-masker header-top"></div>
            </div>
        </div>
        <div class="timeline-item col-lg-4">
            <div class="animated-background">
                <div class="background-masker header-top"></div>
            </div>
        </div>
    </div>
</div>
--}}


@endsection
@section ('script')
<script type="text/javascript">
    $(document).ready(function(){
        $('.datatable').DataTable({
            'language': {
            'lengthMenu': 'Mostrando _MENU_ registros por página',
            'zeroRecords': 'No hay registros',
            'info': 'Mostrando página _PAGE_ de _PAGES_',
            'infoEmpty': 'No hay registros',
            'infoFiltered': '(de un total de _MAX_ registros)',
                'search': 'Buscar',
                    'paginate': {
                    'first':      'Inicio',
                    'last':       'Fin',
                    'next':       'Siguiente',
                    'previous':   'Anterior'
                    }
            },
        });

        $('[data-toggle="tooltip"]').tooltip(); 

        
    });
</script>
@endsection