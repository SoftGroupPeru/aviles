<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Marca
            <small>Mantenimiento</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo $url;?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="#">Mantenimiento</a></li>
            <li class="active">Marca</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Listado de Marcas</h3>
                  <button type="button" class="btn btn-primary" onclick="Nuevo()">
                    <i class="fa fa-user-plus"></i> Agregar
                  </button>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="t_marcas" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Nro</th>
                        <th>Marca</th>
                        <th>Imagen</th>
                        <th>Descripcion</th>
                        <th>Estado</th>
                        <th>Opciones</th>
                      </tr>
                    </thead>
                    <tbody id="tb_marcas">
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Nro</th>
                        <th>Marca</th>
                        <th>Imagen</th>
                        <th>Descripcion</th>
                        <th>Estado</th>
                        <th>Opciones</th>
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
      <?php $this->load->view("mantenimiento/form/marca");?>
