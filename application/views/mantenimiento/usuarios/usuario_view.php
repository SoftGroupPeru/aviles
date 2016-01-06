<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Usuarios
            <small>Mantenimiento</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo $url;?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="#">Mantenimiento</a></li>
            <li class="active">Usuarios</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Listado de Usuarios</h3>
                  <a href="<?php echo $url;?>usuario/nuevo"><button type="button" class="btn btn-primary"><i class="fa fa-user-plus"></i> Agregar</button></a>
                </div><!-- /.box-header -->

                <div class="box-body">
                  <table id="usuarios" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Nro</th>
                        <th>Usuario</th>
                        <th>Correo</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Dirección</th>
                        <th>Estado</th>
                        <th>Opciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $i = 1;
          					  foreach($arr_usuarios as $usuario) {
          						//  $fecha = date('d-m-Y', strtotime( $usuario->fecha_creacion));
                        if(($usuario->estado) == 1) $estado = '<button class="btn btn-block btn-success btn-sm" onclick="activardesactivar('.$usuario->idUsuario.', '.$usuario->estado.')">Activado</button>';
                        else $estado = '<button class="btn btn-block btn-danger btn-sm" onclick="activardesactivar('.$usuario->idUsuario.', '.$usuario->estado.')">Inactivo</button>';
                        echo '<tr>';
                        echo '<td>'.$i.'</td>';
                        echo '<td>'.$usuario->usuario.'</td>';
                        echo '<td>'.$usuario->correo.'</td>';
                        echo '<td>'.$usuario->nombre.'</td>';
                        echo '<td>'.$usuario->apellido.'</td>';
                        echo '<td>'.$usuario->direccion.'</td>';
                        echo '<td>'.$estado.'</td>';
                        echo '<td><a href="'.$url.'usuario/cargar/'.$usuario->idUsuario.'"><button type="button" title="Editar" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button></a> ';
                        echo '<a href="'.$url.'usuario/ver/'.$usuario->idUsuario.'"><button title="Ver" type="button" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></button></a> ';
                        echo '</td>';
                        echo '</tr>';
                        $i++;
                       }
                    ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Nro</th>
                        <th>Usuario</th>
                        <th>Correo</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Dirección</th>
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
