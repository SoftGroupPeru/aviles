<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Producto
            <small>Mantenimiento</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo $url;?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="#">Mantenimiento</a></li>
            <li class="active">Producto</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Listado de Productos</h3>
                  <button type="button" class="btn btn-primary" onclick="Nuevo()">
                    <i class="fa fa-user-plus"></i> Agregar
                  </button>
                </div><!-- /.box-header -->
                <div class="box-body">
                 <table id="t_producto" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Nro</th>
                        <th>Nombre</th>
                        <th>Cod. Barra</th>
                        <th>Stock</th>
                        <th>Serie</th>
                        <th>Parte</th>
                        <th>Cantidad</th>
                        <th>Ubicacion</th>
                        <th>Descripcion</th>
                        <th>Imagen</th>
                        <th>Estado</th>
                        <th>Marca</th>
                        <th>P. Nuevo</th>
                        <th>P. Semi Nuevo</th>
                        <th>Obsiones</th>
                      </tr>
                    </thead>
                    <tbody id="tb_producto">
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Nro</th>
                        <th>Nombre</th>
                        <th>Cod. Barra</th>
                        <th>Stock</th>
                        <th>Serie</th>
                        <th>Parte</th>
                        <th>Cantidad</th>
                        <th>Ubicacion</th>
                        <th>Descripcion</th>
                        <th>Imagen</th>
                        <th>Estado</th>
                        <th>Marca</th>
                        <th>P. Nuevo</th>
                        <th>P. Semi Nuevo</th>
                        <th>Obsiones</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <div id="msj" class="msjAlert"></div>
      <?php $this->load->view("mantenimiento/form/producto");?>
