<?php

require_once "../controllers/productos.controlador.php";
require_once "../models/productos.modelo.php";

class TablaProductosVentas
{

  /*====================Comentario====================
    MOSTRAR LA TABLA DE PRODUCTOS
    ==================================================*/
  public function mostrarTablaProductosVentas()
  {

    $item = null;
    $valor = null;

    $productos = ControladorProductos::ctrMostrarProductos($item, $valor);

    $datosJson = '{
        "data": [';

    for ($i = 0; $i < count($productos); $i++) {

      /*====================Comentario====================
                TRAEMOS LA IMAGEN
                ==================================================*/
      $imagen = "<img src='" . $productos[$i]["imagen"] . "' width='40px'>";

    

      /*====================Comentario====================
                STOCK 
                ==================================================*/
      $stock_min = $productos[$i]["stock_min"];
      $stock_max = $productos[$i]["stock_max"];

      // if ($productos[$i]["stock"] <= 10 ) { //FIXME: CAMBIAR LAS CONDICIONALES TODO CON RESPECTO A LOS VALORES DE STOCK MAX Y STOCK MIN. 
      //     $stock = "<button class='btn btn-danger'>" . $productos[$i]["stock"] . "</button>";
      // }else if ($productos[$i]["stock"] >= 11 && $productos[$i]["stock"] <= 15){
      //     $stock = "<button class='btn btn-warning'>" . $productos[$i]["stock"] . "</button>";
      // }else{
      //     $stock = "<button class='btn btn-success'>" . $productos[$i]["stock"] . "</button>";
      // }

      if ($productos[$i]["stock"] <= $stock_min || $productos[$i]["stock"] <= 1) {
        $stock = "<button class='btn btn-danger'>" . $productos[$i]["stock"] . "</button>";
      } else if ($productos[$i]["stock"] <= floor(($stock_max + $stock_min) / 2) && $productos[$i]["stock"] > $stock_min) {
        $stock = "<button class='btn btn-warning'>" . $productos[$i]["stock"] . "</button>";
      } else {
        $stock = "<button class='btn btn-success'>" . $productos[$i]["stock"] . "</button>";
      }

      /*====================Comentario====================
                    TRAEMOS LAS ACCIONES
                ==================================================*/
      $botones = "<div class='btn-group'><button class='btn btn-primary agregarProducto recuperarBoton' idProducto='".$productos[$i]["id"]."'>Agregar</button></div>";

      /*====================Comentario====================
                TRAEMOS CADA UNO DE LOS REGISTROS DE LA BASE DE DATOS
                ==================================================*/
      $datosJson .= '
            [
                "' . ($i + 1) . '",
                "' . $imagen . '",
                "' . $productos[$i]["codigo"] . '",
                "' . $productos[$i]["descripcion"] . '",
                "' . $stock . '",
                "' . $botones . '"
                ],';
    }

    $datosJson = substr($datosJson, 0, -1);

    $datosJson .= ']
                }';

    echo $datosJson;
  }
}

/*====================Comentario====================
ACTIVAR TABLA DE PRODUCTOS
==================================================*/
$activarProductosVentas = new TablaProductosVentas();
$activarProductosVentas->mostrarTablaProductosVentas();
