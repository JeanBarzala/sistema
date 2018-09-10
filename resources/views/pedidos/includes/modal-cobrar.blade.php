<!-- modal -->
<div class="modal fade" id="modal-cobrar">
  
    <div class="modal-dialog">
        {!! Form::open(['method' => 'post', 'route' => 'pedidos.cobrar']) !!}
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Datos del cobro</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                  @foreach(config('cms.formas_pagos') as $forma_pago)                 
                  <input type="hidden" name="forma_pago[]" value="{{ $forma_pago['id'] }}" class="form-control">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>{{ $forma_pago['name'] }}</label>
                      <input type="text" name="monto_cobro[]" class="form-control monto_cobro" value="">
                    </div>
                  </div>
                  @endforeach
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>Total</label>
                      <input type="text" name="total_cobrar" class="form-control total_cobrar" value="" readonly>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>Vuelto</label>
                      <input type="text" name="vuelto_cobrar" class="form-control vuelto_cobrar" value="" readonly>
                    </div>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal" value="cobrar">Cancelar</button>
                {!! Form::button('Confirmar', ['class' => 'btn btn-success', 'type' => 'submit']) !!}
            </div>
        </div>
        {!! Form::close() !!}
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->