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

                  '<div class="col-xs-3" style="padding-left:0px">'+

                    '<div class="input-group">'+

                      '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+

                      '<input type="number" min="1" class="form-control btn-numerico nuevoPrecioProducto" name="nuevoPrecioProducto" value="'+precio+'" readonly required>'+

                    '</div>'+

                  '</div>'+

                '</div>'
        )
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
  
});

/*==============================================================================================
AGREGANDO PRODUCTOS DESDE EL BOTÓN PARA DISPOSITIVOS MOVILES
==============================================================================================*/

$(".btnAgregarProducto").click(function(){

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

        '<select class="form-control nuevaDescripcionProducto idProducto" name="nuevaDescripcionProducto" required>' +

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

        '<input type="number" min="1" class="form-control btn-numerico nuevoPrecioProducto" name="nuevoPrecioProducto" value readonly required>' +

        '</div>' +

        '</div>' +

        '</div>'
      );

      //AGREGAR LOS PRODUCTOS AL SELECT

      respuesta.forEach(funcionForEach);
      
      function funcionForEach(item, index){

        $(".nuevaDescripcionProducto").append(

          '<option idProducto="'+item.id+'" value="'+item.descripcion+'">'+item.descripcion+'</option>'

        );
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
  
    }
  });
  
});
