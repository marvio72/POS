/*==============================================================================================
CARGAR LA TABLA DINÁMICA DE PRODUCTOS
==============================================================================================*/

// $.ajax({
//     url: "ajax/datatable-productos.ajax.php",
//     success: function(respuesta){

//         console.log(respuesta);

//     }
// });

$('.tablaProductos').DataTable({
    "ajax": "ajax/datatable-productos.ajax.php",
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    "language": {

        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }

    }
});

/*==============================================================================================
CAPTURANDO LA CATEGORIA PARA ASIGNAR CÓDIGO
==============================================================================================*/
$('#nuevaCategoria').change(function (e) { 
    e.preventDefault();
    var idCategoria = $(this).val();

    var datos = new FormData();
    datos.append("idCategoria", idCategoria);

    $.ajax({
        url: "ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){

            var nuevoCodigo;

            if (!respuesta) {
                
                nuevoCodigo = idCategoria+"01"; // NOTE: SE PUEDE AGREGAR UNA CONSTANTE PARA DETERMINAR LA CANTIDAD DE NUMEROS EN CADA CODIGO.
                $("#nuevoCodigo").val(nuevoCodigo);

            }else{
                nuevoCodigo = Number(respuesta['codigo']) + 1;
                $("#nuevoCodigo").val(nuevoCodigo);
            }      
        }
    });
    
});

/*==============================================================================================
AGREGANDO PRECIO DE VENTA
==============================================================================================*/
$('#nuevoPrecioCompra, #editarPrecioCompra').change(function (e) { 
    e.preventDefault();
    
    if ($('.porcentaje').prop('checked')) {
        var valorPorcentaje = $('.nuevoPorcentaje').val();

        // var porcentaje = Number($('#nuevoPrecioCompra').val() * valorPorcentaje / 100) + Number($('#nuevoPrecioCompra').val()); // NOTE: PORCENTAJE NORMAL

        var porcentaje = $('#nuevoPrecioCompra').val() / (1 - (valorPorcentaje / 100));
        var editarPorcentaje = $('#editarPrecioCompra').val() / (1 - (valorPorcentaje / 100));

        $("#nuevoPrecioVenta").val(porcentaje.toFixed(2));
        // $("#nuevoPrecioVenta").val(porcentaje);
        $("#nuevoPrecioVenta").prop('readonly', true);
        
        $("#editarPrecioVenta").val(editarPorcentaje.toFixed(2));
        $("#editarPrecioVenta").prop('readonly', true);

    }
});

/*==============================================================================================
CAMBIO DE PORCENTAJE
==============================================================================================*/
$('.nuevoPorcentaje').change(function (e) { 
    e.preventDefault();
    
    if ($('.porcentaje').prop('checked')) {

        var valorPorcentaje = $(this).val();

        // var porcentaje = Number($('#nuevoPrecioCompra').val() * valorPorcentaje / 100) + Number($('#nuevoPrecioCompra').val()); // NOTE: PORCENTAJE NORMAL

        var porcentaje = $('#nuevoPrecioCompra').val() / (1 - (valorPorcentaje / 100));
        var editarPorcentaje = $('#editarPrecioCompra').val() / (1 - (valorPorcentaje / 100));

        $("#nuevoPrecioVenta").val(porcentaje.toFixed(2));
        // $("#nuevoPrecioVenta").val(porcentaje);
        $("#nuevoPrecioVenta").prop('readonly', true);
        
        $("#editarPrecioVenta").val(editarPorcentaje.toFixed(2));
        // $("#editarPrecioVenta").val(porcentaje);
        $("#editarPrecioVenta").prop('readonly', true);
    }
});

/*==============================================================================================
STOCK MIN MENOR QUE ESTOCK MAX
==============================================================================================*/
$("#nuevoStockMin, #editarStockMin, #nuevoStockMax, #editarStockMax").change(function (e) {
    e.preventDefault();

    $(".alert").remove();

    var nStockMax   = $("#nuevoStockMax").val();
    var maxStock    = $(this).parent().parent().parent().children(".maxStock").children().children("input.stockMax");
    var nStockMin   = $("#nuevoStockMin").val();
    var stMin       = $('#nuevoStockMin');
    var nStockError = $('.stockError');
    
    var eStockMax   = $("#editarStockMax").val();
    var eStockMin   = $("#editarStockMin").val();
    var estMin      = $('#editarStockMin');

    
    
        
    if (parseInt(nStockMin) >= parseInt(nStockMax) || nStockMax < 0 || nStockMin < 0) {

        nStockError.parent().after('<div class="alert alert-warning">El Stock Min debe ser menor que Stock Max y los números no deben ser negativos</div>');
    
        maxStock.val('');

        maxStock.focus();

        stMin.val('');

    }    
    
    
    if (parseInt(eStockMin) >= parseInt(eStockMax) || eStockMax < 0 || eStockMin < 0) {

        nStockError.parent().after('<div class="alert alert-warning">El Stock Min debe ser menor que Stock Max y los números no deben ser negativos</div>');

        maxStock.focus();

    }

    
});

