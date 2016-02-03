<!-- /.modal -->
<div class="modal fade" id="marcaModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header logo">
                <button class="btn btn-sm btn-default pull-right" data-dismiss="modal">
                    <i class="fa fa-close"></i>
                </button>
                <h4 class="modal-title">Marca</h4>
            </div>
            <div class="modal-body">
                <form id="form_marcas" name="form_marcas" action="" method="post">
                    <div class="form-group">
                        <label class="control-label">Marca
                            <a id="error_nombre" style="display:none" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="bottom" title="Ingrese Nombre">
                                <i class="fa fa-exclamation"></i>
                            </a>
                        </label>
                        <input type="text" class="form-control" placeholder="Ingrese marca" name="txt_marca" id="txt_marca">
                    </div>
                    <div class="form-group">
                      <label class="control-label">Imagen</label>
                      <!--<input type="text" class="form-control" placeholder="Ingrese Imagen" name="txt_apellido" id="txt_apellido"> -->
                    </div>
                    <div class="form-group">
                      <label class="control-label">Descripcion</label>
                        <input type="text" class="form-control" placeholder="Ingrese Descripcion" name="txt_descripcion" id="txt_descripcion">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Estado:
                        </label>
                        <select class="form-control" name="slct_estado" id="slct_estado">
                            <option value='0'>Inactivo</option>
                            <option value='1' selected>Activo</option>
                        </select>
                    </div>
                    <input type="hidden" name="txt_id" id="txt_id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" id="submit" class="btn btn-primary" value="0" onclick="AgregarEditar(this.value)">Guardar</button>
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->
