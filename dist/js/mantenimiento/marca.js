$(document).ready(function() {
  ListarMarcas();
var fileExtension = "";
    $(':file').change(function()
    {
        //obtenemos un array con los datos del archivo
        var file = $("#imagen")[0].files[0];
        //obtenemos el nombre del archivo
        var fileName = file.name;
        //obtenemos la extensión del archivo
        fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
        //obtenemos el tamaño del archivo
        var fileSize = file.size;
        //obtenemos el tipo de archivo image/png ejemplo
        var fileType = file.type;
        //mensaje con la información del archivo
        //showMessage("<span class='info'>Archivo para subir: "+fileName+", peso total: "+fileSize+" bytes.</span>");
    });


    $("#AgregarEditar").click(function(){
        var AE = $("#submit").val() ;
        var activarfile = $("#activarfile").val() ;
        if (validar(AE,activarfile)){
               // var AE = $("#submit").val() ;               
                var accion="marca/crear";
                if(AE==1){
                    accion="marca/editar";                    
                }
                var formData = new FormData($("#form_marcas")[0]);

                $.ajax({
                url     : url + accion,
                type    : 'POST',
                data    : formData,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                beforeSend : function() {
                $("body").append('<div class="overlay"></div><div class="loading-img"></div>');
                },      
                success : function(data){ 
                    $(".overlay,.loading-img").remove();
                         if(data.rst==1){                            
                              $('#t_marcas').dataTable().fnDestroy();
                             ListarMarcas() ;
                             $('#marcaModal .modal-footer [data-dismiss="modal"]').click();
                             mensaje('success', data.msj, 5000);
                         }
                         else{
                            if(data.peso==1) {
                             mensaje('error', data.msj, 5000); 
                             }
                             $.each(data.msj,function(index,datos){
                                    mensaje('error', data.msj);
                             });
                         }                          
                  }
                });
        }else{
           mensaje('error',"Ingrese todos los campos correctamente", 5000); 
        }
    });
});

      function isImage(extension)
      {
          switch(extension.toLowerCase()) 
          {
              case 'jpg': case 'gif': case 'png': case 'jpeg':
                  return true;
              break;
              default:
                  return false;
              break;
          }
      }


      function Nuevo(){        
        $("#txt_marca").val('');
        $("#txt_descripcion").val('');
        $("#imagen").val('');
        $("#imagen").show();
        $('#marcaModal').find('.modal-title').text('Nueva Marca');
        $('#marcaModal').modal('show');
      }

      function validar(AE,activarfile){      
        if (AE==1) {
          if (activarfile==1){
            if($("#txt_marca").val() == "" || $("#txt_descripcion").val() == "" || $("#txt_img").val() == "" || $("#imagen").val() == ""){
            return false;
            }
          }else{
                if($("#txt_marca").val() == "" || $("#txt_descripcion").val() == "" || $("#txt_img").val() == "") {
                return false;
                }
            }
        }else{
            if($("#txt_marca").val() == "" || $("#txt_descripcion").val() == "" || $("#txt_img").val() == "" || $("#imagen").val() == "") {
            return false;
            }    
        }      
               
        return true;
      }


    function ListarMarcas(){
      $.ajax({
            url         : url + 'marca/listar',
            type        : 'POST',
            cache       : false,
            dataType    : 'json',
            beforeSend : function() {
               $("body").append('<div class="overlay"></div><div class="loading-img"></div>');
            },
            success : function(obj) {              
              $(".overlay,.loading-img").remove();
                if(obj.rst==1){
                    HTMLCargarMarca(obj.datos);
                }                
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
            if (data.imagen==null) {
            var conten_imagen = "<td style='text-align:center ;'><i class='fa fa-warning'></i></td>" ;              
            }else{
                var conten_imagen = "<td><img title='"+data.imagen+"'' width='90px' src='"+url+"images/marcas/"+data.imagen+"'></td>" ;   
            }
            html+="<tr>"+
                "<td>"+con+"</td>"+
                "<td>"+data.nombre+"</td>"+
                conten_imagen+
                "<td>"+data.descripcion+"</td>"+
                "<td>"+estadohtml+"</td>"+
                '<td><button type="button" title="Editar" onclick="Cargar('+data.idMarca+')" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button> </td>';
            html+="</tr>";
        });
        $("#tb_marcas").html(html);
        $("#t_marcas").dataTable();        
      }      

      function Cargar(id){
        $('#marcaModal').modal('show');
        $('#marcaModal').find('.modal-title').text('Editar Marca');
        $("#AgregarEditar").val('Editar');
        $("#activarfile").val('0');
        $("#imagen").val('');
        $("#imagen").hide();
        $("#txt_img").change(function(){
           $("#imagen").show();
           $("#activarfile").val('1');
        });
        $("#submit").val('1');

            $.ajax({
                url         : url + "marca/cargar",
                type        : 'POST',
                cache       : false,
                dataType    : 'json',
                data        : {id: id},
                success : function(data) {
                   if (data.imagen==null) {
                        var str = '.' ;    
                    }else{
                        var str = data.imagen ;
                    }                    
                    var myarr = str.split(".");
                    var imagen = myarr[0] ; 


                    $("#txt_id").val(data.idMarca);
                    $("#txt_marca").val(data.nombre);
                    $("#txt_descripcion").val(data.descripcion);
                    $("#slct_estado").val(data.estado);
                    $("#txt_img").val(imagen); 
                }
            });
      }
      

      function CambiarEstadoMarcas(id,estado){                      
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
