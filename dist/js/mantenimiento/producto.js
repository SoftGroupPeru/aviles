$(document).ready(function(){
    
    listarProductos() ;
	tipo_marca() ;
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
        if (validar()){
                var AE = $("#submit").val() ;               
                var accion="producto/crear";
                if(AE==1){
                    accion="producto/editar";                    
                }
                var formData = new FormData($("#form_productos")[0]);

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
                              $('#t_producto').dataTable().fnDestroy();
                             listarProductos() ;
                             $('#productoModal .modal-footer [data-dismiss="modal"]').click();
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
    $("#submit").val('0');
    $("#AgregarEditar").val('Nuevo');
	$("#txt_nombre").val('');
    $("#txt_codbarra").val('');
    $("#txt_serie").val('');
    $("#txt_parte").val('');
    $("#txt_cantidad").val('');
    $("#txt_ubicacion").val('');
    $("#txt_descripcion").val('');
    $("#txt_img").val('');
    $("#imagen").val('');
    $('#productoModal').find('.modal-title').text('Nuevo Producto');
    $('#productoModal').modal('show');
}

function tipo_marca() {
	$.ajax({
		url 	: url + 'producto/listarmarca',
		type	: 'POST',
		cache	: false,
		dataType: 'json',
		success : function(obj) {				
				for (var i = 1; i <= obj.cantidad; i++) {					
					$('#slct_marca').append("<option value='"+i+"'>"+obj[i]+"</option>");
				};
        }
	});
}

function validar(){
    //faltan campos requeridos
    if($("#txt_nombre").val() == "" || $("#txt_codbarra").val() == "" || $("#txt_serie").val() == "" || $("#txt_parte").val() == "" || $("#txt_cantidad").val() == "" || $("#txt_ubicacion").val() == "" || $("#txt_descripcion").val() == "" || $("#txt_imagen").val() == "" || $("#imagen").val() == "") {
      return false;
    }    
    return true;
}


function listarProductos(){
    $.ajax({
        url          : url + 'producto/listar',
        type         : 'POST',
        cache        : false,
        dataType     : 'json',
        beforeSend  : function(){
            $("body").append('<div class="overlay"></div><div class="loading-img"></div>');
        },
        success     : function(obj){            
            $(".overlay,.loading-img").remove();    
            if(obj.rst==1){
                  HTMLCargarProducto(obj.datos);
              }            
        },
        error: function(){
              $(".overlay,.loading-img").remove();
              mensaje('danger', 'Ocurrio una interrupción en el proceso,Favor de intentar nuevamente.', 6000);
        }
    });
}

function HTMLCargarProducto(datos){
    var html="";
    var con = 0;
    
    $('#t_producto').dataTable().fnDestroy();

    $.each(datos,function(index,data){
        con++;
        estadohtml='<span id="'+data.idProducto+'" onClick="CambiarEstadoProducto('+data.idProducto+','+data.estado+')" class="btn btn-danger btn-sm">Inactivo</span>';
        if(data.estado==1){
            estadohtml='<span id="'+data.idProducto+'" onClick="CambiarEstadoProducto('+data.idProducto+','+data.estado+')" class="btn btn-success btn-sm">Activo</span>';
        }
         html+="<tr>"+
            "<td>"+con+"</td>"+
            "<td>"+data.nombre+"</td>"+
            "<td>"+data.codigo_barra+"</td>"+
            "<td>"+data.stock+"</td>"+
            "<td>"+data.serie+"</td>"+
            "<td>"+data.parte+"</td>"+
            "<td>"+data.cantidad+"</td>"+
            "<td>"+data.ubicacion+"</td>"+
            "<td>"+data.descripcion+"</td>"+
            "<td>"+data.imagen+"</td>"+
            "<td>"+estadohtml+"</td>"+
            "<td>"+data.Marca_idMarca+"</td>"+
            "<td>"+data.producto_nuevo+"</td>"+            
            "<td>"+data.producto_seminuevo+"</td>"+
            '<td><button type="button" title="Editar" onclick="Cargar('+data.idProducto+')" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button> </td>';
        html+="</tr>"; 
    });
    $("#tb_producto").html(html);
    $("#t_producto").dataTable();
}


function Cargar(id){
    $('#productoModal').modal('show');
    $('#productoModal').find('.modal-title').text('Editar Producto');
    $("#AgregarEditar").val('Editar');
    $("#submit").val('1');

    $.ajax({
            url         : url + "producto/cargar",
            type        : 'POST',
            cache       : false,
            dataType    : 'json',
            data        : {id: id},
            success : function(data){
                               
                    var str = data.imagen ;
                    var myarr = str.split(".");
                    var imagen = myarr[0] ;                   

                $("#txt_id").val(data.idProducto);
                $("#txt_nombre").val(data.nombre);
                $("#txt_codbarra").val(data.codigo_barra);
                $("#txt_serie").val(data.serie);
                $("#txt_parte").val(data.parte);
                $("#txt_cantidad").val(data.cantidad);
                $("#txt_ubicacion").val(data.ubicacion);
                $("#txt_descripcion").val(data.descripcion);
                $("#txt_img").val(imagen);                
                $("#slct_estado").val(data.estado);                
            }
    });
}

function CambiarEstadoProducto(id,estado){      
        $.ajax({
            url         : 'producto/cambiarestado',
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
                    $('#t_producto').dataTable().fnDestroy();
                    listarProductos();
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