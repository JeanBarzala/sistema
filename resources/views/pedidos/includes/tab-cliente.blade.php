        <div role="tabpanel" class="tab-pane" id="cliente">
          <div class="row">
            <div class="col-lg-12">
              <div class="panel panel-default">
                <div class="panel-body">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="row">
                        <div class="col-lg-8">
                          
                            <label>Cliente:</label>
                            <div class="input-group">
                              
                              <input type="text" name="cliente" id="input_cliente" class="form-control" placeholder="CI, Ruc, Nombre o Apellido">
                              
                              <span class="input-group-btn">
                                <button class="btn btn-default" type="button">Registrar</button>
                              </span>
                              
                            </div><!-- /input-group -->
                          
                        </div>
                        <div class="col-lg-4">
                          <label>Persona Realiza Pedido:</label>
                          <input type="text" class="form-control" id="persona-realiza-pedido">
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
              <!-- add class .with-gear -->
              <div class="panel panel-default">
                <div class="panel-heading">
                  Datos del cliente
                  
                </div>
                <form action="{{ route('clientes.update.ajax') }}" method="post" class="form-update-cliente">

                <input type="hidden" name="id_cliente_update" class="id_cliente_update" value="">
                <div class="panel-body">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="datos-card">
                        <div class="datos-card-item">
                          <div class="title">Nombre:</div>
                          <input type="text" name="nombre" class="nombre_cliente datos-card-field">
                        </div>
                        <div class="datos-card-item">
                          <div class="title">Apellido:</div>
                          <input type="text" name="apellido" class="apellido_cliente datos-card-field">
                        </div>
                        <div class="datos-card-item">
                          <div class="title">Razón Social:</div>
                          <input type="text" name="razon_social" class="razon_social_cliente datos-card-field">
                        </div>
                        <div class="datos-card-item">
                          <div class="title">Ruc:</div>
                          <input type="text" name="ruc" class="ruc_cliente datos-card-field">
                        </div>
                        <div class="datos-card-item">
                          <div class="title">Personería:</div>
                          <select class="tipo_persona datos-card-field" name="tipo_persona">
                            @foreach(config('cms.tipo_persona') as $personeria)
                            <option value="{{ $personeria['id'] }}">{{ $personeria['name'] }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="datos-card-item">
                          <div class="title">Tipo de Documento:</div>
                          <select class="tipo_doc_persona datos-card-field" name="tipo_doc_persona">
                            @foreach(config('cms.tipo_doc_persona') as $doc)
                            <option value="{{ $doc['id'] }}">{{ $doc['name'] }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="datos-card-item">
                          <div class="title">Documento:</div>
                          <input type="text" name="num_doc_persona" class="documento_cliente datos-card-field" autocomplete="off">
                        </div>
                        <div class="datos-card-item">
                          <div class="title">Cumpleaños:</div>
                          <input type="text" name="cumpleano_cliente" class="cumpleano_cliente datos-card-field date" autocomplete="off">
                        </div>
                        <div class="datos-card-item">
                          <div class="title">Email:</div>
                          <input type="text" name="email_cliente" class="email_cliente datos-card-field" autocomplete="off">
                        </div>
                        <div class="datos-card-item w_100">
                          <div class="title">Observaciones:</div>
                          <textarea name="obs_cliente" class="obs_cliente datos-card-field"></textarea>
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
                <div class="panel-heading">
                  Datos de cobro
                  <div class="gear">
                    <div class="gear-content">
                      <!-- Single button -->
                      <div class="sub-menu dropdown">
                          <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                            <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                          </a>
                          <ul class="dropdown-menu" role="menu" style="right: 0; left: initial;">
                              <li><a href="#" class="registrar-telefono" data-toggle="modal" data-target="#modal-telefono-registrar" data-title="" data-route="" data-idfind="id_cliente_update">Registrar teléfono</a></li>
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
                        <label>Teléfono pedido</label>
                        <select class="form-control" id="telefono_pedido" disabled>
                          
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6"></div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label>Fecha y hora</label>
                        <input type="text" name="" id="fecha_hora_cobro" class="form-control datetime">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                      <label>Hasta</label>
                      <input type="text" name="" id="hora_hasta" class="form-control datetime">
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label>Dirección de cobro</label>
                        <select class="form-control" id="direccion_cobro" disabled>
                          
                        </select>
                      </div>
                    </div>
                  </div>
                </div>

              </form>
              </div>
            </div>
          </div>
        </div>