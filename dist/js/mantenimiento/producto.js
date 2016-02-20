$(document).ready(function(){
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
                    //alert(data) ;
                        $(".overlay,.loading-img").remove();
                         if(data.rst==1){
                             
                             $('#productoModal .modal-footer [data-dismiss="modal"]').click();
                                 mensaje('success', data.msj, 5000);
                         }
                         else{

                            if(data.peso==1) {
                             mensaje('error', data.msj, 5000); 
                             }
                               /* $.each(obj.msj,function(index,datos){
                                    mensaje('error', data.msj);
                                });*/
                        }                       
                        
                  }
                });
        }else{
           mensaje('error', "Ingrese todos los campos correctamente", 5000); 
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
				//alert(obj) ;
				for (var i = 1; i <= obj.cantidad; i++) {
					//alert(obj[i]) ;
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

