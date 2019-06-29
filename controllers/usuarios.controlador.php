<?php 
 
class ControladorUsuarios {
    
	/*====================Comentario====================
    INGRESO DE USUARIO
    ==================================================*/
    
    public static function ctrIngresoUsuario(){
        if (isset($_POST['ingUsuario'])) {
            if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['ingUsuario'])&&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST['ingPassword'])) {
                
                $tabla = "usuarios";

                $item = "usuario";
                $valor = $_POST['ingUsuario'];

                $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla,$item,$valor);

                if($respuesta['usuario'] == $_POST['ingUsuario'] && $respuesta['password'] == $_POST['ingPassword']){

                    // echo '<br/><div class="alert alert-success">Bienvenido al sistema</div>';
                    $_SESSION['iniciarSesion'] = 'ok';
                    echo '<script>
                        window.location = "inicio";
                    </script>';
                   

                }else{

                    echo '<br/><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';
                }
            }
        }
    }

	/*====================Comentario====================
    CREAR USUARIO
    ==================================================*/
    public static function ctrCrearUsuario(){

        if (isset($_POST['nuevoUsuario'])) { // NOTE: Puedes agregar los campos de nuevoNombre y nuevoPassword para que sea mas compleja la validación
            
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['nuevoNombre']) &&
            preg_match('/^[a-z-A-Z0-9]+$/', $_POST['nuevoUsuario']) &&
            preg_match('/^[a-z-A-Z0-9]+$/', $_POST['nuevoPassword'])){

                $tabla = "usuarios";

                $datos = array(
                    "nombre"   => $_POST['nuevoNombre'],
                    "usuario"  => $_POST['nuevoUsuario'],
                    "password" => $_POST['nuevoPassword'],
                    "perfil"   => $_POST['nuevoPerfil']);

                $respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla,$datos);

                if ($respuesta == "ok") {
                    echo '<script>

					swal.fire({

						type: "success",
						title: "¡El usuario ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "usuarios";

						}

					});
				

                    </script>';
                    $datos = [];
                }             
            }else{
                echo '<script>

					swal.fire({

						type: "error",
						title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "usuarios";

						}

					});
				

				</script>';
            }      
        }
    }
}
