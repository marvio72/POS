/*==============================================================================================
CARGAR LA TABLA DINÁMICA DE VENTAS
==============================================================================================*/

// $.ajax({
//     url: "ajax/datatable-ventas.ajax.php",
//     success: function(respuesta){

//         console.log(respuesta);

//     }
// });

$('.tablaVentas').DataTable({
  "ajax": "ajax/datatable-ventas.ajax.php",
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
AGREGAR PRODUCTO
==============================================================================================*/

$(".tablaVentas tbody").on("click", "button.agregarProducto", function(){

    var idProducto = $(this).attr("idProducto");

    $(this).removeClass("btn-primary agregarProducto");

    $(this).addClass("btn-default");

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

        var descripcion = respuesta["descripcion"];
        var stock = respuesta['stock'];
        var precio = respuesta['precio_venta'];

        if (stock == 0) {

          swal.fire({
            title: "No hay stock disponible",
            type: "error",
            confirmButtonText: "¡Cerrar"
          });

          $("button[idProducto='"+idProducto+"']").addClass("btn-primary agregarProducto");

          return;
          
        }
    
        $(".nuevoProducto").append(

                '<div class="row" style="padding:5px 15px">'+

                  '<!-- Descripción del producto -->'+

                  '<div class="col-xs-6" style="padding-right:0px">'+

                    '<div class="input-group">'+

                      '<span class="input-group-addon"><button class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProducto+'"><i class="fa fa-times"></i></button></span>'+

                      '<input type="text" class="form-control agregarProducto" name="agregarProducto" value="'+descripcion+'" required="required">'+

                    '</div>'+

                  '</div>'+

                  '<!-- Cantidad del Producto -->'+

                  '<div class="col-xs-3">'+

                    '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="'+stock+'" required="required">'+

                  '</div>'+

                  '<!-- Precio del producto -->'+

                  '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+

                    '<div class="input-group">'+

                      '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+

                      '<input type="text" class="form-control btn-numerico nuevoPrecioProducto" precioReal="'+precio+'" name="nuevoPrecioProducto" value="'+precio+'" readonly required>'+

                    '</div>'+

                  '</div>'+

                '</div>'
        );

        //SUMA TOTAL DE PRECIOS 

        sumarTotalPrecios();

        //AGREGAR IMPUESTO

        agregarImpuesto();

        //AGREGAR FORMATO AL PRECIO

        $(".nuevoPrecioProducto").number(true, 2);
        

      }
    });
});

/*==============================================================================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGHE EN ELLA
==============================================================================================*/

$(".tablaVentas").on("draw.dt", function(){

  if (localStorage.getItem("quitarProducto") != null) {
    
    var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));

    for (let i = 0; i < listaIdProductos.length; i++) {
      
      $("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").removeClass('btn-default');
      
      $("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").addClass('btn-primary agregarProducto');

    }
  }
});

/*==============================================================================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
==============================================================================================*/
var idQuitarProducto = [];

$(".formularioVenta").on("click", "button.quitarProducto", function () {

  $(this).parent().parent().parent().parent().remove();

  var idProducto = $(this).attr("idProducto");

  /*==============================================================================================
  ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
  ==============================================================================================*/

  if (localStorage.getItem("quitarProducto") == null) {
    
    idQuitarProducto = [];

  }else{

    idQuitarProducto.concat(localStorage.getItem("quitarProducto"));

  }

    idQuitarProducto.push({"idProducto":idProducto});

    localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));


  $("button.recuperarBoton[idProducto='"+idProducto+"']").removeClass('btn-default');
  
  $("button.recuperarBoton[idProducto='"+idProducto+"']").addClass('btn-primary agregarProducto');

  /*==============================================================================================
  SI NO HAY PRODUCTOS SELECCIONADOS PONEMOS TODOS LOS VALORES A CERO
  ==============================================================================================*/

  if ($(".nuevoProducto").children().length == 0) {
    
      $("#nuevoTotalVenta").val(0);
      $("#nuevoImpuestoVenta").val(16);
      $("#nuevoTotalVenta").attr("total",0);

  }else{
    
    //SUMA TOTAL DE PRECIOS
  
    sumarTotalPrecios();

    //AGREGAR IMPUESTO
    
    agregarImpuesto();

  }
});

