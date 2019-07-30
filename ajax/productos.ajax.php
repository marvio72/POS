<?php 

require_once "../controllers/productos.controlador.php";
require_once "../models/productos.modelo.php";

class AjaxProductos{

    /*====================Comentario====================
    GENERAR CÓDIGO A PARTIR DE ID CATEGORIA
    ==================================================*/
    public $idCategoria;

    public function ajaxCrearCodigoProducto(){

        $item = "id_categoria";
        $valor = $this->idCategoria;

        $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);

        echo json_encode($respuesta);

    }
}

/*====================Comentario====================
GENERAR CÓDIGO A PARTIR DE ID CATEGORIA
==================================================*/
if (isset($_POST['idCategoria'])) {
    
    $codigoProducto = new AjaxProductos();
    $codigoProducto -> idCategoria = $_POST['idCategoria'];
    $codigoProducto -> ajaxCrearCodigoProducto();
}