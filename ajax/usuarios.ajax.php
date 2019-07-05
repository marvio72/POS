<?php 

require_once "../controllers/usuarios.controlador.php";
require_once "../models/usuarios.modelo.php";

class AjaxUsuarios{
    /*====================Comentario====================
    EDITAR USUARIO
    ==================================================*/

    public $idUsuario;

    public function ajaxEditarUsuario(){
        $item = "id";
        $valor = $this -> idUsuario;

        $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

        echo json_encode($respuesta);
    }
}

/*====================Comentario====================
EDITAR USUARIO
==================================================*/

if (isset($_POST['idUsuario'])) {
    
    $editar = new AjaxUsuarios();
    $editar -> idUsuario = $_POST['idUsuario'];
    $editar -> ajaxEditarUsuario();
}