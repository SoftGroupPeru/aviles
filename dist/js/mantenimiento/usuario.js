$(document).ready(function() {
  ListarUsuarios();
});

  function ListarUsuarios(){
    $.ajax({
          url         : url + 'usuario/listar',
          type        : 'POST',
          cache       : false,
          dataType    : 'json',
          beforeSend : function() {
              $("body").append('<div class="overlay"></div><div class="loading-img"></div>');
          },
          success : function(obj) {
              if(obj.rst==1){
                  HTMLCargarUsuario(obj.datos);
              }
              $(".overlay,.loading-img").remove();
          },
          error: function(){
              $(".overlay,.loading-img").remove();
              mensaje('danger', 'Ocurrio una interrupción en el proceso,Favor de intentar nuevamente.', 6000);
          }
      });
  }

  function HTMLCargarUsuario(datos){
    var html="";
    var con = 0;
    $('#t_usuario').dataTable().fnDestroy();

    $.each(datos,function(index,data){
        con++;
        estadohtml='<span id="'+data.idUsuario+'" onClick="CambiarEstadoUsuarios('+data.idUsuario+','+data.estado+')" class="btn btn-danger btn-sm">Inactivo</span>';
        if(data.estado==1){
            estadohtml='<span id="'+data.idUsuario+'" onClick="CambiarEstadoUsuarios('+data.idUsuario+','+data.estado+')" class="btn btn-success btn-sm">Activo</span>';
        }
        html+="<tr>"+
            "<td>"+con+"</td>"+
            "<td>"+data.usuario+"</td>"+
            "<td>"+data.correo+"</td>"+
            "<td>"+data.nombre+"</td>"+
            "<td>"+data.apellido+"</td>"+
            "<td>"+estadohtml+"</td>"+
            '<td><button type="button" title="Editar" onclick="Cargar('+data.idUsuario+')" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button> </td>';
        html+="</tr>";
    });
    $("#tb_usuarios").html(html);
    $("#t_usuarios").dataTable();
    //activarTabla();
  }

  function Nuevo(){
    $("#txt_usuario").val('');
    $("#txt_pass").val('');
    $('#usuarioModal').find('.modal-title').text('Nuevo Usuario');
    $('#usuarioModal').modal('show');
  }

  function AgregarEditar(AE){
        var datos=$("#form_usuarios").serialize().split("txt_").join("").split("slct_").join("");

        var accion="usuario/crear";
        if(AE==1){
            accion="usuario/editar";
        }
        $.ajax({
            url         : url + accion,
            type        : 'POST',
            cache       : false,
            dataType    : 'json',
            data        : datos,
            beforeSend : function() {
                $("body").append('<div class="overlay"></div><div class="loading-img"></div>');
            },
            success : function(data) {
                $(".overlay,.loading-img").remove();
                if(data.rst==1){
                      $('#t_usuarios').dataTable().fnDestroy();
                      ListarUsuarios();
                      $('#usuarioModal .modal-footer [data-dismiss="modal"]').click();
                      mensaje('success', data.msj, 5000);
                  }
                  else{
                      $.each(obj.msj,function(index,datos){
                          mensaje('error', data.msj, 5000);
                      });
                  }
            }
        });
  }

  function Cargar(id){
    $('#usuarioModal').modal('show');
    $('#usuarioModal').find('.modal-title').text('Editar Usuario');
        $.ajax({
            url         : url + "usuario/cargar",
            type        : 'POST',
            cache       : false,
            dataType    : 'json',
            data        : {id: id},
            success : function(data) {

                $("#txt_id").val(data.idUsuario);
                $("#txt_usuario").val(data.usuario);
                $("#txt_pass").attr("placeholder", "Ingrese nueva contraseña");
                $("#txt_pass").val(''); // la clave no se muestra
                $("#txt_nombre").val(data.nombre);
                $("#txt_apellido").val(data.apellido);
                $("#txt_correo").val(data.correo);
                $("#slct_estado").val(data.estado);

                $("#submit").val('1');
                onclick="Agregar(0)"
            }
        });
  }

  function CambiarEstadoUsuarios(id,estado){
        //$("#form_usuarios").append("<input type='hidden' value='"+id+"' name='id'>");
      //  $("#form_usuarios").append("<input type='hidden' value='"+AD+"' name='estado'>");
        var datos=$("#form_usuarios").serialize().split("txt_").join("").split("slct_").join("");
        $.ajax({
            url         : 'usuario/cambiarestado',
            type        : 'POST',
            cache       : false,
            dataType    : 'json',
            data        : {id:id,estado: estado},
            beforeSend : function() {
                $("body").append('<div class="overlay"></div><div class="loading-img"></div>');
            },
            success : function(obj) {
                $(".overlay,.loading-img").remove();
                if(obj.rst==1){
                    $('#t_usuarios').dataTable().fnDestroy();
                    ListarUsuarios();
                    //mensaje('success', obj.msj, 6000);
                }
                else{
                    $.each(obj.msj,function(index,datos){
                        $("#error_"+index).attr("data-original-title",datos);
                        $('#error_'+index).css('display','');
                    });
                }
            },
            error: function(){
                $(".overlay,.loading-img").remove();
                Psi.mensaje('danger', 'Ocurrio una interrupción en el proceso,Favor de intentar nuevamente.', 6000);

            }
        });

    }