/*==============================================================================================
AGREGANDO PRODUCTOS DESDE EL BOTÓN PARA DISPOSITIVOS MOVILES
==============================================================================================*/

var numProducto = 0;

$(".btnAgregarProducto").click(function(){

  numProducto++;
  var datos = new FormData();
  datos.append("traerProductos", "ok");

  $.ajax({
    url: "ajax/productos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta){
  
      $(".nuevoProducto").append(

        '<div class="row" style="padding:5px 15px">' +

        '<!-- Descripción del producto -->' +

        '<div class="col-xs-6" style="padding-right:0px">' +

        '<div class="input-group">' +

        '<span class="input-group-addon"><button class="btn btn-danger btn-xs quitarProducto" idProducto><i class="fa fa-times"></i></button></span>' +

        '<select class="form-control nuevaDescripcionProducto" id="producto'+numProducto+'" idProducto name="nuevaDescripcionProducto" required>' +

        '<option>Seleccione el producto</option>'+

        '</select>' +

        '</div>' +

        '</div>' +

        '<!-- Cantidad del Producto -->' +

        '<div class="col-xs-3 ingresoCantidad">' +

        '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock required="required">' +

        '</div>' +

        '<!-- Precio del producto -->' +

        '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">' +

        '<div class="input-group">' +

        '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +

        '<input type="text" class="form-control btn-numerico nuevoPrecioProducto" precioReal name="nuevoPrecioProducto" readonly required>' +

        '</div>' +

        '</div>' +

        '</div>'
      );

      //AGREGAR LOS PRODUCTOS AL SELECT

      respuesta.forEach(funcionForEach);
      
      function funcionForEach(item, index){

        if (item.stock != 0) {
          
          $("#producto"+numProducto).append(
  
            '<option idProducto="'+item.id+'" value="'+item.descripcion+'">'+item.descripcion+'</option>'

          );  

        }
        
        //SUMA TOTAL DE PRECIOS
  
        sumarTotalPrecios();

        //AGREGAR IMPUESTO
        
        agregarImpuesto();

        //AGREGAR FORMATO AL PRECIO

        $(".nuevoPrecioProducto").number(true, 2);

      }
  
    }
  });
  
});

/*==============================================================================================
SELECCIONAR PRODUCTO
==============================================================================================*/

$(".formularioVenta").on("change", "select.nuevaDescripcionProducto", function(){

  var nombreProducto = $(this).val();

  var nuevaCantidadProducto = $(this).parent().parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto");
  var nuevoPrecioProducto = $(this).parent().parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

  var datos = new FormData();
  datos.append("nombreProducto", nombreProducto);

  $.ajax({
    url: "ajax/productos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta){
  
      $(nuevaCantidadProducto).attr("stock", respuesta["stock"]);
      $(nuevoPrecioProducto).val(respuesta["precio_venta"]);
      $(nuevoPrecioProducto).attr("precioReal", respuesta["precio_venta"]);
  
    }
  });
  
});

/*==============================================================================================
MODIFICAR LA CANTIDAD
==============================================================================================*/

$(".formularioVenta").on("change", "input.nuevaCantidadProducto", function(){

  var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

  var precioFinal = $(this).val() * precio.attr("precioReal");

  precio.val(precioFinal);
  
  if (Number($(this).val()) > Number($(this).attr("stock"))) {

    /*==============================================================================================
    SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESA VALORES INICIALES
    ==============================================================================================*/

    $(this).val(1);

    precio.val(precio.attr("precioReal"));
    
    swal.fire({
      title: "La cantidad supera el Stock",
      text: "¡Sólo hay "+$(this).attr("stock")+" unidades!",
      type: "error",
      confirmButtonText: "¡Cerrar"
    });
  
  }

  //SUMA TOTAL DE PRECIOS

  sumarTotalPrecios();

  //AGREGAR IMPUESTO
        
  agregarImpuesto();

});

