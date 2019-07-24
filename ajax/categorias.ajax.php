<?php 

    require_once "../controllers/categorias.controlador.php";
    require_once "../models/categorias.modelo.php";

    class AjaxCategorias{

        /*====================Comentario====================
        EDITAR CATEGORIA
        ==================================================*/

        public $idCategoria;

        public function ajaxEditarCategoria(){

            $item = "id";
            $valor = $this->idCategoria;

            $respuesta = ControladorCategorias::ctrMostrarCategorias($item, $valor);

            echo json_encode($respuesta);
        }

        /*====================Comentario====================
        VALIDAR NO REPETIR CATEGORIA
        ==================================================*/

        public $validarCategoria;

        public function ajaxValidarCategoria()
        {

            $item = "categoria";
            $valor = $this->validarCategoria;

            $respuesta = ControladorCategorias::ctrMostrarCategorias($item, $valor);

            echo json_encode($respuesta);
        }
    }


    /*====================Comentario====================
    EDITAR CATEGORIA
    ==================================================*/
    if (isset($_POST['idCategoria'])) {
        
        $categoria = new AjaxCategorias();
        $categoria -> idCategoria = $_POST['idCategoria'];
        $categoria -> ajaxEditarCategoria();

    }

    /*====================Comentario====================
    VALIDAR USUARIO
    ==================================================*/
    if (isset($_POST['validarCategoria'])) {
        $validarCategoria = new AjaxCategorias();
        $validarCategoria->validarCategoria = $_POST['validarCategoria'];
        $validarCategoria->ajaxValidarCategoria();
    }