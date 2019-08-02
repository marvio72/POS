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

                /*====================Comentario====================
                VALIDAR IMAGEN
                ==================================================*/
                $ruta = "views/img/productos/default/anonymous.png";

                if (isset($_FILES['nuevaImagen']['tmp_name'])) {

                    list($ancho, $alto) = getimagesize($_FILES['nuevaImagen']['tmp_name']);

                    $nuevoAncho = 500;
                    $nuevoAlto = 500;

                    /*====================Comentario====================
                    CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
                    ==================================================*/

                    $directorio = "views/img/productos/" . $_POST['nuevoCodigo'];

                    mkdir($directorio, 0755);

                    /*====================Comentario====================
                    DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES OR DEFECTO DE PHP
                    ==================================================*/

                    if ($_FILES['nuevaImagen']['type'] == "image/jpeg") {

                        /*====================Comentario====================
                        GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                        ==================================================*/

                        $aleatorio = mt_rand(100, 999);

                        $ruta = "views/img/productos/" . $_POST['nuevoCodigo'] . '/' . $aleatorio . '.jpg';

                        $origen = imagecreatefromjpeg($_FILES["nuevaImagen"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresampled($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $ruta);
                    }

                    if ($_FILES['nuevaImagen']['type'] == "image/png") {

                        /*====================Comentario====================
                        GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                        ==================================================*/

                        $aleatorio = mt_rand(100, 999);

                        $ruta = "views/img/productos/" . $_POST['nuevoCodigo'] . '/' . $aleatorio . '.png';

                        $origen = imagecreatefrompng($_FILES["nuevaImagen"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresampled($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $ruta);
                    }
                }

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
 