@extends('layouts.app')

@section('content')
<div class="header-page">
<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <h3>Motivos</h3>
        </div>
        <div class="col-lg-8">
            <ul class="nav-nav navbar-right">
                <li><a href="{{ route('motivos.create') }}" class="btn btn-primary">Crear motivo</a></li>
            </ul>
        </div>
    </div>
</div>
</div>
@if(Session::has('message'))
<div class="container">
  <div class="alert alert-info m_top_30">
    {{ Session::get('message') }}
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  </div>
</div>
@endif
<div class="container m_top_30">


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default panel-content">
                <div class="panel-heading">
                    Listado de motivos disponibles:
                    <span class="help" data-toggle="tooltip" title="Puedes editar y crear nuevos motivos.">[?]</span>
                </div>
                
                <div class="panel-body">
                    <table class="table table-condensed table-hover">
                        <thead>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Fecha de creación</th>
                            <th>Estado</th>
                            <th class="text-right">Acciones</th>
                        </thead>
                        <tbody>
                            @foreach($motivos as $motivo)
                            <tr>
                                <td>{{ $motivo->id_motivo }}</td>
                                <td>{{ $motivo->nombre_motivo }}</td>
                                <td>
                                   {{ $motivo->created_at ? $motivo->created_at : '-'  }}
                                </td>
                                <td>
                                    @if($motivo->estado_motivo == 1)
                                    <span class="label label-success">Activo</span>
                                    @else
                                    <span class="label label-danger">Inactivo</span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <a href="{{ route('motivos.edit', ['id' => $motivo->id_motivo]) }}" class="btn btn-primary btn-sm">Editar</a>
                                    <a href="#" class="btn btn-default btn-sm btn-delete" data-toggle="modal" data-target="#modal-default" data-title="{{ $motivo->nombre_motivo }}" data-route="{{ route('motivos.destroy', ['id' => $motivo->id_motivo]) }}">Eliminar</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
               
            </div>
        </div>
        <div class="col-lg-12 text-center">
            {!! $motivos->links() !!}
        </div>
    </div>

</div>


<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Eliminar motivo</h4>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de eliminar el motivo <b><span id="motivo_title"></span></b>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                {!! Form::open(['method' => 'post']) !!}
                    {!! Form::button('Sí, eliminar motivo', ['class' => 'btn btn-danger', 'type' => 'submit']) !!}
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
