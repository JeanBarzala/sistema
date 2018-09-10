<!-- modal descuentos -->
<div class="modal fade" id="modal-descuento">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Descuentos</h4>
                
            </div>
            <div class="modal-body">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-lg-6">
                          <label for="tipo_descuento2">Monto</label>
                          <input type="radio" name="tipo_descuento" id="tipo_descuento2" value="monto" checked>
                        </div>
                        <div class="col-lg-6">
                          <label for="tipo_descuento1">Porcentaje</label>
                          <input type="radio" name="tipo_descuento" id="tipo_descuento1" value="porcentaje">
                        </div>                        
                      </div>
                      
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>Monto</label>
                      <input type="text" name="monto_descuento" class="form-control" autocomplete="off" required="">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>Porcentaje</label>
                      <input type="text" name="porcentaje" class="form-control" autocomplete="off" required="" disabled>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label for="tipo_descuento2">Motivo del descuento</label>
                      <textarea class="form-control" name="motivo_descuento"></textarea>
                    </div>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                <button type="reset" class="btn btn-default pull-left">Limpiar</button>
                <button class="btn btn-success" id="submit_descuento">Confirmar</button>
            </div>
        </div>
        
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->