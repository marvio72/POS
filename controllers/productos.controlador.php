<?php 
 
class ControladorProductos{

    /*====================Comentario====================
    MOSTRAR PRODUCTOS
    ==================================================*/

    public static function ctrMostrarProductos($item, $valor){

        $tabla = "productos";

        $respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor);

        return $respuesta;
    }

    /*====================Comentario====================
    CREAR PRODUCTOS
    ==================================================*/

    public static function ctrCrearProducto(){

        if (isset($_POST['nuevaDescripcion'])) {
            
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaDescripcion"]) &&
               preg_match('/^[0-9]+$/', $_POST["nuevoStock"]) &&
               preg_match('/^[0-9.]+$/', $_POST["nuevoPrecioCompra"]) &&
               preg_match('/^[0-9.]+$/', $_POST["nuevoPrecioVenta"])){

                $ruta = "views/img/productos/default/anonymous.png";

                $tabla = "productos";
                $datos = array("id_categoria"  => $_POST['nuevaCategoria'],
                               "codigo"        => $_POST['nuevoCodigo'],
                               "descripcion"   => $_POST['nuevaDescripcion'],
                               "stock"         => $_POST['nuevoStock'],
                               "precio_compra" => $_POST['nuevoPrecioCompra'],
                               "precio_venta"  => $_POST['nuevoPrecioVenta'],
                               "imagen"        => $ruta
               );

                $respuesta = ModeloProductos::mdlIngresarProducto($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '<script>
                        Swal.fire({
                            type: "success",
                            title: "¡El producto ha sido añadido correctamente!",
                            showConfirmButton: true,
                            confirButtonText: "Cerrar"
                            }).then(function(result){
                                if (result.value) {
                                    window.location = "productos";
                                }    
                        })
                    </script>';
                }

            }else{
            echo '<script>
                Swal.fire({
                    type: "error",
                    title: "¡El producto no puede ir vacío o llevar caracteres especiales!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if (result.value) {
                            window.location = "productos";
                        }    
                    })
            </script>';
            }

        }

    }
}
 