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

                      '<span class="input-group-addon" style="padding:0px"><button class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProducto+'"><i class="fa fa-times"></i></button></span>'+

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

                    '<input type="text" class="form-control btn-numerico nuevoPrecioProducto" precioReal="'+precio+'" name="nuevoPrecioProducto" value="'+precio+'" readonly required>'+
                    
                    '<span class="input-group-addon" style="padding:0px"><button class="btn btn-primary btn-xs agregarDescuento" idDescuento style="padding:0px;margin:0px"><i class="fa fa-arrow-circle-down" aria-hidden="true"></span>'+

                    '</div>'+

                  '</div>'+

                '</div>'
        );

        //SUMA TOTAL DE PRECIOS 

        sumarTotalPrecios();

        //AGREGAR IMPUESTO

        agregarImpuesto();

        //AGREGAR DESCUENTOS

        sumarTotalDescuentos();

        //AGREGAR FORMATO AL PRECIO

        $(".nuevoPrecioProducto").number(true, 2);

        //Con esto se restablece el select de metodo de pago por default
        metodoDePago().removeClass("col-xs-4");

        metodoDePago().addClass("col-xs-6");

        ocultarCampos();
        

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

  
  sumarTotalDescuentos();

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
    
      $("#nuevoSubTotal").val(0);
      $("#nuevoImpuestoVenta").val(16);
      $("#nuevoSubTotal").attr("total",0);
      $("#nuevoTotal").val(0);
      $("#nuevoTotalDescuento").val(0);
      $("#nuevoPrecioImpuesto").val(0);


  }else{
    
    //SUMA TOTAL DE PRECIOS
  
    sumarTotalPrecios();

    //AGREGAR IMPUESTO
    
    agregarImpuesto();

    //AGREGAR DESCUENTOS

    sumarTotalDescuentos();

  }

  //Con esto se restablece el select de metodo de pago  por default
  metodoDePago().removeClass("col-xs-4");

  metodoDePago().addClass("col-xs-6");

  ocultarCampos();
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

        '<span class="input-group-addon" style="padding:0px"><button class="btn btn-danger btn-xs quitarProducto" idProducto><i class="fa fa-times"></i></button></span>' +

        '<select class="form-control nuevaDescripcionProducto" id="producto'+numProducto+'" idProducto name="nuevaDescripcionProducto" required>' +

        '<option>Seleccione el producto</option>'+

        '</select>' +

        '</div>' +

        '</div>' +

        '<!-- Cantidad del Producto -->' +

        '<div class="col-xs-3 ingresoCantidad">' +

        '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock required>' +

        '</div>' +
        '<!-- Precio del producto -->' +

        '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">' +

        '<div class="input-group">' +

        '<input type="text" class="form-control btn-numerico nuevoPrecioProducto" precioReal name="nuevoPrecioProducto" readonly required>' +
        
        '<span class="input-group-addon" style="padding:0px"><button class="btn btn-primary btn-xs agregarDescuento" idDescuento style="padding:0px;margin:0px"><i class="fa fa-arrow-circle-down" aria-hidden="true"></span>' +

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
        
      }

      //SUMA TOTAL DE PRECIOS

      sumarTotalPrecios();

      //AGREGAR IMPUESTO
      
      agregarImpuesto();

      //AGREGAR DESCUENTOS

      sumarTotalDescuentos();

      //AGREGAR FORMATO AL PRECIO

      $(".nuevoPrecioProducto").number(true, 2);
  
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

      //SUMA TOTAL DE PRECIOS

      sumarTotalPrecios();

      //AGREGAR IMPUESTO

      agregarImpuesto();

      //AGREGAR DESCUENTOS

      sumarTotalDescuentos();

      //AGREGAR FORMATO AL PRECIO

      $(".nuevoPrecioProducto").number(true, 2);


        //Con esto se restablece el select de metodo de pago  por default
       metodoDePago().removeClass("col-xs-4");

       metodoDePago().addClass("col-xs-6");

       ocultarCampos();
      
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

  //AGREGAR DESCUENTOS

  sumarTotalDescuentos();

  //Con esto se restablece el select de metodo de pago por default
  metodoDePago().removeClass("col-xs-4");

  metodoDePago().addClass("col-xs-6");

  ocultarCampos();

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

  //SUBTOTAL
  var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);
  
  
  $("#nuevoSubTotal").val(sumaTotalPrecio);
  $("#nuevoSubTotal").attr("total", sumaTotalPrecio);
}
/*==============================================================================================
SUMAR TODOS LOS DESCUENTOS
==============================================================================================*/
function sumaArrayDescuento(total, numero) {
  return total + numero;
}

