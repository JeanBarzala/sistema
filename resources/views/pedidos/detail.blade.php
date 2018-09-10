@extends('layouts.app')

@section('content')
<div class="header-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <h3>Pedido <b>#{{ $pedido->id_pedido }}</b></h3>
            </div>
            <div class="col-lg-8">
                <ul class="nav-nav navbar-right">
                    <li><a href="{{ route('ventas.pedidos') }}" class="btn btn-primary">Atrás</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <form method="post" action="{{ route('pedidos.cambiarEstado', ['id' => $pedido->id_pedido]) }}">
                @csrf
                <div class="panel panel-default panel-content">
                    <div class="panel-heading">
                        Estado de envío
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <label>Situación</label>
                                <select class="form-control">
                                    @foreach(config('cms.situacion') as $situacion)
                                    @if($situacion['name'] == $pedido->estado_toma_pedido)
                                    <option value="{{ $situacion['name'] }}" selected>{{ $situacion['val'] }}</option>
                                    @else
                                    <option value="{{ $situacion['name'] }}">{{ $situacion['val'] }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <label>Estado de envío</label>
                                <select class="form-control" name="">
                                    <option value="">--------------</option>
                                     @foreach(config('cms.estado_envio') as $est_envio)
                                    @if($est_envio['val'] == $pedido->estado_envio_pedido)
                                    <option value="{{ $est_envio['val'] }}" selected>{{ $est_envio['name'] }}</option>
                                    @else
                                    <option value="{{ $est_envio['val'] }}">{{ $est_envio['name'] }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <label>Chofer</label>
                                <select class="form-control">
                                    <option value="" disabled selected>Seleccione un chofer</option>
                                    @foreach($choferes as $chofer)
                                    @if($pedido->id_chofer)
                                    @if($pedido->id_chofer == $chofer->id)
                                    <option value="{{ $chofer->id }}" selected>{{ $chofer->persona->getFullName() }} {{ $chofer->name ? ' | '. $chofer->name : '' }}</option>
                                    @else
                                    <option value="{{ $chofer->id }}">{{ $chofer->persona->getFullName() }} | {{ $chofer->name }}</option>
                                    @endif
                                    @else
                                    <option value="{{ $chofer->id }}">{{ $chofer->persona->getFullName() }} | {{ $chofer->name }}</option>
                                    @endif

                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer text-right">
                        <button class="btn btn-primary-inverse">Aceptar</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
    

    <div class="panel panel-default panel-content">
        <div class="panel-heading">
            Detalles del pedido
        </div>
        <div class="panel-body">
        <div class="row">
            <div class="col-lg-12 text-left">
                <div class="row">
                    <div class="col-lg-6">
                        <h2>Pedido: #{{ $pedido->id_pedido}}</h2>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-4">
                                <p><b>Usuario:</b></p>
                            </div>
                            <div class="col-lg-8">
                                <p>{{ $pedido->usuario->persona->getFullName() }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <p><b>Estado del pedido:</b> </p>
                            </div>
                            <div class="col-lg-8">
                                <p>{{ $pedido->estado_pedido ? $pedido->estado_pedido : '-' }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <p><b>Condición de venta:</b> </p>
                            </div>
                            <div class="col-lg-8">
                                <p>{{ $pedido->forma_pago_pedido ? $pedido->forma_pago_pedido : '-' }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <p><b>Factura #:</b> </p>
                            </div>
                            <div class="col-lg-8">
                                <p>{{ $pedido->facturas ? $pedido->facturas->makeNumero() : 'Sin factura' }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <p><b>Remisión #:</b> </p>
                            </div>
                            <div class="col-lg-8">
                                <p>{{ $pedido->remisiones ? $pedido->remisiones->makeNumero() : 'Sin remisión' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-12">
                                <h4>Cliente</h4>
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="col-lg-4">
                                <p><b>Nombre:</b></p>
                            </div>
                            <div class="col-lg-8">
                                <p>{{ $pedido->cliente->persona->getFullname() }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <p><b>Fecha pedido:</b></p>
                            </div>
                            <div class="col-lg-8">
                                <p>{{ $pedido->fecha_hora_pedido }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <p><b>Tel. Pedido:</b></p>
                            </div>
                            <div class="col-lg-8">
                                <p>{{ $pedido->telefono_envio_pedido }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <p><b>Fecha/Cobro:</b></p>
                            </div>
                            <div class="col-lg-8">
                                <p>{{ $pedido->fecha_hora_cobro_pedido }}</p>
                            </div>
                        </div>
                        
                        
                        <div class="row">
                            <div class="col-lg-4">
                                <p><b>Motivo:</b></p>
                            </div>
                            <div class="col-lg-8">
                                <p>{{ $pedido->motivo ? $pedido->motivo->nombre_motivo : '' }}</p>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-12">
                                <h4>Envío</h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <p><b>Destinatario:</b></p>
                            </div>
                            <div class="col-lg-8">
                                @if($pedido->id_direccion_envio_pedido)
                                <p>{{ $pedido->persona->getFullName() }}</p>
                                @else
                                <p>-</p>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <p><b>Fecha de entrega:</b></p>
                            </div>
                            <div class="col-lg-8">
                                <p>{{ $pedido->fecha_hora_entrega_pedido }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <p><b>Dirección de entrega:</b></p>
                            </div>
                            <div class="col-lg-8">
                                @if($pedido->id_direccion_envio_pedido)
                                <p>{{ $pedido->direccion->getFullDireccion() }}</p>
                                @else
                                <p>Retirado desde el salón</p>
                                @endif  
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <label>Tarjeta:</label>
                <div style="border:solid 1px #f2f2f2; border-radius: 2px; padding: 15px; margin-bottom: 15px;">
                    {{ $pedido->descripcion_tarjeta_pedido }}
                </div>
            </div>
        </div>
        @if($detalles)
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Descripción</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detalles as $detalle)
                        <tr>
                            <td>{{ $detalle->productos->codigo_producto }}</td>
                            <td>{{ $detalle->productos->descripcion_producto }}</td>
                            <td>{{ $detalle->cantidad_detalle_pedido }}</td>
                            <td>{{ gs($detalle->productos->precio_producto, 1) }}</td>
                        </tr>
                        @endforeach
                        {{--
                        <tr>
                            <td colspan="3" class="text-right">Sub-Total:</td>
                            <td>{{ gs($pedido->total_importe_pedido - iva($pedido->total_importe_pedido, 10)) }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right">IVA:</td>
                            <td>{{ gs(iva($pedido->total_importe_pedido, 10)) }}</td>
                        </tr>
                        --}}
                        <tr>
                            <td colspan="3" class="text-right">Total:</td>
                            <td><b>GS {{ number_format($pedido->total_importe_pedido, '0','0','.') }}</b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @endif
        </div>
        {{--
        <div class="panel-footer text-right">
            <button class="btn btn-primary">Imprimir</button>
            <button class="btn btn-primary">Descargar</button>
        </div>
        --}}
    </div>
</div>
@endsection
