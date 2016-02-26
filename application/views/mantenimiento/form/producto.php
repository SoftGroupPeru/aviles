<!-- /.modal -->
<div class="modal fade" id="productoModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header logo">
                <button class="btn btn-sm btn-default pull-right" data-dismiss="modal">
                    <i class="fa fa-close"></i>
                </button>
                <h4 class="modal-title">Producto</h4>
            </div>
            <div class="modal-body">
                <form id="form_productos" name="form_productos" method="post" enctype="multipart/form-data" ><!--class="form-inline" role="form"-->                    
                    <div class="form-group">
                        <label class="control-label">Nombre Producto</label>
                        <input type="text" class="form-control" placeholder="Ingrese Nombre" name="txt_nombre" id="txt_nombre">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Codigo de Barra ##||</label>
                        <input type="text" class="form-control" placeholder="codigo de barra" name="txt_codbarra" id="txt_codbarra">
                    </div>
                     <div class="form-group">
                        <label class="control-label">Serie</label>
                        <input type="text" class="form-control" placeholder="Ingrese serie" name="txt_serie" id="txt_serie">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Parte</label>
                        <input type="text" class="form-control" placeholder="Ingrese parte" name="txt_parte" id="txt_parte">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Cantidad</label>
                        <input type="text" class="form-control" placeholder="Ingrese cantida" name="txt_cantidad" id="txt_cantidad">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Ubicacion</label>
                        <input type="text" class="form-control" placeholder="Ingrese Ubicacion" name="txt_ubicacion" id="txt_ubicacion">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Descripcion</label>
                        
                        <textarea placeholder="Descripcion" id="txt_descripcion" name="txt_descripcion" class="form-control" rows="3"></textarea>
                    </div>                    
                    <div class="form-group">
                        <!-- Content Header (Page header) -->
                        <label class="control-label" >Subir Imagen</label> 
                            <input type="text" class="form-control" placeholder="Titulo imagen" name="txt_img" id="txt_img"><br>
                            <!--<label class="control-label">Imagen 1:</label>-->
                            <input name="archivo" type="file" id="imagen" />
                             <div class="showImage"></div>   
                    </div>
                   <div class="form-group">
                        <label class="control-label">Estado:
                        </label>
                        <select class="form-control" name="slct_estado" id="slct_estado">
                            <option value='0'>Inactivo</option>
                            <option value='1' selected>Activo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Marca:
                        </label>
                        <select class="form-control" name="slct_marca" id="slct_marca">                            
                        </select>
                    </div>
                    <div class="form-group" >
                        <label><input id="cheknuevo" name="chek_producto" type="radio" value="pnuevo" checked="checked"  > Producto Nuevo </label>
                        <label><input id="chekseminuevo" name="chek_producto" type="radio" value="pseminuevo" > Producto Semi-Nuevo </label>
                    </div>
                    <input type="hidden" name="txt_id" id="txt_id">
                </form>
            </div>
            <div class="modal-footer">                
                <input type="hidden" id="submit" value="0"></input>
                <button type="button" class="btn btn-default" data-dismiss="modal" >Cerrar</button>
                <input type="button" id="AgregarEditar" class="btn btn-primary" value="Guardar"></input>
            <!--<button type="button" id="submit" class="btn btn-primary" value="0" onclick="AgregarEditar(this.value)">Guardar</button>-->
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->
