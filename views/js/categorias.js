    /*==============================================================================================
    EDITAR CATEGORIA
    ==============================================================================================*/
    $(".tablas").on("click", ".btnEditarCategoria" ,function() {
        
        var idCategoria = $(this).attr("idCategoria");

        var datos = new FormData();
        datos.append("idCategoria", idCategoria);

        $.ajax({
            url: "ajax/categorias.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuesta) {

                $("#editarCategoria").val(respuesta["categoria"]);
                $("#idCategoria").val(respuesta["id"]);


            }
        });
    });

    /*==============================================================================================
    ELIMINAR CATEGORIA
    ==============================================================================================*/
    $(".tablas").on("click", ".btnEliminarCategoria", function(){

        var idCategoria = $(this).attr("idCategoria");

        Swal.fire({
            title: '¿Está seguro de borrar la Categoría?',
            text: '¡Si no lo está puede cancelar la acción!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: '¡Si, borrar categoría!'
        }).then(function (result) {
            if (result.value) {

                window.location = "index.php?ruta=categorias&idCategoria=" + idCategoria;
            }
        });
    });

    /*==============================================================================================
    VALIDAR SI LA CATEGORIA YA EXISTE
    ==============================================================================================*/

    $("#nuevaCategoria").change(function(){

        $(".alert").remove();

        var categoria = $(this).val();

        var datos = new FormData();

        datos.append("validarCategoria", categoria);
      
        $.ajax({
            url: "ajax/categorias.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuesta) {

                var nuevaCategoria = $("#nuevaCategoria");


                if (respuesta) {
                    nuevaCategoria.parent().after('<div class="alert alert-warning">Esta categoria ya existe en la base de datos</div>');

                    nuevaCategoria.val("");

                    nuevaCategoria.focus();
                }

            },
            error: function (respuesta) {
                console.log("Hubo un error");
            }

        });
    });

    /*==============================================================================================
    LIMPIA EL FORMULARIO DE INGRESO DE CATEGORIAS EN EL MODAL
    ==============================================================================================*/

    $("#modalAgregarCategoria").on("hidden.bs.modal", function () {

        $(this).find('form')[0].reset();

        $(".alert").remove();
    });

 