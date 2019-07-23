<?php 
 
class ControladorCategorias{

    /*====================Comentario====================
    CREAR CATEGORIAS
    ==================================================*/
    public static function ctrCrearCategoria(){

        if (isset($_POST['nuevaCategoria'])) {
            
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaCategoria"] )) {

                $tabla = "categorias";

                $datos = $_POST['nuevaCategoria'];

                $respuesta = ModeloCategorias::mdlIngresarCategoria($tabla, $datos);

                if ($respuesta == "ok") {
                    echo `<script>
                        Swal.fire({
                        type: "error",
                        title: "¡La categoría ha sido guardada correctamente!",
                        showConfirmButton: true,
                        closeOnf Confirm: false
                        }).then(function result(){
                            if (result.value) {
                                window.location = "categorias";
                            }    
                        })
                    </script>`;
                }
                
            }else{
                echo `<script>
                    Swal.fire({
                        type: "error",
                        title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
                        showConfirmButtonText: "Cerrar",
                        closeOnf Confirm: false
                        }).then(function result(){
                            if (result.value) {
                                window.location = "categorias";
                            }    
                        })
                </script>`;
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
}
 