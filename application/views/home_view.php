      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php echo $pedidos[0]->despachados?></h3>
                  <p>Pedidos Despachados</p>
                </div>
                <div class="icon">
                  <i class="ion ion-happy"></i>
                </div>
                <a href="#" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo $pedidos[0]->confirmados?></h3>
                    <p>Pedidos Confirmados</p>
                </div>
                <div class="icon">
                  <i class="ion ion-calendar"></i>
                </div>
                <a href="#" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php echo $pedidos[0]->pendientes?></h3>
                  <p>Pedidos Pendiente</p>
                </div>
                <div class="icon">
                  <i class="ion ion-clock"></i>
                </div>
                <a href="#" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php echo $pedidos[0]->cancelados?></h3>
                  <p>Pedidos Cancelados</p>
                </div>
                <div class="icon">
                  <i class="ion ion-sad"></i>
                </div>
                <a href="#" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->

          <div class="row">
          <section class="col-lg-7 connectedSortable">
            <!-- TABLE: LATEST ORDERS -->
            <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Últimos Pedidos</h3>
                <div class="box-tools pull-right">
                  <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="table-responsive">
                  <table class="table no-margin">
                    <thead>
                      <tr>
                        <th>Cliente</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Fecha registro</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($ultimos_pedidos as $pedido) { ?>
                        <tr>
                          <td><a href="#"><?php echo $pedido->nombre_padre.''.$pedido->apellido_padre;?></a></td>
                          <td><?php echo $pedido->pedido;?></td>
                          <td>
                              <?php
                              switch ($pedido->estado) {
                                case 1: $estado = 'Confirmado'; $tipo ='success';break;
                                case 2: $estado = 'Pendiente'; $tipo ='warning';break;
                                case 3: $estado = 'Despachado'; $tipo ='info';break;
                                case 0: $estado = 'Cancelado'; $tipo ='danger';break;
                              }
                              echo '<span class="label label-'.$tipo.'">'.$estado.'</span>';?>
                          </td>
                          <td><div class="sparkbar" data-color="#f39c12" data-height="20"><?php echo $pedido->fecha_registro;?></div></td>
                        </tr>
                      <?php }?>
                    </tbody>
                  </table>
                </div><!-- /.table-responsive -->
              </div><!-- /.box-body -->
              <div class="box-footer clearfix">
                <a href="javascript::;" class="btn btn-sm btn-info btn-flat pull-left">Realizar pedido</a>
                <a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">Ver pedidos</a>
              </div><!-- /.box-footer -->
            </div><!-- /.box -->
          </section>

          <section class="col-lg-5 connectedSortable">
           <!-- Calendar -->
              <div class="box box-solid bg-green-gradient">
                <div class="box-header">
                  <i class="fa fa-calendar"></i>
                  <h3 class="box-title">Calendario</h3>
                  <!-- tools box -->
                  <div class="pull-right box-tools">
                    <!-- button with a dropdown
                    <div class="btn-group">
                      <button class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
                      <ul class="dropdown-menu pull-right" role="menu">
                        <li><a href="#">Add new event</a></li>
                        <li><a href="#">Clear events</a></li>
                        <li class="divider"></li>
                        <li><a href="#">View calendar</a></li>
                      </ul>
                    </div>-->
                    <button class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div><!-- /. tools -->
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <!--The calendar -->
                  <div data-date="<?php echo date("m/d/Y");?>" id="calendar" style="width: 100%"></div>
                </div><!-- /.box-body -->
                <div class="box-footer text-black">
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- Progress bars -->
                      <div class="clearfix">
                        <span class="pull-left">Task #1</span>
                        <small class="pull-right">90%</small>
                      </div>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: 90%;"></div>
                      </div>

                      <div class="clearfix">
                        <span class="pull-left">Task #2</span>
                        <small class="pull-right">70%</small>
                      </div>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: 70%;"></div>
                      </div>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                      <div class="clearfix">
                        <span class="pull-left">Task #3</span>
                        <small class="pull-right">60%</small>
                      </div>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: 60%;"></div>
                      </div>

                      <div class="clearfix">
                        <span class="pull-left">Task #4</span>
                        <small class="pull-right">40%</small>
                      </div>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: 40%;"></div>
                      </div>
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div>
              </div><!-- /.box -->
            </section>
            </div><!-- /.row (main row) -->
        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->
