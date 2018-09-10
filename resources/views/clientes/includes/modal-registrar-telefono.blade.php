<div class="modal fade" id="modal-telefono-registrar">
    <div class="modal-dialog modal-lg">
      {!! Form::open(['method' => 'post', 'url' => route('clientes.telefono.store', ['id_persona' => !empty($clientes) ? $clientes->id_persona : ''])]) !!}
        <input type="hidden" name="id_persona" value="">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Registrar teléfono</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label>Tipo</label>
                      <select name="tipo_telefono" class="form-control">
                        <option value="F">Fijo</option>
                        <option value="M">Móvil</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label>Local</label>
                      <select name="local_telefono" class="form-control">
                        <option value="P">Particular</option>
                        <option value="L">Laboral</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label>Número de teléfono</label>
                      <input type="text" name="numero_telefono" class="form-control" value="" autocomplete="off">
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