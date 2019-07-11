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

    /*====================Comentario====================
    ACTIVAR USUARIO
    ==================================================*/

    public $activarUsuario;
    public $activarId;

    public function ajaxActivarUsuario(){

        $tabla = "usuarios";

        $item1 = "estado";
        $valor1 = $this->activarUsuario;

        $item2 = "id";
        $valor2 = $this->activarId;

        $respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);
    }
    /*====================Comentario====================
    VALIDAR NO REPETIR USUARIO
    ==================================================*/

    public $validarUsuario;

    public function ajaxValidarUsuario(){
        
        $item = "usuario";
        $valor = $this->validarUsuario;

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

/*====================Comentario====================
ACTIVAR USUARIO
==================================================*/
if (isset($_POST['activarUsuario'])) {
    $activarUsuario = new ajaxUsuarios();
    $activarUsuario -> activarUsuario = $_POST['activarUsuario'];
    $activarUsuario -> activarId = $_POST['activarId'];
    $activarUsuario -> ajaxActivarUsuario();
}

/*====================Comentario====================
VALIDAR USUARIO
==================================================*/
if(isset($_POST['validarUsuario'])){
    $validarUsuario = new ajaxUsuarios();
    $validarUsuario -> validarUsuario = $_POST['validarUsuario'];
    $validarUsuario -> ajaxValidarUsuario();
}