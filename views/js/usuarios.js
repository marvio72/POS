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