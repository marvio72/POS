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

/*==============================================================================================
ACTIVAR USUARIO
==============================================================================================*/

$(".tablas").on("click",".btnActivar",function(){
    var este = $(this);

    var idUsuario = este.attr("idUsuario");
    var estadoUsuario = este.attr("estadoUsuario");

    var datos = new FormData();
    datos.append("activarId", idUsuario);
    datos.append("activarUsuario", estadoUsuario);

    $.ajax({
        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
            console.log(respuesta);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
        }
    });


    if (estadoUsuario == 0) {

        este.removeClass('btn-success');
        este.addClass('btn-danger');
        este.html('Desactivado');
        este.attr('estadoUsuario', 1);
    } else {

        este.removeClass('btn-danger');
        este.addClass('btn-success');
        este.html('Activado');
        este.attr('estadoUsuario', 0);
    }
}); 
    
/*==============================================================================================
REVISAR SI EL USUARIO YA ESTA REGISTRADO
==============================================================================================*/

$("#nuevoUsuario").change(function() {
    
    $(".alert").remove();

    var usuario = $(this).val();

    var datos = new FormData();

    datos.append("validarUsuario", usuario);

    $.ajax({
      url: "ajax/usuarios.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(respuesta) {

        var nuevoUsuario = $("#nuevoUsuario");

        if(respuesta){
             nuevoUsuario.parent().after('<div class="alert alert-warning">Este usuario ya existe en la base de datos</div>');

             nuevoUsuario.val("");
        }
       
      }

    });
});

/*==============================================================================================
LIMPIA EL FORMULARIO DE INGRESO DE USUARIOS EN EL MODAL
==============================================================================================*/

$("#modalAgregarUsuario").on("hidden.bs.modal", function(){

    $(this).find('form')[0].reset();

    $(".alert").remove();
});

/*==============================================================================================
FUNCION PARA EVITAR DAR DE ALTA UN USUARIO AL PRESIONAR ENTER EN EL FORMULARIO DE INGRESO
DE USUARIOS
==============================================================================================*/

function submit(){
    var tecla = (document.all) ? e.keyCode :e.which;
    
    return (tecla!=13);
}