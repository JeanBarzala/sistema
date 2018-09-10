<form id="pedido-form" method="post" action="{{ url('pedidos/checkout') }}">
  {{ csrf_field() }}
  <input type="hidden" name="id_pedido" id="id_pedido">
  <input type="hidden" name="id_usuario" value="{{ Auth::user()->id }}">
  <input type="hidden" name="id_cliente" value="" id="id_cliente">
  <input type="hidden" name="id_motivo" value="" id="id_motivo">
  <input type="hidden" name="persona_pedido" value="" id="persona_realiza_pedido">
  <input type="hidden" name="tarjeta_id_pedido" value="" id="tarjeta_id_pedido">
  <input type="hidden" name="tarjeta_texto_pedido" value="" id="tarjeta_texto_pedido">
  <input type="hidden" name="id_destinatario" value="" id="id_destinatario">
  <input type="hidden" name="id_direccion_cobro" value="" id="id_direccion_cobro">
  <input type="hidden" name="pedido_fecha_hora_cobro" value="" id="pedido_fecha_hora_cobro">
  <input type="hidden" name="pedido_hora_hasta" value="" id="pedido_hora_hasta">
  <input type="hidden" name="pedido_fecha_hora_entrega" id="pedido_fecha_hora_entrega">
  <input type="hidden" name="pedido_telefono_entrega" id="pedido_telefono_entrega">
  <input type="hidden" name="id_direccion_envio" id="id_direccion_envio">
  <input type="hidden" name="pedido_observacion" id="pedido_observacion" value="">
  <input type="hidden" name="telefono_envio_pedido" id="telefono_envio_pedido" value="">
  <input type="hidden" name="tipo_descuento" id="tipo_descuento_pedido" value="">
  <input type="hidden" name="descuento_pedido" id="descuento_pedido" value="">
  <input type="hidden" name="motivo_descuento" id="motivo_descuento_pedido" value="">
  <input type="hidden" name="imprimir_remision" id="imprimir_remision" value="">
  <input type="hidden" name="imprimir_factura" id="imprimir_factura" value="">
  <input type="hidden" name="documento_pedido" id="documento_pedido" value="">
  <input type="hidden" name="forma_pago_pedido" id="forma_pago_pedido" value="">
  {{--
  <input type="hidden" name="monto_cobro_pedido" id="monto_cobro_pedido" value="">
  --}}
  <div class="data">
  	
  </div>
</form>