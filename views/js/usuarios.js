/*==============================================================================================
SUBIENDO LA FOTO DEL USUARIO
==============================================================================================*/

$(".nuevaFoto").change(function(){

    var imagen = this.files[0];
    // console.log(imagen);
 
    /*==============================================================================================
    VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
    ==============================================================================================*/

    if (imagen['type'] != "image/jpeg" && imagen['type'] != "image/png") {
        
        $(".nuevaFoto").val("");

            swal.fire({
                title: "Error al subir la imagen", 
                text: "¡La imagen debe estar en formato JPG o PNG",
                type: "error",
                confirmButtonText: "¡Cerrar!"
            });
    }else if (imagen['size'] > 2000000) {
        
        $(".nuevaFoto").val("");
        
            swal.fire({
                title: "Error al subir la imagen",
                text: "¡La imagen no debe superar los 2 MB",
                type: "error",
                confirmButtonText: "¡Cerrar!"
            });
    }else{

        var datosImagen = new FileReader();
        datosImagen.readAsDataURL(imagen);

        $(datosImagen).on("load", function(event){
            
            var rutaImagen = event.target.result;

            $(".previsualizar").attr("src", rutaImagen);
        });
    }
});

/*==============================================================================================
EDITAR USUARIO
==============================================================================================*/

$(".tablas").on("click", ".btnEditarUsuario" , function(){

    var idUsuario = $(this).attr("idUsuario");
    
    var datos = new FormData();
    datos.append("idUsuario",idUsuario);


    //Ajax  
    $.ajax({
        
        url: "ajax/usuarios.ajax.php", 
        method: "POST",
        data: datos,
        cache: false,
        contentType: false, 
        processData: false,
        dataType: "json",
        success: function(respuesta) {

            
            $("#editarNombre").val(respuesta['nombre']);
            $("#editarUsuario").val(respuesta['usuario']);
            // En el perfil por ser un option tiene que ser en el html
            $("#editarPerfil").html(respuesta['perfil']);
            $("#editarPerfil").val(respuesta['perfil']);
            $("#passwordActual").val(respuesta['password']);
            $("#fotoActual").val(respuesta['foto']);
            

            if (respuesta['foto'] != '') {

                $(".previsualizar").attr("src", respuesta['foto']);

            }

            
        }
    });

});