/*==============================================================================================
SUMAR TODOS LOS PRECIOS
==============================================================================================*/

function sumarTotalPrecios(){

  var precioItem = $(".nuevoPrecioProducto");
  var arraySumaPrecio = [];

  for (let i = 0; i < precioItem.length; i++) {
    
    arraySumaPrecio.push(Number($(precioItem[i]).val()));
    
  }

  function sumaArrayPrecios(total, numero){

      return total + numero;

  }

  var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);
  
  $("#nuevoTotalVenta").val(sumaTotalPrecio);
  $("#nuevoTotalVenta").attr("total", sumaTotalPrecio);
}

/*==============================================================================================
FUNCIÓN AGREGAR IMPUESTO
==============================================================================================*/

function agregarImpuesto(){

  var impuesto = Number($("#nuevoImpuestoVenta").val());
  var precioTotal = Number($("#nuevoTotalVenta").attr("total"));

  var precioImpuesto = precioTotal * impuesto / 100;

  var totalConImpuesto = precioTotal + precioImpuesto;

  $("#nuevoTotalVenta").val(totalConImpuesto);

  $("#nuevoPrecioImpuesto").val(precioImpuesto);

  $("#nuevoPrecioNeto").val(precioTotal);

}

/*==============================================================================================
CUANDO CAMBIA EL INPUESTO
==============================================================================================*/

$("#nuevoImpuestoVenta").change(function(){

  agregarImpuesto();

});

/*==============================================================================================
PONER FORMATO AL PRECIO FINAL
==============================================================================================*/

$("#nuevoTotalVenta").number(true, 2);

/*==============================================================================================
SELECCIONAR MÉTODO DE PAGO 
==============================================================================================*/

$("#nuevoMetodoPago").change(function(){

  var metodo = $(this).val();

  if (metodo == "Efectivo") {
    
    $(this).parent().parent().removeClass("col-xs-6");

    $(this).parent().parent().addClass("col-xs-4");

    $(this).parent().parent().parent().children(".cajasMetodoPago").html(

      '<div class="col-xs-4">' +
      
        '<div class="input-group">' + 
        
          '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +
          
          '<input type="text" class="form-control nuevoValorEfectivo" placeholder="000000" required="required">' +

        '</div>' +
      
      '</div>' +

      '<div class="col-xs-4 capturarCambioEfectivo" style="padding-left:0px">' +
      
        '<div class="input-group">' + 
        
          '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +
          
          '<input type="text" class="form-control nuevoCambioEfectivo" name="nuevoCambioEfectivo" placeholder="000000" readonly required">' +

        '</div>' +
      
      '</div>'
    );

    /*==============================================================================================
    AGREGAR FORMATO AL PRECIO 
    ==============================================================================================*/

    $(".nuevoValorEfectivo").number(true, 2);
    $(".nuevoCambioEfectivo").number(true, 2);

  } else {

    $(this).parent().parent().removeClass("col-xs-4");
    
    $(this).parent().parent().addClass("col-xs-6");
    
    $(this).parent().parent().parent().children(".cajasMetodoPago").html(

      '<div class="col-xs-6" style="padding-left:0px">' +

        '<div class="input-group">' +

          '<input type="text" class="form-control" id="nuevoCodigoTransaccion" name="nuevoCodigoTransaccion" placeholder="Código transacción" required="required">' +

          '<span class="input-group-addon"><i class="fa fa-lock"></i></span>' +

        '</div>' +

      '</div>'
       
    );
    
  }
});

/*==============================================================================================
CAMBIO EN EFECTIVO
==============================================================================================*/

$(".formularioVenta").on("change", "input.nuevoValorEfectivo", function(){

   var efectivo = $(this).val();

   var cambio = Number(efectivo) - Number($("#nuevoTotalVenta").val());

   var nuevoCambioEfectivo = $(this).parent().parent().parent().children(".capturarCambioEfectivo").children().children('.nuevoCambioEfectivo');

   nuevoCambioEfectivo.val(cambio);
  
});