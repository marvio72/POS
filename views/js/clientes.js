/*==============================================================================================
EDITAR CLIENTES
==============================================================================================*/
$(".tablas").on("click", ".btnEditarCliente", function () {
    
    var idCliente = $(this).attr("idCliente");

    var datos = new FormData();
    datos.append("idCliente", idCliente);

    $.ajax({
        url: "ajax/clientes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
 
            $("#idCliente").val(respuesta['id']);
            $("#editarCliente").val(respuesta['nombre']);
            $("#editarRfc").val(respuesta['rfc']);
            $("#editarEmail").val(respuesta['email']);
            $("#editarTelefono").val(respuesta['telefono']);
            $("#editarDireccion").val(respuesta['direccion']);
            $("#editarFechaNacimiento").val(respuesta['fecha_nacimiento']);
    
        }
    });
    
});

/*==============================================================================================
BORRAR CLIENTE
==============================================================================================*/
$(".tablas").on("click", ".btnEliminarCliente", function() {

    var idCliente = $(this).attr("idCliente");

    Swal.fire({
        title: '¿Está seguro de borrar el Cliente?',
        text: '¡Si no lo está puede cancelar la acción!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Si, borrar cliente!'
    }).then(function (result) {
        if (result.value) {

            window.location = "index.php?ruta=clientes&idCliente=" + idCliente;
        }
    });
});

/*==============================================================================================
VALIDAR SI EL RFC DEL CLIENTE YA EXISTE
==============================================================================================*/

$("#nuevoRfc").change(function () {

    $(".alert").remove();

    var cliente = $(this).val();
    cliente = cliente.toUpperCase();

    var datos = new FormData();

    datos.append("validarCliente", cliente);

    $.ajax({
        url: "ajax/clientes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            var nuevoCliente = $("#nuevoRfc");

            if (respuesta) {
                nuevoCliente.parent().after('<div class="alert alert-warning">Este RFC ya existe en la base de datos</div>');

                nuevoCliente.val("");

                nuevoCliente.focus();
            }

        }

    });
});

/*==============================================================================================
LIMPIA EL FORMULARIO DE INGRESO DE USUARIOS EN EL MODAL
==============================================================================================*/

$("#modalAgregarCliente").on("hidden.bs.modal", function () {

    $(this).find('form')[0].reset();

    $(".alert").remove();
});