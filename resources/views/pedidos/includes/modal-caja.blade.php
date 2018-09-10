<!-- modal -->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      {!! Form::open(['method' => 'post', 'class' => 'caja caja-apertura', 'route' => 'ventas.pedidos.caja']) !!}
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Apertura/Cierre de caja</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>Cajas</label>
                      <select name="caja" class="form-control" required="">
                        <option value="">Selecciona una caja</option>
                        @foreach($cajas as $caja)
                        <option value="{{ $caja->id_caja }}">{{ $caja->id_caja . ' - ' .$caja->descripcion_caja }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>Monto</label>
                      <input type="text" name="monto" class="form-control" autocomplete="off" required="">
                    </div>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                    {!! Form::button('Confirmar', ['class' => 'btn btn-success', 'type' => 'submit']) !!}
            </div>
        </div>
        {!! Form::close() !!}
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->