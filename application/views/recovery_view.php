<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistema Admin - ALIPAT SAC</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo $url;?>bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo $url;?>dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo $url;?>plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- custom styles -->
    <link rel="stylesheet" href="<?php echo $url;?>dist/css/custom.css">
  </head>
  <body class="hold-transition login-page fondo">
    <div class="login-box">
      <div class="login-logo">
        Recuperar contraseña
        </center>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <?php
        if(isset($msj)) {
          $color = ($msj[0]==1)?'light-blue':'red';
          echo '<p class="text-'.$color.'">'.$msj[1].'</p>';
        } else {
          echo '<p class="login-box-msg">Ingresa el correo electronico asociado a la cuenta</p>';
        }
        echo form_open('login/verify'); ?>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" id="email" name="txtemail" placeholder="Correo Electronico" <?php echo (isset($msj) && $msj[0]==1)?'disabled':'';?>>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="row">
            <!-- /.col -->
            <div class="col-xs-12">
              <?php if (isset($msj) && $msj[0]==1) {
                echo '<a href="'.$url.'" class="btn btn-success btn-block btn-flat">Regresar</a>';
              } else {
                echo '<button type="submit" name="btningresar" class="btn btn-primary btn-block btn-flat">Enviar</button>';
              } ?>
            </div><!-- /.col -->
          </div>

          <?php echo form_close(); ?>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo $url;?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo $url;?>bootstrap/js/bootstrap.min.js"></script>

  </body>
</html>
