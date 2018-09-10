{{--
@if(!empty($result))

@if($total > 0)
<div class="col-lg-12 text-center">
    <p>Se @if($total == 1) muestra @else muestran @endif <b>{{ $total }}</b> clientes como resultado</p>
</div>
@else

@endif

@forelse ($result as $cliente)

<div class="col-lg-3 col-sm-6 col-md-4 col-xs-12">

  <div class="panel panel-default">
    <div class="panel-body item-alto">

        <h3>{{ $cliente->nombre_persona ? titleCase($cliente->nombre_persona) . ' ' : '- - -' .titleCase($cliente->apellido_persona)  }}</h3>

        <p><b>Razon Social: </b>{{ $cliente->razon_social_persona ? titleCase($cliente->razon_social_persona) : '- - -' }}</p>
        <p><b>CI: </b>{{ $cliente->num_doc_persona ? $cliente->num_doc_persona : '- - -' }}</p>
        <p><b>RUC: </b>{{ $cliente->ruc_persona }}</p>
        <p><b>Teléfono: </b>{{ $cliente->id_cliente }}</p>
        <p><b>Email: </b>{{ $cliente->email_persona ? $cliente->email_persona : '- - -'  }}</p>
        <p><b>Dirección: </b></p>

        <p><b>Nro de Cliente: </b>{{ $cliente->id_cliente }}</p>
    </div>
    <div class="panel-footer">
        <a href="{{ url('clientes' . '/editar' . '/' .$cliente->id_persona ) }}" class="btn btn-primary" role="button">Editar</a> 
        <a href="{{ url('clientes' . '/eliminar' . '/' .$cliente->id_persona ) }}" class="btn btn-default" role="button">Eliminar</a>
    </div>
  </div>

</div>

@empty
<div class="col-lg-6 col-lg-offset-3 col-sm-6 col-md-4 col-xs-12 item-cliente m_top_30">
    <div class="panel panel-default">
        <div class="panel-body text-center">
            No encontramos resultados para tu búsqueda :(, intenta nuevamente.
        </div>
    </div>
</div>
@endforelse

@else
<div class="col-lg-6 col-lg-offset-3 col-sm-6 col-md-4 col-xs-12 item-cliente m_top_30">
    <div class="panel panel-default">
        <div class="panel-body text-center">
            No encontramos resultados para tu búsqueda :(, intenta nuevamente.
        </div>
    </div>
</div>
@endif

--}}


@if(!empty($result))

@if($total > 0)
<div class="col-lg-12 text-center">
    <p>Se @if($total == 1) muestra @else muestran @endif <b>{{ $total }}</b> clientes como resultado</p>
</div>
@else

@endif

@forelse ($result as $cliente)
<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
    <div class="row full-list">
        <div class="col-lg-12 full-list-row">
            <ul>
                <li class="cliente-id" data-idPersona="{{ $cliente->id_persona }}" data-idCliente="{{ $cliente->id_cliente }}">
                    <a data-target="#modal-detail" data-toggle="modal" type="button" href="#" title="Ver detalles del producto" data-detail="{{ url('clientes/find/'.$cliente->id_persona) }}">
                        <div class="pull-left letter" style="background-color: {{ randColor() }};">{!! $cliente->nombre_persona ? firstLetter($cliente->nombre_persona) : firstLetter($cliente->apellido_persona) !!}</div>
                        <h4 class="colum pull-left">{{ titleCase($cliente->nombre_persona) .' '. titleCase($cliente->apellido_persona) }}</h4>

                        <h5 class="colum pull-right">{{ $cliente->email_persona }}</h5>
                        <h5 class="colum pull-right">{{ $cliente->num_doc_persona }}</h5>
                    </a>
                    <div class="action-list">
                        <a href="{{ url('clientes' . '/editar' . '/' .$cliente->id_persona ) }}" role="button">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </a>
                        <a href="{{ route('clientes.pedidos', ['id' => $cliente->id_persona]) }}" role="button" title="Ver historial {{ $cliente->nombre_persona ? 'de '.titleCase($cliente->nombre_persona) : 'del cliente' }}">
                            <i class="fa fa-history" aria-hidden="true"></i>
                        </a>
                        <a href="#" class="btn-delete" data-toggle="modal" data-target="#modal-cliente" data-title="{{ $cliente->nombre_persona }}" data-route="{{ route('clientes.delete', ['id_persona' => $cliente->id_persona]) }}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
@empty
<div class="row">
    <div class="col-lg-6 col-lg-offset-3 col-sm-6 col-md-4 col-xs-12 item-cliente m_top_30">
        <div class="panel panel-default">
            <div class="panel-body text-center">
                No encontramos resultados para tu búsqueda :(, intenta nuevamente.
            </div>
        </div>
    </div>
</div>
@endforelse

@else
<div class="row">
    <div class="col-lg-6 col-lg-offset-3 col-sm-6 col-md-4 col-xs-12 item-cliente m_top_30">
        <div class="panel panel-default">
            <div class="panel-body text-center">
                No encontramos resultados para tu búsqueda :(, intenta nuevamente.
            </div>
        </div>
    </div>
</div>
@endif
