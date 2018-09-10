@extends('layouts.app')

@section('content')
<div class="header-page">
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-8">
            <h3>Talonarios</h3>
        </div>
        <div class="col-lg-4 col-md-4">
            <ul class="nav-nav navbar-right">
                <li><a href="{{ route('talonarios.create') }}" class="btn btn-primary">Crear talon</a></li>
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
                    Listado de talonarios:
                    <span class="help" data-toggle="tooltip" title="Puedes editar y crear nuevos talonarios.">[?]</span>
                </div>
                <div class="panel-body">
                    <table class="table table-condensed table-hover">
                        <thead>
                            <th>ID</th>
                            <th>Serie</th>
                            <th>Nro. Inicio</th>
                            <th>Nro. Final</th>
                            <th>Último Nro.</th>
                            <th>Tipo</th>
                            <th>Fecha Venc.</th>
                            <th>Fecha Registro.</th>
                            <th>Timbrado</th>
                            <th class="text-right">Acciones</th>
                        </thead>
                        <tbody>
                            @foreach($talonarios as $talon)
                            <tr>
                                <td>{{ $talon->id_talon }}</td>
                                <td>{{ $talon->serie_talon }}</td>
                                <td>{{ $talon->nro_inicio_talon }}</td>
                                <td>{{ $talon->nro_final_talon }}</td>
                                <td>{{ $talon->ultimo_nro_talon }}</td>
                                <td>{{ $talon->tipo_talon }}</td>
                                <td>{{ $talon->fecha_vencimiento_talon }}</td>
                                <td>{{ $talon->created_at ? $talon->created_at : '-'  }}</td>
                                <td>{{ $talon->timbrado_talon ? $talon->timbrado_talon : '-' }}</td>
                                {{--                            
                                <td>
                                    @if($talon->estado_producto == 1)
                                    <span class="label label-success">Activo</span>
                                    @else
                                    <span class="label label-danger">Inactivo</span>
                                    @endif
                                </td>
                                --}}
                                <td class="text-right">
                                    <a href="{{ route('talonarios.edit', ['id' => $talon->id_talon]) }}" class="btn btn-primary btn-sm">Editar</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
               
            </div>
        </div>
        <div class="col-lg-12 text-center">
            {!! $talonarios->links() !!}
        </div>
    </div>

</div>

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Eliminar talon</h4>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de eliminar el talon <b><span id="talon_title"></span></b>?</p>
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
    $('#talon_title').text($(this).data('title'));
});

</script>
<style type="text/css">
    .table .thumbnail {
        max-width: 80px;
    }
</style>
@endsection
