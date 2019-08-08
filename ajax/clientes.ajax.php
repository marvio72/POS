<?php 

require_once "../controllers/clientes.controlador.php";
require_once "../models/clientes.modelo.php";

class AjaxClientes{

    /*====================Comentario====================
    EDITAR CLIENTE
    ==================================================*/
    public $idCliente;

    public function AjaxEditarCliente(){

        $item  = "id";
        $valor = $this->idCliente;

        $respuesta = ControladorClientes::crtMostrarClientes($item,$valor);

        echo json_encode($respuesta);
    }

}

/*====================Comentario====================
EDITAR CLIENTE
==================================================*/
if (isset($_POST['idCliente'])) {
    $cliente = new AjaxClientes();
    $cliente->idCliente = $_POST['idCliente'];
    $cliente->AjaxEditarCliente();
}