<!-- /.modal -->
<div class="modal fade" id="usuarioModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header logo">
                <button class="btn btn-sm btn-default pull-right" data-dismiss="modal">
                    <i class="fa fa-close"></i>
                </button>
                <h4 class="modal-title">Usuario</h4>
            </div>
            <div class="modal-body">
                <form id="form_usuarios" name="form_usuarios" action="" method="post">
                    <div class="form-group">
                        <label class="control-label">Usuario
                            <a id="error_nombre" style="display:none" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="bottom" title="Ingrese Nombre">
                                <i class="fa fa-exclamation"></i>
                            </a>
                        </label>
                        <input type="text" class="form-control" placeholder="Ingrese Usuario" name="txt_usuario" id="txt_usuario">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Contraseña</label>
                        <input type="password" class="form-control" placeholder="Ingrese Contraseña" name="txt_pass" id="txt_pass">
                    </div>
                    <div class="form-group">
                      <label class="control-label">Nombres</label>
                        <input type="text" class="form-control" placeholder="Ingrese Nombres" name="txt_nombre" id="txt_nombre">
                    </div>
                    <div class="form-group">
                      <label class="control-label">Apellidos</label>
                        <input type="text" class="form-control" placeholder="Ingrese Apellidos" name="txt_apellido" id="txt_apellido">
                    </div>
                    <div class="form-group">
                      <label class="control-label">Correo</label>
                        <input type="text" class="form-control" placeholder="Ingrese Correo" name="txt_correo" id="txt_correo">
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
