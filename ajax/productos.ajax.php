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
    /*====================Comentario====================
    EDITAR PRODUCTO
    ==================================================*/
    public $idProducto;
    public $traerProductos;
    public $nombreProducto;

    public function ajaxEditarProducto(){

        

        if ($this->traerProductos == "ok") {

            $item = null;
            $valor = null;

            $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);

            echo json_encode($respuesta);
        
        }else if($this->nombreProducto != ""){

            $item = "descripcion";
            $valor = $this->nombreProducto;

            $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);

            echo json_encode($respuesta);
            
        }else{

            $item = "id";
            $valor = $this->idProducto;

            $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);

            echo json_encode($respuesta);

        }

        
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

/*====================Comentario====================
EDITAR PRODUCTO
==================================================*/
if (isset($_POST['idProducto'])) {
    $editarProducto = new AjaxProductos();
    $editarProducto -> idProducto = $_POST['idProducto'];
    $editarProducto -> ajaxEditarProducto();
}

/*====================Comentario====================
TRAER PRODUCTO
==================================================*/
if (isset($_POST['traerProductos'])) {
    $traerProductos = new AjaxProductos();
    $traerProductos -> traerProductos = $_POST['traerProductos'];
    $traerProductos -> ajaxEditarProducto();

}

/*====================Comentario====================
TRAER POR NOMBRE DEL PRODUCTO
==================================================*/
if (isset($_POST['nombreProducto'])) {
    $nombreProducto = new AjaxProductos();
    $nombreProducto -> nombreProducto = $_POST['nombreProducto'];
    $nombreProducto -> ajaxEditarProducto();
}