function sumarTotalDescuentos(){

  if ($(".nuevoDescuento").length > 0) {
    var descuentoItem = $(".nuevoDescuento");
    var arraySumaDescuento = [];
    var sumaTotalDescuento = 0;

    

      for (let i = 0; i < descuentoItem.length; i++) {
        arraySumaDescuento.push(Number($(descuentoItem[i]).val()));
      }
      
      sumaTotalDescuento = arraySumaDescuento.reduce(sumaArrayDescuento);
     
      $("#nuevoTotalDescuento").val(sumaTotalDescuento);
      $("#nuevoTotalDescuento").attr("descuento", sumaTotalDescuento);

    } else {
    
          $("#nuevoTotalDescuento").val(0);
          $("#nuevoTotalDescuento").attr("descuento", 0);
    } 
  
}

/*==============================================================================================
FUNCIÓN AGREGAR IMPUESTO, CALCULA TAMBIEN EL DESCUENTO Y EL TOTAL
==============================================================================================*/

function agregarImpuesto(){
  
  var descuento = Number($("#nuevoTotalDescuento").val());
  var total;

  var impuesto = Number($("#nuevoImpuestoVenta").val());
  var precioTotal = Number($("#nuevoSubTotal").attr("total"));

  

  var precioImpuesto = (precioTotal - descuento) * impuesto / 100;

  var totalConImpuesto = precioTotal + precioImpuesto;

  total =  precioTotal - descuento + precioImpuesto;
  
  $("#nuevoSubTotal").val(precioTotal);
  
  $("#nuevoPrecioImpuesto").val(precioImpuesto);
  
  $("#nuevoPrecioNeto").val(precioTotal);

  $("#nuevoTotal").val(total);

  
}

/*==============================================================================================
CUANDO CAMBIA EL IMPUESTO FUNCION QUE ESTA DESACTIVADA YA QUE EL IMPUESTO EN MÉXICO ES FIJO
==============================================================================================*/

// $("#nuevoImpuestoVenta").change(function(){

//   agregarImpuesto();

//   //Con esto se restablece el select de metodo de pago por default
//   metodoDePago().removeClass("col-xs-4");

//   metodoDePago().addClass("col-xs-6");

//   ocultarCampos();

// });

/*==============================================================================================
PONER FORMATO AL PRECIO FINAL, SUBTOTAL, DESCUENTO E IMPUESTO
==============================================================================================*/

$("#nuevoSubTotal").number(true, 2);
$("#nuevoTotalDescuento").number(true, 2);
$("#nuevoPrecioImpuesto").number(true, 2);
$("#nuevoTotal").number(true, 2);

/*==============================================================================================
SELECCIONAR MÉTODO DE PAGO 
==============================================================================================*/

