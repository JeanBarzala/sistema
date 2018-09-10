<div class="modal fade" id="modal-direccion-registrar">
    <div class="modal-dialog modal-lg">
      {!! Form::open(['method' => 'post', 'url' => route('clientes.direccion.store', ['id_persona' => $clientes->id_persona])]) !!}
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Registrar dirección</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label>Ciudad</label>
                      <select name="ciudad" class="form-control select-ciudad">
                        @if(count($ciudades))
                        @foreach($ciudades as $ciudad)
                        <option value="{{ $ciudad->id_ciudad }}">{{ $ciudad->nombre_ciudad }}</option>
                        @endforeach
                        @endif
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label>Barrio</label>
                      <select name="barrio" class="form-control select-barrio">
                        @if(count($barrios))
                        @foreach($barrios as $barrio)
                        <option value="{{ $barrio->id_barrio }}">{{ $barrio->nombre_barrio }}</option>
                        @endforeach
                        @endif
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label>Calle principal</label>
                      <input type="text" name="calle_direccion" class="form-control" value="">
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label>N° de casa</label>
                      <input type="text" name="numero_direccion" class="form-control" value="">
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label>Complemento</label>
                      <input type="text" name="complemento_direccion" class="form-control" value="">
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label>Intersección 1</label>
                      <input type="text" name="interseccion1_direccion" class="form-control" value="">
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label>Intersección 2</label>
                      <input type="text" name="interseccion2_direccion" class="form-control" value="">
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label>Barrio dirección</label>
                      <input type="text" name="barrio_direccion" class="form-control" value="">
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label>Referencia</label>
                      <input type="text" name="referencia_direccion" class="form-control" value="">
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label>Observaciones</label>
                      <input type="text" name="observaciones_direccion" class="form-control" value="">
                    </div>
                  </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                  {!! Form::button('Guardar', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
            </div>
        </div>
        {!! Form::close() !!}
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->