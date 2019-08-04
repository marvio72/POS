<?php 

require_once "../controllers/productos.controlador.php";
require_once "../models/productos.modelo.php";

require_once "../controllers/categorias.controlador.php";
require_once "../models/categorias.modelo.php";

class TablaProductos{

    /*====================Comentario====================
    MOSTRAR LA TABLA DE PRODUCTOS
    ==================================================*/
    public function mostrarTablaProductos(){

        $item = null;
        $valor = null;

        $productos = ControladorProductos::ctrMostrarProductos($item, $valor);

        $datosJson = '{
        "data": [';

            for ($i=0; $i < count($productos); $i++) {

                /*====================Comentario====================
                TRAEMOS LA IMAGEN
                ==================================================*/
                $imagen = "<img src='".$productos[$i]["imagen"]."' width='40px'>";

                /*====================Comentario====================
                TRAEMOS LA CATEGORIA
                ==================================================*/
                $item = "id";
                $valor = $productos[$i]["id_categoria"];

                $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                /*====================Comentario====================
                STOCK 
                ==================================================*/

                if ($productos[$i]["stock"] <= 10 ) {
                    $stock = "<button class='btn btn-danger'>" . $productos[$i]["stock"] . "</button>";
                }else if ($productos[$i]["stock"] >= 11 && $productos[$i]["stock"] <= 15){
                    $stock = "<button class='btn btn-warning'>" . $productos[$i]["stock"] . "</button>";
                }else{
                    $stock = "<button class='btn btn-success'>" . $productos[$i]["stock"] . "</button>";
                }

                

                /*====================Comentario====================
                    TRAEMOS LAS ACCIONES
                ==================================================*/
                $botones = "<div class='bt-group'><button class='btn btn-warning btnEditarProducto' idProducto='".$productos[$i]["id"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarProducto' idProducto='".$productos[$i]["id"]."' codigo='".$productos[$i]["codigo"]."' imagen='".$productos[$i]["imagen"]."'><i class='fa fa-times'></i></button></div>";

                /*====================Comentario====================
                TRAEMOS CADA UNO DE LOS REGISTROS DE LA BASE DE DATOS
                ==================================================*/
                $datosJson .= '
            [
                "'.($i+1).'",
                "'.$imagen.'",
                "'.$productos[$i]["codigo"].'",
                "'.$productos[$i]["descripcion"].'",
                "'.$categorias["categoria"].'",
                "'.$stock.'",
                "'.$productos[$i]["precio_compra"].'", 
                "'.$productos[$i]["precio_venta"].'",
                "'.$productos[$i]["fecha"].'",
                "'.$botones.'"
                ],';
            }

            $datosJson = substr($datosJson,0,-1);  

            $datosJson .= ']
                }';

            echo $datosJson;

            

    }
}

/*====================Comentario====================
ACTIVAR TABLA DE PRODUCTOS
==================================================*/
$activarProductos = new TablaProductos();
$activarProductos -> mostrarTablaProductos();