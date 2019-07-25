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
}
 