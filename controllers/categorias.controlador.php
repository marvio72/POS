<?php 
 
class ControladorCategorias{

    /*====================Comentario====================
    CREAR CATEGORIAS
    ==================================================*/
    public static function ctrCrearCategoria(){

        if (isset($_POST['nuevaCategoria'])) {
            
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaCategoria"] )) {

                /*====================Comentario====================
                VALIDAR SI EXITE LA CATEGORIA
                ==================================================*/
                $item = "categoria";
                $valor = $_POST['nuevaCategoria'];
                $tabla = "categorias";

                $validar = ModeloCategorias::mdlMostrarCategorias($tabla, $item, $valor);


                if ($validar['categoria'] == $_POST['nuevaCategoria']) {
                    $datos = [];
                    echo '<script>
                    

					swal.fire({

						type: "error",
						title: "¡La categoria ya existe en la base de datos!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "categorias";

						}

					});
				    </script>';
                    die();
                };

                /*====================Comentario====================
                FIN DE LA VALIDACION DE CATEGORIA EXISTENTE
                ==================================================*/

                $tabla = "categorias";

                $datos = $_POST['nuevaCategoria'];

                $respuesta = ModeloCategorias::mdlIngresarCategoria($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '<script>
                        Swal.fire({
                            type: "success",
                            title: "¡La categoría ha sido guardada correctamente!",
                            showConfirmButton: true,
                            confirButtonText: "Cerrar"
                            }).then(function(result){
                                if (result.value) {
                                    window.location = "categorias";
                                }    
                        })
                    </script>';
                }
                
            }else{
                echo '<script>
                    Swal.fire({
                        type: "error",
                        title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if (result.value) {
                                window.location = "categorias";
                            }    
                        })
                </script>';
            }
        }
    }

    /*====================Comentario====================
    MOSTRAR CATEGORIAS
    ==================================================*/
    
    public static function ctrMostrarCategorias($item, $valor){

        $tabla = "categorias";

        $respuesta = ModeloCategorias::mdlMostrarCategorias($tabla,$item,$valor);

        return $respuesta;
    }

    /*====================Comentario====================
    EDITAR CATEGORIAS
    ==================================================*/
    public static function ctrEditarCategoria()
    {

        if (isset($_POST['editarCategoria'])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCategoria"])) {


                $tabla = "categorias";

                $datos = array("categoria" => $_POST['editarCategoria'],
                               "id" => $_POST['idCategoria']);

                $respuesta = ModeloCategorias::mdlEditarCategoria($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '<script>
                        Swal.fire({
                            type: "success",
                            title: "¡La categoría ha sido cambiada correctamente!",
                            showConfirmButton: true,
                            confirButtonText: "Cerrar"
                            }).then(function(result){
                                if (result.value) {
                                    window.location = "categorias";
                                }    
                        })
                    </script>';
                }
            } else {
                echo '<script>
                    Swal.fire({
                        type: "error",
                        title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if (result.value) {
                                window.location = "categorias";
                            }    
                        })
                </script>';
            }
        }
    }

    /*====================Comentario====================
    BORRAR CATEGORIA
    ==================================================*/
    public static function ctrBorrarCategoria(){

        if (isset($_GET['idCategoria'])) {
            
            $tabla = "categorias";
            $datos = $_GET['idCategoria'];

            $respuesta = ModeloCategorias::mdlBorrarCategoria($tabla,$datos);

            if ($respuesta == "ok") {
                
                echo '<script>
                    Swal.fire({
                            type: "success",
                            title: "¡La categoría ha sido borrada correctamente!",
                            showConfirmButton: true,
                            confirButtonText: "Cerrar",
                            closeOnConfirm: false
                            }).then(function(result){
                                if (result.value) {
                                    window.location = "categorias";
                                }    
                        })
                </script>';
            }
        }
    }
}
 