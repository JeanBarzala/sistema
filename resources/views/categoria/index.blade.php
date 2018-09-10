@extends('layouts.app')

@section('content')
<div class="header-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <h3>Categorías</h3>
            </div>
            <div class="col-lg-8">
                <ul class="nav-nav navbar-right">
                    <li><a href="{{ url('/categorias/crear') }}" class="btn btn-primary">Crear categoría</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default panel-content">
                <div class="panel-heading">
                    Listado de categorías disponibles:
                    <span class="help" data-toggle="tooltip" title="Puedes editar y crear nuevas categorías. Al eliminar una categoría, los productos pertenecientes a dicha categoría quedaran sin categoría.">[?]</span>
                </div>
                <div class="panel-body">
                    <table class="table table-condensed table-hover">
                        <thead>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Portada</th>
                            <th>Fecha de creación</th>
                            <th>Estado</th>
                            <th class="text-right">Acciones</th>
                        </thead>
                        <tbody>
                            @foreach($categorias as $categoria)
                            <tr>
                                <td>{{ $categoria->id_agrupador }}</td>
                                <td>{{ $categoria->nombre_agrupador }}</td>
                                <td>{{ $categoria->descripcion_agrupador }}</td>
                                <td>
                                    @if($categoria->portada_agrupador)
                                    <img src="{{ url('upload/agrupadores/'.$categoria->portada_agrupador) }}" class="thumbnail">
                                    @else
                                    -
                                    @endif
                                </td>
                                <td>{{ $categoria->created_at ? $categoria->created_at : '-'  }}</td>
                                <td>
                                    @if ($categoria->estado_agrupador == 1)
                                    <span class="label label-success">Activo</span>
                                    @else
                                    <span class="label label-danger">Inactivo</span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <a href="{{ url('categorias/editar') . '/' . $categoria->id_agrupador }}" class="btn btn-primary btn-sm">Editar</a>
                                    <a href="#" class="btn btn-default btn-sm">Eliminar</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
               
            </div>
        </div>
        <div class="col-lg-12 text-center">
            {!! $categorias->links() !!}
        </div>
    </div>

</div>



@endsection

@section ('script')
<script type="text/javascript">
    $(document).ready(function(){
        $('.datatable').DataTable();

        $('[data-toggle="tooltip"]').tooltip(); 

        
    });
</script>
<style type="text/css">
    .table .thumbnail {
        max-width: 80px;
    }
</style>
@endsection