/*==============================================================================================
ACTIVAR Y DESACTIVAR EL CHECK CON ICHECH
==============================================================================================*/

$('.porcentaje').on('ifUnchecked',function() {
    $("#nuevoPrecioVenta").prop('readonly', false);
    $("#editarPrecioVenta").prop('readonly', false);
});

$('.porcentaje').on('ifChecked',function() {
    $("#nuevoPrecioVenta").prop('readonly', true);
    $("#editarPrecioVenta").prop('readonly', true);
});

/*==============================================================================================
SUBIENDO LA FOTO DEL PRODUCTO
==============================================================================================*/

$(".nuevaImagen").change(function () {

    var imagen = this.files[0];
    // console.log(imagen);

    /*==============================================================================================
    VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
    ==============================================================================================*/

    if (imagen['type'] != "image/jpeg" && imagen['type'] != "image/png") {

        $(".nuevaImagen").val("");

        swal.fire({
            title: "Error al subir la imagen",
            text: "¡La imagen debe estar en formato JPG o PNG",
            type: "error",
            confirmButtonText: "¡Cerrar!"
        });
    } else if (imagen['size'] > 2000000) {

        $(".nuevaImagen").val("");

        swal.fire({
            title: "Error al subir la imagen",
            text: "¡La imagen no debe superar los 2 MB",
            type: "error",
            confirmButtonText: "¡Cerrar!"
        });
    } else {

        var datosImagen = new FileReader();
        datosImagen.readAsDataURL(imagen);

        $(datosImagen).on("load", function (event) {

            var rutaImagen = event.target.result;

            $(".previsualizar").attr("src", rutaImagen);
        });
    }
});

/*==============================================================================================
EDITAR PRODUCTO
==============================================================================================*/
$(".tablaProductos tbody").on("click", "button.btnEditarProducto", function(){

    var idProducto = $(this).attr("idProducto");
    
    var datos = new FormData();
    datos.append("idProducto", idProducto);

    $.ajax({
        url: "ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){

            datosCategoria = new FormData();
            datosCategoria.append("idCategoria", respuesta["id_categoria"]);

            $.ajax({
                url: "ajax/categorias.ajax.php",
                method: "POST",
                data: datosCategoria,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){

                    $("#editarCategoria").val(respuesta["id"]);
                    $("#editarCategoria").html(respuesta["categoria"]);
                }   
            });
            
            $("#editarCodigo").val(respuesta["codigo"]);
            $("#editarDescripcion").val(respuesta["descripcion"]);
            $("#editarStock").val(respuesta["stock"]);
            $("#editarStockMax").val(respuesta["stock_max"]);
            $("#editarStockMin").val(respuesta["stock_min"]);
            $("#editarPrecioCompra").val(respuesta["precio_compra"]);
            $("#editarPrecioVenta").val(respuesta["precio_venta"]);

            if (respuesta["imagen"] != "") {
                $("#imagenActual").val(respuesta["imagen"]);
                $(".previsualizar").attr("src", respuesta["imagen"]);
            }
    
        }
    });
    
});

/*==============================================================================================
ELIMINAR PRODUCTO
==============================================================================================*/
$(".tablaProductos tbody").on("click", "button.btnEliminarProducto", function () {

    var idProducto = $(this).attr("idProducto");
    
    var codigo = $(this).attr("codigo");
    
    var imagen = $(this).attr("imagen");
    
    swal.fire({

        title: '¿Está seguro de borrar el producto?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar producto!'
    }).then(function (result) {
        if (result.value) {

            window.location = "index.php?ruta=productos&idProducto=" + idProducto + "&imagen=" + imagen + "&codigo=" + codigo;

        }


    });
});

