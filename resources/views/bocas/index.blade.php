@extends('layouts.app')

@section('content')
<div class="header-page">
<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <h3>Bocas de impresión</h3>
        </div>
        <div class="col-lg-8">
            <ul class="nav-nav navbar-right">
                <li><a href="{{ route('bocas.create') }}" class="btn btn-primary">Crear boca de impresión</a></li>
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
    <div class="row" style="display: none;">
        <div class="col-lg-12">
            <div class="panel panel-default panel-content">
                <div class="panel-heading">
                    Listado de bocas de impresión:
                    <span class="help" data-toggle="tooltip" title="Puedes editar y crear nuevas bocas de impresión.">[?]</span>
                </div>
                
                <div class="panel-body">
                    <table class="table table-condensed table-hover">
                        <thead>
                            <th>Boca Facturación</th>
                            <th>Talonario</th>
                            <th>Nro. Actual</th>
                            <th>Host</th>
                            <th>URI Impresora</th>
                            <th>Tipo impresora</th>
                            <th class="text-right">Acciones</th>
                        </thead>
                        <tbody>
                            @foreach($bocas as $boca)
                            <tr>
                                <td>{{ $boca->numero_boca_facturacion }}</td>
                                <td>
                                    @if($boca->talonario)
                                    {{ $boca->talonario->tipo_talon . ' - ' . $boca->talonario->serie_talon . ' Inicio: ' . $boca->talonario->nro_inicio_talon .' Final: '.$boca->talonario->nro_final_talon .' Actual: '. $boca->talonario->utlimo_nro_talon .' Vto.: '. $boca->talonario->fecha_vencimiento_talon }}
                                    @endif
                                </td>
                                <td>
                                   @if($boca->talonario)
                                    {{ $boca->talonario->ultimo_nro_talon}}
                                    @endif
                                </td>
                                <td>
                                    {{ $boca->host_facturacion }}
                                </td>
                                <td>
                                    {{ $boca->uri_print }}
                                </td>
                                <td>
                                    {{ $boca->tipo_impresora }}
                                </td>
                                <td>
                                    @if($boca->estado_boca_facturacion == 'ACTIVO')
                                    <span class="label label-success">Activo</span>
                                    @else
                                    <span class="label label-danger">Inactivo</span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <a href="{{ route('bocas.edit', ['id' => $boca->id_boca_facturacion]) }}" class="btn btn-primary btn-sm">Editar</a>
                                    <a href="#" class="btn btn-default btn-sm btn-delete" data-toggle="modal" data-target="#modal-default" data-title="{{ $boca->numero_boca_facturacion }}" data-route="{{ route('bocas.destroy', ['id' => $boca->id_boca_facturacion]) }}">Eliminar</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
               
            </div>
        </div>
    </div>

    <div class="row row-flex">
        @if(count($bocas))
        @foreach($bocas as $boca)
        <div class="col-lg-3">
            <div class="panel printer-card">
                <div class="panel-body">
                        @if($boca->estado_boca_facturacion == 'ACTIVO')
                        <span class="label label-success">Activo</span>
                        @else
                        <span class="label label-danger">Inactivo</span>
                        @endif
                    <div class="thum-printer">
                        @if($boca->estado_boca_facturacion == 'ACTIVO')
                        <img src="{{ url('img/printer-icon.png') }}" class="img-responsive center-block">
                        @else
                        <img src="{{ url('img/printer-icon_red.png') }}" class="img-responsive center-block">
                        @endif
                    </div>
                    <h3 class="text-center">{{ $boca->numero_boca_facturacion }}</h3>
                    <div class="text-center" style="display: none;">
                        
                        
                        <p>Tipo: <b>{{ $boca->tipo_impresora }}</b></p>
                        <p>Host: <b>{{ $boca->host_facturacion }}</b></p>
                        <p>URI: <b>{{ $boca->uri_print }}</b></p>
                        @if($boca->talonario)
                        <p>
                            <em>
                            {{ $boca->talonario->tipo_talon . ' - ' . $boca->talonario->serie_talon . ' Inicio: ' . $boca->talonario->nro_inicio_talon .' Final: '.$boca->talonario->nro_final_talon .' Actual: '. $boca->talonario->utlimo_nro_talon .' Vto.: '. $boca->talonario->fecha_vencimiento_talon }}
                            </em>
                        </p>
                        @endif
                        @if($boca->talonario)
                        <p>
                            Último nro:
                            <b>
                            {{ $boca->talonario->ultimo_nro_talon}}
                            </b>
                        </p>
                        @endif
                    </div>
                </div>
                <div class="panel-footer text-right">
                    <a href="{{ route('bocas.edit', ['id' => $boca->id_boca_facturacion]) }}" class="btn btn-primary btn-sm">Editar</a>
                    <a href="#" class="btn btn-default btn-sm btn-delete" data-toggle="modal" data-target="#modal-default" data-title="{{ $boca->numero_boca_facturacion }}" data-route="{{ route('bocas.destroy', ['id' => $boca->id_boca_facturacion]) }}">Eliminar</a>
                </div>
            </div>
        </div>
        @endforeach
        @endif

    </div>
    @if(count($bocas))
    <div class="row">
        <div class="col-lg-12 text-center">
            {!! $bocas->links() !!}
        </div>
    </div>
    @endif

</div>


<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Eliminar boca de impresión</h4>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de eliminar <b><span id="boca_title"></span></b>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                {!! Form::open(['method' => 'post']) !!}
                    {!! Form::button('Sí, eliminar', ['class' => 'btn btn-danger', 'type' => 'submit']) !!}
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
    $('#boca_title').text($(this).data('title'));
});

</script>
<style type="text/css">
    .table .thumbnail {
        max-width: 80px;
    }
</style>
@endsection
