@extends('layouts.app')

@section('content')
<div class="header-page">
<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <h3>Cajas</h3>
        </div>
        <div class="col-lg-8">
            <ul class="nav-nav navbar-right">
                <li><a href="{{ route('cajas.create') }}" class="btn btn-primary">Crear caja</a></li>
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
                    Listado de cajas:
                    <span class="help" data-toggle="tooltip" title="Puedes editar y crear nuevas cajas.">[?]</span>
                </div>
                
                <div class="panel-body">
                    <table class="table table-condensed table-hover">
                        <thead>
                            <th>ID</th>
                            <th>Código de caja</th>
                            <th>Descripción</th>
                            <th>Tipo de caja</th>
                            <th>Fecha de registro</th>
                            <th>Fecha de baja</th>
                            <th>Estado</th>
                            <th class="text-right">Acciones</th>
                        </thead>
                        <tbody>
                            @foreach($cajas as $caja)
                            <tr>
                                <td>{{ $caja->id_caja }}</td>
                                <td>{{ $caja->codigo_caja }}</td>
                                <td>{{ $caja->descripcion_caja }}</td>
                                <td>{{ $caja->tipo_caja }}</td>
                                
                                <td>{{ $caja->fecha_registro_caja ? $caja->fecha_registro_caja : '-'  }}</td>
                                <td>{{ $caja->fecha_baja_caja ? $caja->fecha_baja_caja : '-'  }}</td>
                                <td>
                                    @if($caja->estado_caja == 'HABILITADA')
                                    <span class="label label-success">Activo</span>
                                    @else
                                    <span class="label label-danger">Inactivo</span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <a href="{{ route('cajas.edit', ['id' => $caja->id_caja]) }}" class="btn btn-primary btn-sm">Editar</a>
                                    <a href="#" class="btn btn-default btn-sm btn-delete" data-toggle="modal" data-target="#modal-default" data-title="#" data-route="#">Eliminar</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
               
            </div>
        </div>
        <div class="col-lg-12 text-center">
            {!! $cajas->links() !!}
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
