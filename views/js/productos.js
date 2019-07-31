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
$('#nuevoPrecioCompra').change(function (e) { 
    e.preventDefault();
    
    if ($('.porcentaje').prop('checked')) {
        var valorPorcentaje = $('.nuevoPorcentaje').val();

        // var porcentaje = Number($('#nuevoPrecioCompra').val() * valorPorcentaje / 100) + Number($('#nuevoPrecioCompra').val()); // NOTE: PORCENTAJE NORMAL

        var porcentaje = $('#nuevoPrecioCompra').val() / (1 - (valorPorcentaje / 100));

        $("#nuevoPrecioVenta").val(porcentaje.toFixed(2));
        // $("#nuevoPrecioVenta").val(porcentaje);

        $("#nuevoPrecioVenta").prop('readonly', true);

    }
});

/*==============================================================================================
CAMBIO DE PORCENTAJE
==============================================================================================*/
$('.nuevoPorcentaje').change(function (e) { 
    e.preventDefault();
    
    if ($('.porcentaje').prop('checked')) {
        var valorPorcentaje = $('.nuevoPorcentaje').val();

        // var porcentaje = Number($('#nuevoPrecioCompra').val() * valorPorcentaje / 100) + Number($('#nuevoPrecioCompra').val()); // NOTE: PORCENTAJE NORMAL

        var porcentaje = $('#nuevoPrecioCompra').val() / (1 - (valorPorcentaje / 100));

        $("#nuevoPrecioVenta").val(porcentaje.toFixed(2));
        // $("#nuevoPrecioVenta").val(porcentaje);

        $("#nuevoPrecioVenta").prop('readonly', true);

    }
});

/*==============================================================================================
ACTIVAR Y DESACTIVAR EL CHECK CON ICHECH
==============================================================================================*/

$('.porcentaje').on('ifUnchecked',function() {
    $("#nuevoPrecioVenta").prop('readonly', false);
});

$('.porcentaje').on('ifChecked',function() {
    $("#nuevoPrecioVenta").prop('readonly', true);
});