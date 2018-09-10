<div role="tabpanel" class="tab-pane" id="envio">
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="row">
                <div class="col-lg-12">
                  <label>Destinatario:</label>
                  <div class="input-group">
                    <input type="text" name="cliente" id="input_destinatario" class="form-control" placeholder="CI, Ruc, Nombre o Apellido">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Registrar</button>
                    </span>
                  </div><!-- /input-group -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          Datos del destinatario
        </div>
        <form action="{{ route('clientes.update.ajax') }}" method="post" class="form-update-destinatario">

        <input type="hidden" name="id_cliente_update" class="id_destinatario_update" value="">
        <div class="panel-body">
          
          <div class="row">
            <div class="col-lg-12">
              <div class="datos-card">
                <div class="datos-card-item">
                  <div class="title">Nombre y Apellido:</div>
                  <input type="text" name="nombre" class="nombre_destinatario datos-card-field">
                </div>
                <div class="datos-card-item">
                  <div class="title">Apellido:</div>
                  <input type="text" name="apellido" class="apellido_destinatario datos-card-field">
                </div>
                <div class="datos-card-item">
                  <div class="title">Razón Social:</div>
                  <input type="text" name="razon_social" class="razon_social_destinatario datos-card-field">
                </div>
                <div class="datos-card-item">
                  <div class="title">Ruc:</div>
                  <input type="text" name="ruc" class="ruc_destinatario datos-card-field">
                </div>
                <div class="datos-card-item">
                  <div class="title">Personería:</div>
                  <select class="tipo_destinatario datos-card-field" name="tipo_persona">
                    @foreach(config('cms.tipo_persona') as $personeria)
                    <option value="{{ $personeria['id'] }}">{{ $personeria['name'] }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="datos-card-item">
                  <div class="title">Tipo de Documento:</div>
                  <select class="tipo_doc_destinatario datos-card-field" name="tipo_doc_persona">
                    @foreach(config('cms.tipo_doc_persona') as $doc)
                    <option value="{{ $doc['id'] }}">{{ $doc['name'] }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="datos-card-item">
                  <div class="title">Documento:</div>
                  <input type="text" name="num_doc_persona" class="documento_destinatario datos-card-field">
                </div>
                
                <div class="datos-card-item">
                  <div class="title">Cumpleaños:</div>
                  <input type="text" name="cumpleano_cliente" class="cumpleano_destinatario datos-card-field date" autocomplete="off">
                </div>
                <div class="datos-card-item">
                  <div class="title">Email:</div>
                  <input type="text" name="email_cliente" class="email_destinatario datos-card-field" autocomplete="off">
                </div>
                <div class="datos-card-item w_100">
                  <div class="title">Observaciones:</div>
                  <textarea name="obs_cliente" class="obs_destinatario datos-card-field"></textarea>
                </div>
              </div>
            </div>
          </div>                 
        </div>
        
        <div class="panel-footer text-right">
          <button class="btn btn-primary">Guardar</button>
        </div>
        </form>
      </div>
      <div class="panel panel-default with-gear">
        <div class="panel-heading ">
          Datos de envío
          <div class="gear">
            <div class="gear-content">
              <!-- Single button -->
              <div class="sub-menu dropdown">
                  <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                    <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                  </a>
                  <ul class="dropdown-menu" role="menu" style="right: 0; left: initial;">
                      <li><a href="#" class="registrar-telefono" data-toggle="modal" data-target="#modal-telefono-registrar" data-title="" data-route="" data-idfind="id_destinatario_update">Registrar teléfono</a></li>
                      <li><a href="#" data-toggle="modal" data-target="#modal-registrar-cliente" data-title="" data-route="">Registrar direccion</a></li>
                  </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label>Fecha/Hora de entrega</label>
                <input type="text" name="fecha_hora_entrega" class="form-control" id="fecha_hora_entrega">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>Teléfono entrega</label>
                <select class="form-control" id="telefono_entrega" disabled>
                </select>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="form-group">
                <label>Dirección de envío</label>
                <select class="form-control" id="direccion_envio" disabled>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="panel-footer text-right">
          <a href="#" class="btn btn-primary" title="Recargar datos"><i class="fa fa-refresh" aria-hidden="true"></i></a>
        </div>
      </div>
    </div>
  </div>
</div>