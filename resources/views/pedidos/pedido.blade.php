
    	@if($pedidos)
        @foreach ($pedidos as $pedido)
          <tr>
            <td>{{ $pedido->id_pedido }}</td>
            <td>@if($pedido->cliente->persona->nombre_persona == 'N\N') {{ $pedido->cliente->persona->nombre_persona  }} @else {{ titleCase($pedido->cliente->persona->nombre_persona) . titleCase($pedido->cliente->persona->apellido_persona) }} @endif</td>
            <td>{{ $pedido->fecha_hora_pedido ? $pedido->fecha_hora_pedido : '-' }}</td>
            <td>{{ $pedido->fecha_hora_entrega_pedido ? $pedido->fecha_hora_entrega_pedido : '-' }}</td>
            <td>GS {{ number_format($pedido->total_importe_pedido, '0','0','.') }}</td>
            <td>
              @if ($pedido->estado_pedido == 'A PAGAR')
              <span class="label label-danger">{{ $pedido->estado_pedido }}</span>
              @else
              <span class="label label-success">{{ $pedido->estado_pedido }}</span>
              @endif
            </td>
            <td>{{ $pedido->estado_toma_pedido }}</td>
            <td class="text-right">
              <a href="{{ route('ventas.pedidos.detalle', ['id' => $pedido->id_pedido])  }}" class="btn btn-primary btn-sm">Ver detalle</a>
              <a href="#" class="btn btn-default btn-sm">Anular</a>
            </td>
          </tr>
        @endforeach
        @endif
