/*  $(function () {
     $('#modal-default').modal('toggle');
  });*/

  function setDocumento(){
    if (localStorage.getItem("documento")) {
      var documento = JSON.parse(localStorage.getItem("documento"));
      $('#documento_pedido').val(documento);
      $('#documento').val(documento);
    }else{
      var documento = $('#documento').val();
      localStorage.setItem('documento', JSON.stringify(documento));
      $('#documento_pedido').val(documento);
    }
  }
  function setFormaPago(){
    if (localStorage.getItem("forma_pago")) {
      var forma_pago = JSON.parse(localStorage.getItem("forma_pago"));
      $('#forma-pago').val(forma_pago);
      $('#forma_pago_pedido').val(forma_pago);
    }else{
      var forma_pago = $('#forma-pago').val();
      localStorage.setItem('forma_pago', JSON.stringify(forma_pago));
      $('#forma_pago').val(forma_pago);
    }
  }
  
  
  function setTarjeta(){
    if (localStorage.getItem("tarjeta")) {
      var tarjeta = JSON.parse(localStorage.getItem("tarjeta"));
      var id_tarjeta = tarjeta.id_producto;
      
      console.log(id_tarjeta);
      $('#select-tarjeta').val(id_tarjeta);
      $('#tarjeta_id_pedido').val(id_tarjeta);
      
    }
    if (localStorage.getItem("tarjeta_texto")) {
      var tarjeta_text = JSON.parse(localStorage.getItem("tarjeta_texto"));
      $('#tarjeta-text').val(tarjeta_text);
      $('#tarjeta_texto_pedido').val(tarjeta_text);
    }
  }

  function setPersonRealizaPedido(){
    if (localStorage.getItem("persona_realiza_pedido")) {
      var persona_realiza_pedido = JSON.parse(localStorage.getItem("persona_realiza_pedido"));
           
      $('#persona-realiza-pedido').val(persona_realiza_pedido);
      $('#persona_realiza_pedido').val(persona_realiza_pedido);
      
    }
    if (localStorage.getItem("tarjeta_texto")) {
      var tarjeta_text = JSON.parse(localStorage.getItem("tarjeta_texto"));
      $('#tarjeta-text').val(tarjeta_text);
      $('#tarjeta_texto_pedido').val(tarjeta_text);
    }
  }

  function setMotivo(){
    if (localStorage.getItem("motivo")) {
      var motivo = JSON.parse(localStorage.getItem("motivo"));

      $('#motivo option').removeAttr('selected');
      $('#motivo').val(motivo);
      $('#id_motivo').val(motivo)
      $('.motivo-select').val(motivo);
      $('.motivo-select option').each(function() {
          if ($(this).val() == motivo) {
            $(this).attr('selected', 'selected');
            
          }
      });
    }
  }

  function setObservacion(){
    if (localStorage.getItem("observacion")) {
      var observacion = JSON.parse(localStorage.getItem("observacion"));
      $('#observacion').val(observacion);
      $('#pedido_observacion').val(observacion);
      
    }
  }

  function setRemision(){
    if (localStorage.getItem("remision")) {
      var remision = JSON.parse(localStorage.getItem("remision"));
      $('#imprimir_remision').val(remision);
      $('#remision').attr('checked', 'checked');
    }
  }

  function setFactura(){
    if (localStorage.getItem("factura")) {
      var factura = JSON.parse(localStorage.getItem("factura"));
      $('#imprimir_factura').val(factura);
      $('#factura').attr('checked', 'checked');
    }
  }

  function setDataClient(){
    if (localStorage.getItem("cliente")) {
      cliente = JSON.parse(localStorage.getItem("cliente"));
      $("#pedido-form #id_cliente").val(cliente.id_cliente);
      $('.id_cliente_update').val(cliente.id_persona);
      $('.nombre_cliente').val(cliente.nombre_persona);
      $('.apellido_cliente').val(cliente.apellido_persona);
      $('.razon_social_cliente').val(cliente.razon_social_persona);
      $('.documento_cliente').val(cliente.num_doc_persona);
      $('.ruc_cliente').val(cliente.ruc_persona);
      $('.cumpleano_cliente').val(cliente.fecha_ncto_persona);
      $('.email_cliente').val(cliente.email_persona);
      $('.obs_cliente').val(cliente.observacion_persona);
      $('.tipo_persona option').removeAttr('selected');
      $('.tipo_persona').val(cliente.tipo_persona);
      $('.tipo_persona option').each(function() {
          if ($(this).val() == cliente.tipo_persona) {
            $(this).attr('selected', 'selected');
            console.log(cliente.tipo_persona);
          }
      });

      $('.tipo_doc_persona option').removeAttr('selected');
      var tipo_doc_persona = cliente.tipo_doc_persona;
      $('.tipo_doc_persona').val(tipo_doc_persona);
      $('.tipo_doc_persona option').each(function() {
          if ($(this).val() === tipo_doc_persona) {
            $(this).attr('selected', 'selected'); 
          }
      });
      $.post($('meta[name="pedidos.ClienteDirecciones"]').attr('content'), { id: cliente.id_persona }, function(response) {
        $('#direccion_cobro').removeAttr('disabled').html(response);
      });
      $.post($('meta[name="pedidos.DestinatarioTelefonos"]').attr('content'), { id: cliente.id_persona }, function(response) {
        $('#telefono_pedido').removeAttr('disabled').html(response).select2({tags: true});
      });

    }
  }

  function setDataEnvio(){
    if (localStorage.getItem("envio")) {
      envio = JSON.parse(localStorage.getItem("envio"));
      $("#pedido-form #id_destinatario").val(envio.id_cliente);
      $('.id_destinatario_update').val(envio.id_persona);
      $('.nombre_destinatario').val(envio.nombre_persona);
      $('.apellido_destinatario').val(envio.apellido_persona);
      $('.razon_social_destinatario').val(envio.razon_social_persona);
      $('.documento_destinatario').val(envio.num_doc_persona);
      $('.ruc_destinatario').val(envio.ruc_persona);
      $('.cumpleano_destinatario').val(envio.fecha_ncto_persona);
      $('.email_destinatario').val(envio.email_persona);
      $('.obs_destinatario').val(envio.observacion_persona);
      $('.tipo_destinatario option').removeAttr('selected');
      if (envio.tipo_persona) {
      $('.tipo_destinatario').val(envio.tipo_persona);
      $('.tipo_destinatario option').each(function() {
          if ($(this).val() == envio.tipo_persona) {
            $(this).attr('selected', 'selected');
            console.log(envio.tipo_destinatario);
          }
      });
      }

      $('.tipo_doc_destinatario option').removeAttr('selected');
      var tipo_doc_destinatario = cliente.tipo_doc_destinatario;
      $('.tipo_doc_destinatario').val(tipo_doc_destinatario);
      $('.tipo_doc_destinatario option').each(function() {
          if ($(this).val() === envio.tipo_doc_persona) {
            $(this).attr('selected', 'selected'); 
          }
      });

      $.post($('meta[name="pedidos.DestinatarioDirecciones"]').attr('content'), { id: envio.id_persona }, function(response) {
        $('#direccion_envio').removeAttr('disabled').html(response);
      });
      $.post($('meta[name="pedidos.DestinatarioTelefonos"]').attr('content'), { id: envio.id_persona }, function(response) {
        $('#telefono_entrega').removeAttr('disabled').html(response);
      });
    }
  }

  setDataClient();
  setDataEnvio();
  setTarjeta();
  setMotivo();
  setObservacion();
  setPersonRealizaPedido();
  setRemision();
  setDocumento();
  setFormaPago();
  setFactura();

  function updateCliente(id_cliente){
    $.post($('meta[name="pedidos.findCliente"]').attr('content'), { id: id_cliente }, function(response) {
      console.log(response);
      localStorage.setItem('cliente', JSON.stringify(response[0]));
      setDataClient();
      console.log('Se actualizo el formulario cliente despues de actualizar un registro');
    });
  }

  function updateDestinatario(id_cliente){
    $.post($('meta[name="pedidos.findCliente"]').attr('content'), { id: id_cliente }, function(response) {
      console.log(response);
      localStorage.setItem('envio', JSON.stringify(response[0]));
      setDataEnvio();
      console.log('Se actualizo el formulario destinatario despues de actualizar un registro');
    });
  }

  
  

  (function($) {

      $.fn.invisible = function() {
          return this.each(function() {
              $(this).css("visibility", "hidden");
          });
      };
      $.fn.visible = function() {
          return this.each(function() {
              $(this).css("visibility", "visible");
          });
      };
  }(jQuery));

  cliente_json = JSON.parse(localStorage.getItem("cliente"));
  destinatario_json = JSON.parse(localStorage.getItem("envio"));
  
  //console.log(cliente_json.id_cliente);
  if (localStorage.getItem("cliente")) {
    cliente = JSON.parse(localStorage.getItem("cliente"));
    console.log('El cliente seleccionado es '+cliente.nombre_persona);
  }else {
    console.log('No hay registro en localStorage para el cliente.')
  }

  if (localStorage.getItem("envio")) {
    envio = JSON.parse(localStorage.getItem("envio"));
    console.log('El destinatario seleccionado es '+envio.nombre_persona);
  }else {
    console.log('No hay registro en localStorage para el destinatario.')
  }
  /*
  if (cliente_json === null) {
    alert('vacio');
  }*/

  $('#remision').on('change', function(){
    if ($(this).is(':checked')) {
      var remision = 'si';
    }else {
      remision = 'no';
    }
    localStorage.setItem('remision', JSON.stringify(remision));
    $('#imprimir_remision').val(remision);
    if (remision == 'si') {
      report('Se imprimirá remisión');
    }
  })

  $('#factura').on('change', function(){
    if ($(this).is(':checked')) {
      var factura = 'si';
    }else {
      factura = 'no';
    }
    localStorage.setItem('factura', JSON.stringify(factura));
    $('#imprimir_factura').val(factura);
    if (factura == 'si') {
      report('Se imprimirá factura');
    }
  })

  $('#documento').on('change', function(){
    var documento = $(this).val();
    $('#documento_pedido').val(documento);
    localStorage.setItem('documento', JSON.stringify(documento));
    report('El documento seleccionado es: '+documento);
  })

  $('#forma-pago').on('change', function(){
    var forma_pago = $(this).val();
    $('#forma_pago_pedido').val(forma_pago);
    localStorage.setItem('forma_pago', JSON.stringify(forma_pago));
    report('La forma de pago es: '+forma_pago);
  })

  $('.caja-apertura').on('submit', function(){
    //$('#modal-default').modal('toggle');
    var action = $(this).attr('action');
    $.ajax({
      type: 'POST',
      url: action,
      data: $(this).serialize(),
      beforeSend: function(){
      $('.fix-loader').visible();
      //imagen de carga
      $(".fix-loader").html("<div id='preloader'><div class='loader'>&nbsp;</div></div>");
      },
      ajaxSend: function(){
      $('.fix-loader').visible();
      //imagen de carga
      $(".fix-loader").html("<div id='preloader'><div class='loader'>&nbsp;</div></div>");
      },
      success: function(response) {
        $('.fix-loader').invisible();
        console.log(response.message);
        if (response) {
          //location.reload();
          //localStorage.clear();
          report(response.message);
        }
        if (response.status == 'ok') {
          $('#modal-default').modal('toggle');
        }
      }
    });
    return false;
  })
  




  $(document).on("click", '.checkout', function () {

    if ($(this).val() == 'cobrar') {
      
      $('#modal-cobrar').modal('toggle');
    

      //report(forma_pago);
      return false;
    }
    
    var action = $(this).val();
    $.ajax({
      type: 'POST',
      url: $("#pedido-form").attr("action"),
      data: $("#pedido-form").serialize() + "&moredata=" + action,
      beforeSend: function(){
      $('.fix-loader').visible();
      //imagen de carga
      $(".fix-loader").html("<div id='preloader'><div class='loader'>&nbsp;</div></div>");
      },
      ajaxSend: function(){
      $('.fix-loader').visible();
      //imagen de carga
      $(".fix-loader").html("<div id='preloader'><div class='loader'>&nbsp;</div></div>");
      },
      success: function(response) {
        $('.fix-loader').invisible();
        console.log(response.message);
        if (response.confirm == 'ok') {
          //location.reload();
          //localStorage.clear();
          $('#id_pedido').val(response.id_pedido);
        }
        /*$('.reports').show();
        $('.reports p').text(response.message);*/
        report(response.message);

      },
      error: function(){
        $('.fix-loader').invisible();
        report('Ocurrió un error al procesar el pedido.');
      }
    });

  });

  $('.info-producto').click(function(){
    $.post(url, { id: id }, function(response) {
      if (response == '') {
        return false;
      }else {
        alert('Hay disponible ' +response.stock);
      }
    });
  })


  $("#input_cliente").autocomplete({
      source: $('meta[name="pedidos.buscarCliente"]').attr('content'),
      minLength: 1,
      select: function(event, ui) {
          event.preventDefault();
          console.log(ui.item.fecha_ncto_persona);
          localStorage.setItem('cliente', JSON.stringify(ui.item));
          $("#pedido-form #id_cliente").val(ui.item.id_cliente);
          $('.nombre_cliente').val(ui.item.nombre_persona);
          $('.apellido_cliente').val(ui.item.apellido_persona);
          $('.razon_social_cliente').val(ui.item.razon_social_persona);
          $('.documento_cliente').val(ui.item.num_doc_persona);
          $('.ruc_cliente').val(ui.item.ruc_persona);
          $('.cumpleano_cliente').val(ui.item.fecha_ncto_persona);
          $('.email_cliente').val(ui.item.email_persona);
          $('.obs_cliente').val(ui.item.observacion_persona);
          $('.id_cliente_update').val(ui.item.id_persona);
          
          $.post($('meta[name="pedidos.ClienteDirecciones"]').attr('content'), { id: ui.item.id_persona }, function(response) {
            $('#direccion_cobro').removeAttr('disabled').html(response);
          });
          $.post($('meta[name="pedidos.DestinatarioTelefonos"]').attr('content'), { id: ui.item.id_persona }, function(response) {
            $('#telefono_pedido').removeAttr('disabled').html(response).html(response).select2({tags: true});
          });
       }
  });
  $("#input_destinatario").autocomplete({
      source: $('meta[name="pedidos.buscarDestinatario"]').attr('content'),
      minLength: 1,
      select: function(event, ui) {
          event.preventDefault();
          localStorage.setItem('envio', JSON.stringify(ui.item));
          console.log(ui.item.fecha_ncto_persona);
          $("#pedido-form #id_destinatario").val(ui.item.id_persona);
          $('.nombre_destinatario').val(ui.item.nombre_persona);
          $('.apellido_destinatario').val(ui.item.apellido_persona);
          $('.razon_social_destinatario').val(ui.item.razon_social_persona);
          $('.documento_destinatario').val(ui.item.num_doc_persona);
          $('.ruc_destinatario').val(ui.item.ruc_persona);
          $('.cumpleano_destinatario').val(ui.item.fecha_ncto_persona);
          $('.email_destinatario').val(ui.item.email_persona);
          $('.obs_destinatario').val(ui.item.observacion_persona);
          $('.id_destinatario_update').val(ui.item.id_persona);
          
          $.post($('meta[name="pedidos.DestinatarioDirecciones"]').attr('content'), { id: ui.item.id_persona }, function(response) {
            $('#direccion_envio').removeAttr('disabled').html(response);
          });
          $.post($('meta[name="pedidos.DestinatarioTelefonos"]').attr('content'), { id: ui.item.id_persona }, function(response) {
            $('#telefono_entrega').removeAttr('disabled').html(response);
          });
          $('#input_destinatario').val('');
       }
  });

  $('#motivo').on('change', function() {
    var val = $(this).val();
    //console.log(val);
    $('#id_motivo').val(val);

    localStorage.setItem('motivo', JSON.stringify(val));
    report('El motivo ha sido cambiado correctamente.')
  });

  $( "#persona-realiza-pedido" ).on('input', function() {
    var persona_realiza_pedido = $(this).val();
    $('#persona_realiza_pedido').val(persona_realiza_pedido);
    localStorage.setItem('persona_realiza_pedido', JSON.stringify(persona_realiza_pedido));
  });

  $( "#direccion_envio" ).on('change', function() {
    //console.log($(this).val());
    $('#id_direccion_envio').val($(this).val());
  });
  $( "#telefono_pedido" ).on('change', function() {
    //console.log($(this).val());
    $('#telefono_envio_pedido').val($(this).val());
  });

  $('input[name=monto]').on('change', function() {
    var val = $(this).val();
    console.log(val);
    //$('#id_motivo').val(val);
  });

  $('input[name=tipo_descuento]').on('change', function(){
    if ($(this).val() == 'monto') {
      $('input[name=monto_descuento]').removeAttr('disabled', 'disabled');
      $('input[name=porcentaje]').attr('disabled', 'disabled');
    }else {
      $('input[name=monto_descuento]').attr('disabled', 'disabled');
      $('input[name=porcentaje]').removeAttr('disabled', 'disabled');
    }
  })
 $('input[name=monto_descuento]').on('change', function(){
     var val = Number($(this).val());
     var descuento = val * 100 / shoppingCart.totalCart();
     $('input[name=porcentaje]').val(descuento);
     //$('#descuento-cart').text('- '+val);
     //alert(shoppingCart.totalCart() - val);
  })
  $('input[name=porcentaje]').on('change', function(){
     var val = Number($(this).val());
     var descuento = val * shoppingCart.totalCart() / 100;
     $('input[name=monto_descuento]').val(descuento);
     //$('#descuento-cart').text('- '+val+'%');
     //alert(shoppingCart.totalCart() - val);
  })

  function setDescuento(){
    var descuento = null;
    if ( $('input[name=tipo_descuento]:checked').val() == 'monto') {
      var val = Number( $('input[name=monto_descuento]').val());
      descuento = val * 100 / shoppingCart.totalCart();
      $('input[name=porcentaje]').val(descuento);
      //$('#descuento-cart').text('- '+val);
      
    }else {
      var val = Number( $('input[name=porcentaje]').val());
      descuento = val * shoppingCart.totalCart() / 100;
      $('input[name=monto_descuento]').val(descuento);
      
    }
    var tipo_descuento_pedido = $('input[name=tipo_descuento]:checked').val();
    var descuento_pedido = val;
    var motivo_descuento_pedido = $('textarea[name=motivo_descuento]').val();
    $('#tipo_descuento_pedido').val(tipo_descuento_pedido);
    $('#descuento_pedido').val(val);
    $('#motivo_descuento_pedido').val(motivo_descuento_pedido);
    
    return val;
  }
  $('#submit_descuento').on('click', function(){
    console.log(setDescuento());
    report('Se ha aplicado el descuento de '+setDescuento());
    $('#descuento-cart').text('- '+setDescuento());
    $('#modal-descuento').modal('toggle');
    localStorage.setItem('descuento', JSON.stringify(setDescuento()));
    localStorage.setItem('motivo_descuento', JSON.stringify($('input[name=motivo_descuento]').val()));
  })
  //console.log(setDescuento());


  


  $('#direccion_cobro').on('change', function() {
    var val = $(this).val();
    $('#id_direccion_cobro').val(val);
  });


  /* Configuracion de la tarjeta */
  $('#select-tarjeta').on('change', function() {
    var val = $(this).val();
    $('#tarjeta_id_pedido').val(val);
    $.post($('meta[name="pedidos.buscarTargeta"]').attr('content'), { id: $(this).val() }, function(response) {
      var text = response.descripcion_producto;
      $('#tarjeta-text').val(text);
      $('#tarjeta_texto_pedido').val(text);
      var tarjeta = response;
      localStorage.setItem('tarjeta', JSON.stringify(tarjeta));
      localStorage.setItem('tarjeta_texto', JSON.stringify(tarjeta.descripcion_producto));
      report('Tarjeta seleccionada.');
    });
    $('#tarjeta-text').val(val);
  });
  $( "#tarjeta-text" ).on('input', function() {
    var text = $(this).val();
    $('#tarjeta_texto_pedido').val(text);
    localStorage.setItem('tarjeta_texto', JSON.stringify(text));
  });
  $('#borrar-tarjeta').click(function(e){
    e.preventDefault();
    $('#select-tarjeta').val('');
    $('#tarjeta-text').val('');
    $('#tarjeta_texto_pedido').val('');
    $('#tarjeta_id_pedido').val('');
    localStorage.removeItem('tarjeta');
    localStorage.removeItem('tarjeta_texto');
    report('Tarjeta eliminada.');
  })


  $('#fecha_hora_cobro').datetimepicker({
    format: 'YYYY-MM-DD h-m-s',
    viewMode: 'days',
    locale: 'es'
  });
  $('#hora_hasta').datetimepicker({
      format: 'LT'
  });
  $('#fecha_hora_entrega').datetimepicker({
    format: 'YYYY-MM-DD h-m-s',
  });

  $( "#fecha_hora_cobro" ).on('dp.change', function(e) {
    //console.log($(this).val());
    console.log(e.date);
    $('#pedido_fecha_hora_cobro').val($(this).val());
  });

  $( "#hora_hasta" ).on('dp.change', function(e) {
    //console.log($(this).val());
    console.log(e.date);
    $('#pedido_hora_hasta').val($(this).val());
  });

  $( "#fecha_hora_entrega" ).on('dp.change', function(e) {
    //console.log($(this).val());
    console.log(e.date);
    $('#pedido_fecha_hora_entrega').val($(this).val());
  });

  $('#telefono_entrega').on('change', function() {
    var val = $(this).val();
    $('#pedido_telefono_entrega').val(val);
  });

  $('#observacion').on('input', function() {
    var val = $(this).val();
    $('#pedido_observacion').val(val);
    localStorage.setItem('observacion', JSON.stringify(val));
  });

  $(document).on("click", ".add-to-cart", function(event){
      event.preventDefault();
      var url = $(this).data('url');
      var id = $(this).data('id');
      /*$.post(url, { id: id }, function(response) {
        if (response == '') {
          return false;
        }else {
          alert('Hay disponible ' +response.stock);
        }
      });*/
      var id = $(this).attr("data-id");
      var name = $(this).attr("data-name");
      var price = Number($(this).attr("data-price"));
      //var comentario = $(this).attr("data-comentario");
      var comentario = '';
      shoppingCart.addItemToCart(id, name, price, 1, comentario);
      displayCart();
      //$('.reports').show();
      var add = name+' agregado al detalle';
      report(add);
  });

  $("#clear-cart").click(function(event){
      shoppingCart.clearCart();
      displayCart();
  });

  function displayCart() {
      var cartArray = shoppingCart.listCart();
      console.log(cartArray);
      var output = "";
      var pedidoForm = "";

      for (var i in cartArray) {
          output += "<tr>"
              +"<td>"+cartArray[i].name+"</td>"
              +" <td><input class='item-count' type='number' data-id='"
              +cartArray[i].id
              +"' value='"+cartArray[i].count+"' ></td>"
              
              +" <td><input class='item-price' type='text' data-id='"
              +cartArray[i].id
              +"' value='"+cartArray[i].price                    +"' ></td>"
              +" <td><input class='item-comentario' type='text' data-id='"
              +cartArray[i].id
              +"' value='"+cartArray[i].comentario+"' ></td>"
              +" <td style='display:table-cell; min-width:110px;'><button class='plus-item btn btn-primary btn-sm' data-id='"
              +cartArray[i].id+"'>+</button>"
              +" <button class='subtract-item btn btn-primary btn-sm' data-id='"
              +cartArray[i].id+"'>-</button>"
              +" <button class='delete-item btn btn-default btn-sm'  data-id='"
              +cartArray[i].id+"'><i class='fa fa-trash' aria-hidden='true'></i></button></td>"
              +"</tr>";

              pedidoForm += "<input "
              +"type='hidden' name='id_producto[]' value='"+cartArray[i].id+"'>"
              +"<input type='hidden' name='nombre[]' value='"+cartArray[i].name+"'>"
              +"<input type='hidden' name='price[]' value='"+cartArray[i].price+"'>"
              +"<input type='hidden' name='comentario[]' value='"+cartArray[i].comentario+"'>"
              +"<input type='hidden' name='cantidad[]' value='"+cartArray[i].count+"'>";

      };
      //console.log(pedidoForm);
      


      //console.log(cartArray[i].id + cartArray[i].price);

      $("#show-cart").html(output);
      $("#count-cart").html(shoppingCart.countCart());
      $("#total-cart").html(shoppingCart.totalCart());
      $('#pedido-form .data').html(pedidoForm);
      $('#total-cart').number( true, 0, '.', '.');
      
  }

  $("#show-cart").on("click", ".delete-item", function(event){
      var id = $(this).attr("data-id");
      shoppingCart.removeItemFromCartAll(id);
      displayCart();
  });

  $("#show-cart").on("click", ".subtract-item", function(event){
      var id = $(this).attr("data-id");
      shoppingCart.removeItemFromCart(id);
      displayCart();
  });

  $("#show-cart").on("click", ".plus-item", function(event){
      var id = $(this).attr("data-id");
      shoppingCart.addItemToCart(id, 0, 0, 1);
      displayCart();
  });

  $("#show-cart").on("change", ".item-count", function(event){
      var id = $(this).attr("data-id");
      var count = Number($(this).val());
      shoppingCart.setCountForItem(id, count);
      displayCart();
  });
  $("#show-cart").on("change", ".item-comentario", function(event){
      var id = $(this).attr("data-id");
      var comentario = $(this).val();
      shoppingCart.setComentario(id, comentario);
      displayCart();
      var mensaje = 'Comentario agregado: '+comentario;
      report(mensaje);
  });

  $("#show-cart").on("change", ".item-price", function(event){
      var id = $(this).attr("data-id");
      var price = $(this).val();
      shoppingCart.setPrice(id, price);
      displayCart();
  });


  displayCart();
  console.log(shoppingCart.listCart());


  $(document).ready(function(){

  //setup before functions
  var typingTimer;                //timer identifier
  var doneTypingInterval = 600;  //time in ms, 5 second for example

  var consulta;
  //hacemos focus al campo de búsqueda
  //$(".buscador").focus();



function buscar(categoria)
{
  //comprobamos si se pulsa una tecla

                                
  //obtenemos el texto introducido en el campo de búsqueda
  if (categoria) {
    categoria = categoria;
  }else {
    categoria = $('.search-form .categoria').val();
  }
  q = $(".search-form .q").val();
  action = $('.search-form').attr('action');
  console.log(consulta);
  console.log(action);

  
    
  //hace la búsqueda                                                                                  
  $.ajax({
    url: action,
    type: 'get',
    data: {q:q, categoria:categoria},
    dataType: "html",
    beforeSend: function(){
    //imagen de carga
    $(".result-content > .row").html("<div id='preloader'><div class='loader'>&nbsp;</div></div>");
    },
    ajaxSend: function(){
    //imagen de carga
    $(".result-content > .row").html("<div id='preloader'><div class='loader'>&nbsp;</div></div>");
    },
    error: function(){
    var error = "<h1 class='text-center'><i class='fa fa-exclamation-circle' aria-hidden='true'></i></h1><p class='text-center'>Ha ocurrido un error en la búsqueda.<br>Por favor, intenta nuevamente o comunicate con el servicio técnico.</p><p class='text-center'><a href='#' class='return-back _n26'><i class='fa fa-arrow-left' aria-hidden='true'></i> Volver</a></p>"
    $(".result-content > .row").html(error);
    },
    success: function(data){                                                    
    $(".result-content > .row").empty();
    $(".result-content > .row").append(data);
    run();                                                         
    }
  });                                                                         
  
}

//buscar();

$('.search-form .q').on('keyup', function() {
    if (this.value.length > 0) {
      $('.result-organic').hide();
      $('.result-content').show();
      $(".result-content > .row").empty();
      clearTimeout(typingTimer);
      if ($('#in').val) {
          typingTimer = setTimeout(function(){
              //do stuff here e.g ajax call etc....
               buscar();
          }, doneTypingInterval);
      }
    } else {
      $('.result-organic').show();
      $('.result-content').hide();
    }
});
$('.search-form .categoria').on('change', function() {
    if (this.value.length > 0) {
      $('.result-organic').hide();
      $('.result-content').show();
      $(".result-content > .row").empty();
      clearTimeout(typingTimer);
      if ($('#in').val) {
          typingTimer = setTimeout(function(){
              //do stuff here e.g ajax call etc....
               buscar();
          }, doneTypingInterval);
      }
    } else {
      $('.result-organic').show();
      $('.result-content').hide();
    }
});
$(document).on('click', '.item-categoria', function(){
  var categoria = $(this).data('categoria');
  $('.categoria option').each(function() {
    
    if ($(this).val() == categoria) {
      $(this).removeAttr("selected");
      $(this).attr('selected', 'selected'); 
    }
  });
  buscar(categoria);
  $('.result-organic').hide();
  $('.result-content').show();
})
$(document).on('click', '.return-back', function(){
  $('.categoria option').removeAttr("selected");
  $('.result-organic').show();
  $('.result-content').hide();
  $(".result-content > .row").empty();
})
window.addEventListener("keypress", function(event){
    if (event.keyCode == 13){
      alert(event.keyCode)
      event.preventDefault();
    }
}, false);

$('.reset-q').click(function(e){
  e.preventDefault();
  $('.q').val('');
})


$(document).on("click", '.form-update-cliente button', function () {
    var action = $(this).val();
    $.ajax({
      type: 'POST',
      url: $(".form-update-cliente").attr("action"),
      data: $(".form-update-cliente").serialize(),
      beforeSend: function(){
      $('.fix-loader').visible();
      //imagen de carga
      $(".fix-loader").html("<div id='preloader'><div class='loader'>&nbsp;</div></div>");
      },
      ajaxSend: function(){
      $('.fix-loader').visible();
      //imagen de carga
      $(".fix-loader").html("<div id='preloader'><div class='loader'>&nbsp;</div></div>");
      },
      success: function(response) {
        $('.fix-loader').invisible();
        
        console.log(response.message);
        if (response.confirm == 'ok') {
          if (response.id_cliente) {
            $('.id_cliente_update').val(response.id_cliente);
            $.post($('meta[name="pedidos.ClienteDirecciones"]').attr('content'), { id: response.id_cliente }, function(response) {
              $('#direccion_cobro').removeAttr('disabled').html(response);
            });
            $.post($('meta[name="pedidos.DestinatarioTelefonos"]').attr('content'), { id: response.id_cliente }, function(response) {
              $('#telefono_pedido').removeAttr('disabled').html(response);
            });
          }
          var id_cliente = $('.id_cliente_update').val();
          updateCliente(id_cliente);
          report(response.message);

        }

      }
    });
    return false;
  });

$(document).on("click", '.form-update-destinatario button', function () {
    var action = $(this).val();
    $.ajax({
      type: 'POST',
      url: $(".form-update-destinatario").attr("action"),
      data: $(".form-update-destinatario").serialize(),
      beforeSend: function(){
      $('.fix-loader').visible();
      //imagen de carga
      $(".fix-loader").html("<div id='preloader'><div class='loader'>&nbsp;</div></div>");
      },
      ajaxSend: function(){
      $('.fix-loader').visible();
      //imagen de carga
      $(".fix-loader").html("<div id='preloader'><div class='loader'>&nbsp;</div></div>");
      },
      success: function(response) {
        $('.fix-loader').invisible();
        
        console.log(response.message);
        if (response.confirm == 'ok') {
          if (response.id_cliente) {
            $('.id_cliente_update').val(response.id_cliente); 
          }
          var id_cliente = $('.id_destinatario_update').val(); 
          updateDestinatario(id_cliente);
          report(response.message);

        }

      }
    });
    return false;
  });

  
  $('.registrar-telefono').on('click', function(){
    idfind = $(this).data('idfind');
    id = $('.'+idfind).val();
    alert(id);
    $('#modal-telefono-registrar').on('shown.bs.modal', function () {
      $('input[name=id_persona]', this).val(id);
    })
  })

  $('.monto_cobro').on('change', function(){
    var suma = 0;
    $('.monto_cobro').each(function(){
      suma += Number($(this).val());
    })
    $('.total_cobrar').val(suma);
    if (suma > shoppingCart.totalCart()) {
      $('.vuelto_cobrar').val(suma - shoppingCart.totalCart());
    }else{
      $('.vuelto_cobrar').val('');
    }
    
  })

  
  

})