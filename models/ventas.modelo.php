<?php 

class ModeloVentas{

  /*====================Comentario====================
  MOSTRAR VENTAS
  ==================================================*/
  public static function mdlMostrarVentas($tabla, $item, $valor){

    if ($item != null) {
      
      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY fecha DESC");

      $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

      $stmt->execute();

      return $stmt->fetch();

    }else{

      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY fecha DESC");

      $stmt->execute();

      return $stmt->fetchAll();
    }

    $stmt->close();

    $stmt = null;
  }
}