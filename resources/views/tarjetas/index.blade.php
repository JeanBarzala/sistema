@extends('layouts.app')

@section('content')
<div class="header-page">
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-8">
            <h3>Tarjetas</h3>
        </div>
        <div class="col-lg-4 col-md-4">
            <ul class="nav-nav navbar-right">
                <li><a href="{{ route('tarjeta.create') }}" class="btn btn-primary">Crear tarjeta</a></li>
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
                    Listado de tarjetas:
                    <span class="help" data-toggle="tooltip" title="Puedes editar y crear nuevas tarjetas.">[?]</span>
                </div>
                <div class="panel-body">
                    <table class="table table-condensed table-hover">
                        <thead>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Fecha de creación</th>
                            <th>Estado</th>
                            <th class="text-right">Acciones</th>
                        </thead>
                        <tbody>
                            @foreach($tarjetas as $tarjeta)
                            <tr>
                                <td>{{ $tarjeta->id_producto }}</td>
                                <td>{{ $tarjeta->nombre_producto }}</td>
                                <td>{{ $tarjeta->descripcion_producto }}</td>
                                
                                <td>{{ $tarjeta->created_at ? $tarjeta->created_at : '-'  }}</td>
                                <td>
                                    @if($tarjeta->estado_producto == 1)
                                    <span class="label label-success">Activo</span>
                                    @else
                                    <span class="label label-danger">Inactivo</span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <a href="{{ route('tarjeta.edit', ['id' => $tarjeta->id_producto]) }}" class="btn btn-primary btn-sm">Editar</a>
                                    <a href="#" class="btn btn-default btn-sm btn-delete" data-toggle="modal" data-target="#modal-default" data-title="{{ $tarjeta->nombre_producto }}" data-route="{{ route('tarjeta.delete', ['id' => $tarjeta->id_producto]) }}">Eliminar</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
               
            </div>
        </div>
        <div class="col-lg-12 text-center">
            {!! $tarjetas->links() !!}
        </div>
    </div>

</div>

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Eliminar tarjeta</h4>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de eliminar la tarjeta <b><span id="motivo_title"></span></b>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                {!! Form::open(['method' => 'post']) !!}
                    {!! Form::button('Sí, eliminar tarjeta', ['class' => 'btn btn-danger', 'type' => 'submit']) !!}
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@endsection

@section ('script')
<script type="text/javascript">
    $(document).ready(function(){
        $('.datatable').DataTable();

        $('[data-toggle="tooltip"]').tooltip(); 

        
    });
$(document).on('click', '.btn-delete', function(){
    $('.modal form').attr('action', $(this).data('route'));
    $('#motivo_title').text($(this).data('title'));
});

</script>
<style type="text/css">
    .table .thumbnail {
        max-width: 80px;
    }
</style>
@endsection