$("#nuevoMetodoPago").change(function(){

  var metodo = $(this).val();

  if (metodo == "Efectivo") {
    
    $(this).parent().parent().removeClass("col-xs-6");

    $(this).parent().parent().addClass("col-xs-4");

    $(this).parent().parent().parent().children(".cajasMetodoPago").html(

      '<div class="col-xs-4 ingresarEfectivo">' +
      
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

  } else if (metodo == ""){

    //Con esto se restablece el select de metodo de pago por default
    metodoDePago().removeClass("col-xs-4");

    metodoDePago().addClass("col-xs-6");

    ocultarCampos();


  }else {

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

$(".formularioVenta").on("change", "input.nuevoValorEfectivo", function(){ //TODO VALIDAR QUE LA CANTIDAD QUE SE PAGUE SEA MAYOR QUE LA CONTIDAD TOTAL NETA

   var efectivo = Number($(this).val());
   var totalVenta = Number($("#nuevoTotal").val());

   //Validar que efectivo sea mayour que el total

  if (efectivo >= totalVenta) {

    var cambio = efectivo - totalVenta;

    var nuevoCambioEfectivo = $(this).parent().parent().parent().children(".capturarCambioEfectivo").children().children('.nuevoCambioEfectivo');

    nuevoCambioEfectivo.val(cambio);
     
  } else {

    var valorEfectivo = $(this).parent().parent().parent().children(".ingresarEfectivo").children().children(".nuevoValorEfectivo");
    valorEfectivo.val(0);
    valorEfectivo.focus();

    swal.fire({
      title: "El efectivo debe ser mayor o igual al Total",
      type: "error",
      confirmButtonText: "¡Cerrar"
    });

  }
  
});

/*==============================================================================================
FUNCION PARA OCULTAR LOS CAMPOS DE METODO DE PAGO
==============================================================================================*/
function ocultarCampos(){

  $("#nuevoMetodoPago").val("");
  $(".nuevoValorEfectivo").val("000000");
  $(".nuevoCambioEfectivo").val("000000");

  var oculta = $("#nuevoMetodoPago").parent().parent().parent().children(".cajasMetodoPago").html(

      '<div class="col-xs-6" style="padding-left:0px">' +

      '<div class="input-group">' +

      '</div>' +

      '</div>');

      return oculta;

}

/*==============================================================================================
FUNCION PARA REALIZAR CAMBIOS EN LAS COLUMNAS DE METODO DE PAGO
==============================================================================================*/
//En esta funcion hay que añadirle la clase que se va a sustituir.
function metodoDePago(){

  var metodoPago = $("#nuevoMetodoPago").parent().parent();

  return metodoPago;

}

/*==============================================================================================
AGREGAR DESCUENTO EN CADA PRODUCTO // 
==============================================================================================*/

$(".formularioVenta").on("click", "button.agregarDescuento", function () {

  var btnDescuento = $(this);


  btnDescuento.removeClass("btn-primary agregarDescuento");
  btnDescuento.addClass("btn-danger eliminarDescuento");

 

  btnDescuento.parent().parent().parent().before().append(
    '<!-- Descuento del producto -->' +

    '<div class="col-sx-3 ingresoDescuento" style="padding-left:0px">' +

        '<div class="input-group">' +

        '<span class="input-group-addon" style="padding:0px"><i class="fa fa-usd" aria-hidden="true" style="padding:0px"></i></span>' +

        '<input type="number" min="1" class="form-control nuevoDescuento" descuentoReal name="nuevoDescuento" placeholder="Descuento" required>' +
        
        '</div>' +

        '</div>'   

  );

  ocultarCampos();

});

/*==============================================================================================
BORRAR CAMPO DE DESCUENTO
==============================================================================================*/
$(".formularioVenta").on("click", "button.eliminarDescuento", function () {
 

  var btnEliminar = $(this);
  
  btnEliminar.parent().parent().parent().children('.ingresoDescuento').remove();

  btnEliminar.removeClass("btn-danger eliminarDescuento");
  btnEliminar.addClass("btn-primary agregarDescuento");

  sumarTotalDescuentos();

  agregarImpuesto();

  ocultarCampos();
});

/*==============================================================================================
CUANDO CAMBIA EL DESCUENTO
==============================================================================================*/

$(".formularioVenta").on("blur", "input.nuevoDescuento", function () {
  
  sumarTotalDescuentos();
  agregarImpuesto();
  ocultarCampos();
  
});

$(".formularioVenta").on("change", "input.nuevoDescuento", function () {
  
  sumarTotalDescuentos();
  agregarImpuesto();
  ocultarCampos();

});