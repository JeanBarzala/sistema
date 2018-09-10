<div role="tabpanel" class="tab-pane" id="tarjeta">
          <div class="row">
            <div class="col-lg-12">
              <div class="panel panel-default">
                <div class="panel-body">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="row">
                        <div class="col-lg-8">                          
                            <label>Tarjeta:</label>
                            <select name="tarjeta" class="form-control" id="select-tarjeta">
                              <option value="" selected disabled>Seleccione una tarjeta</option>
                              @foreach($tarjetas as $tarjeta)
                              <option value="{{ $tarjeta->id_producto }}" id="{{ $tarjeta->id_producto }}" >{{ $tarjeta->nombre_producto }}</option>
                              @endforeach
                            </select>
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
              <div class="panel panel-defaul">
                <div class="panel-body">
                  <div class="form-group">
                  <label>Texto de la tarjeta</label>
                    <textarea id="tarjeta-text" class="form-control" rows="6"></textarea>
                  </div>
                  <div class="form-group">
                    <a href="#" class="btn btn-primary" id="borrar-tarjeta">Limpiar</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>