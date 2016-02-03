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
                '<td><button type="button" title="Editar" onclick="Cargar('+data.idUsuario+')" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button> </td>';
            html+="</tr>";
        });
        $("#tb_marcas").html(html);
        $("#t_marcas").dataTable();
        //activarTabla();
      }
