$(document).ready(function() {
  ListarMarcas();
});

    function ListarMarcas(){
      $.ajax({
            url         : url + 'marca/listar',
            type        : 'POST',
            cache       : false,
            dataType    : 'json',
            beforeSend : function() {
            //    $("body").append('<div class="overlay"></div><div class="loading-img"></div>');
            },
            success : function(obj) {
                if(obj.rst==1){
                    HTMLCargarMarca(obj.datos);
                }
                $(".overlay,.loading-img").remove();
            },
            error: function(){
                $(".overlay,.loading-img").remove();
                mensaje('danger', 'Ocurrio una interrupción en el proceso,Favor de intentar nuevamente.', 6000);
            }
        });
    }


      function HTMLCargarMarca(datos){
        var html="";
        var con = 0;
        $('#t_marcas').dataTable().fnDestroy();

        $.each(datos,function(index,data){
            con++;
            estadohtml='<span id="'+data.idMarca+'" onClick="CambiarEstadoMarcas('+data.idMarca+','+data.estado+')" class="btn btn-danger btn-sm">Inactivo</span>';
            if(data.estado==1){
                estadohtml='<span id="'+data.idMarca+'" onClick="CambiarEstadoMarcas('+data.idMarca+','+data.estado+')" class="btn btn-success btn-sm">Activo</span>';
            }
            html+="<tr>"+
                "<td>"+con+"</td>"+
                "<td>"+data.nombre+"</td>"+
                "<td>"+data.imagen+"</td>"+
                "<td>"+data.descripcion+"</td>"+
                "<td>"+estadohtml+"</td>"+
                '<td><button type="button" title="Editar" onclick="Cargar('+data.idMarca+')" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button> </td>';
            html+="</tr>";
        });
        $("#tb_marcas").html(html);
        $("#t_marcas").dataTable();
        //activarTabla();
      }


      function Nuevo(){
        $("#txt_marca").val('');
        $("#txt_descripcion").val('');
        $('#marcaModal').find('.modal-title').text('Nueva Marca');
        $('#marcaModal').modal('show');
      }


      function validar(){
        if($("#txt_marca").val() == ""){
          return false;
        } else {
          return true;
          }

        }


      function AgregarEditar(AE){
        if (validar()) {
            var datos=$("#form_marcas").serialize().split("txt_").join("").split("slct_").join("");

            var accion="marca/crear";
            if(AE==1){
                accion="marca/editar";
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
                          $('#t_marcas').dataTable().fnDestroy();
                          ListaMarcas();
                          $('#marcaModal .modal-footer [data-dismiss="modal"]').click();
                          mensaje('success', data.msj, 5000);
                      }
                      else{
                          $.each(obj.msj,function(index,datos){
                              mensaje('error', data.msj);
                          });
                      }
                }
            });
          } else {
              mensaje('error', "Ingrese todos los campos correctamente", 5000);
          }
      }

      function Cargar(id){
        $('#marcaModal').modal('show');
        $('#marcaModal').find('.modal-title').text('Editar Marca');
            $.ajax({
                url         : url + "marca/cargar",
                type        : 'POST',
                cache       : false,
                dataType    : 'json',
                data        : {id: id},
                success : function(data) {

                    $("#txt_id").val(data.idMarca);
                    $("#txt_marca").val(data.nombre);
                    $("#txt_descripcion").val(data.descripcion);
                    $("#slct_estado").val(data.estado);

                    $("#submit").val('1');
                    onclick="Agregar(0)"
                }
            });
      }

      function CambiarEstadoMarcas(id,estado){
            //$("#form_marcas").append("<input type='hidden' value='"+id+"' name='id'>");
          //  $("#form_marcas").append("<input type='hidden' value='"+AD+"' name='estado'>");
            var datos=$("#form_marcas").serialize().split("txt_").join("").split("slct_").join("");
            $.ajax({
                url         : 'marca/cambiarestado',
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
                        $('#t_marcas').dataTable().fnDestroy();
                        ListarMarcas();
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
