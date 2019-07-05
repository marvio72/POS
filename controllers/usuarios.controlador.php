<?php 
 
class ControladorUsuarios {
    
	/*====================Comentario====================
    INGRESO DE USUARIO
    ==================================================*/
    
    public static function ctrIngresoUsuario(){
        if (isset($_POST['ingUsuario'])) {
            if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['ingUsuario'])&&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST['ingPassword'])) {
                
                
                $encriptar = crypt($_POST['ingPassword'], '$2y$10$ksehXt7dOXtSYhTVrHikuO/4XqGYg9wVBwe5KF4IAUUsrFC14JI52');
                // var_dump($encriptar);
                // die();

                $tabla = "usuarios";

                $item = "usuario";
                $valor = $_POST['ingUsuario'];

                $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla,$item,$valor);

                if($respuesta['usuario'] == $_POST['ingUsuario'] && $respuesta['password'] == $encriptar){

                    // echo '<br/><div class="alert alert-success">Bienvenido al sistema</div>';
                    $_SESSION['iniciarSesion'] = 'ok';
                    $_SESSION['id'] = $respuesta['id'];
                    $_SESSION['nombre'] = $respuesta['nombre'];
                    $_SESSION['usuario'] = $respuesta['usuario'];
                    $_SESSION['foto'] = $respuesta['foto'];
                    $_SESSION['perfil'] = $respuesta['perfil'];

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

            	/*====================Comentario====================
                VALIDAR IMAGEN Y DARLE UN NUEVO TAMAÑO
                ==================================================*/

                $ruta = "";

                if (isset($_FILES['nuevaFoto']['tmp_name'])) {
                    
                    list($ancho, $alto) = getimagesize($_FILES['nuevaFoto']['tmp_name']);

                    $nuevoAncho = 500;
                    $nuevoAlto = 500;

                    /*====================Comentario====================
                    CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
                    ==================================================*/
                    
                    $directorio = "views/img/usuarios/".$_POST['nuevoUsuario'];

                    mkdir($directorio, 0755);

                    /*====================Comentario====================
                    DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES OR DEFECTO DE PHP
                    ==================================================*/

                    if($_FILES['nuevaFoto']['type'] == "image/jpeg"){

                        /*====================Comentario====================
                        GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                        ==================================================*/

                        $aleatorio = mt_rand(100,999);

                        $ruta = "views/img/usuarios/".$_POST['nuevoUsuario'].'/'.$aleatorio.'.jpg';

                        $origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresampled($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $ruta);

                    }

                    if ($_FILES['nuevaFoto']['type'] == "image/png") {

                        /*====================Comentario====================
                        GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                        ==================================================*/

                        $aleatorio = mt_rand(100, 999);

                        $ruta = "views/img/usuarios/" . $_POST['nuevoUsuario'] . '/' . $aleatorio . '.png';

                        $origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresampled($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $ruta);
                    }
                    
                }

                $tabla = "usuarios";

                /*====================Comentario====================
                ENCRIPTAR CONTRASEÑA
                ==================================================*/

                $encriptar = crypt( $_POST['nuevoPassword'], '$2y$10$ksehXt7dOXtSYhTVrHikuO/4XqGYg9wVBwe5KF4IAUUsrFC14JI52');

                $datos = array(
                    "nombre"   => $_POST['nuevoNombre'],
                    "usuario"  => $_POST['nuevoUsuario'],
                    "password" => $encriptar,
                    "perfil"   => $_POST['nuevoPerfil'],
                    "foto"     => $ruta);

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

    /*====================Comentario====================
    MOSTRAR USUARIOS
    ==================================================*/

    public static function ctrMostrarUsuarios($item, $valor){

        $tabla = "usuarios";

        $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);

        return $respuesta;
    }

    /*====================Comentario====================
    EDITAR USUARIO
    ==================================================*/

    public static function ctrEditarUsuario(){

        if (isset($_POST['editarUsuario'])) {
            

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['editarNombre'])){

                /*====================Comentario====================
                VALIDAR IMAGEN Y DARLE UN NUEVO TAMAÑO
                ==================================================*/

                $ruta = $_POST['fotoActual'];

                if (isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])) {

                    list($ancho, $alto) = getimagesize($_FILES['editarFoto']['tmp_name']);

                    $nuevoAncho = 500;
                    $nuevoAlto = 500;

                    /*====================Comentario====================
                    CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
                    ==================================================*/

                    $directorio = "views/img/usuarios/" . $_POST['editarUsuario'];

                    /*====================Comentario====================
                    PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
                    ==================================================*/

                    if (!empty($_POST['fotoActual'])){
                        
                        unlink($_POST['fotoActual']);

                    }else{

                        mkdir($directorio, 0755);

                    }                   

                   
                    /*====================Comentario====================
                    DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
                    ==================================================*/

                    if ($_FILES['editarFoto']['type'] == "image/jpeg") {

                        /*====================Comentario====================
                        GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                        ==================================================*/

                        $aleatorio = mt_rand(100, 999);

                        $ruta = "views/img/usuarios/" . $_POST['editarUsuario'] . '/' . $aleatorio . '.jpg';

                        $origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresampled($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $ruta);
                    }

                    if ($_FILES['editarFoto']['type'] == "image/png") {

                        /*====================Comentario====================
                        GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                        ==================================================*/

                        $aleatorio = mt_rand(100, 999);

                        $ruta = "views/img/usuarios/" . $_POST['editarUsuario'] . '/' . $aleatorio . '.png';

                        $origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresampled($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $ruta);
                    }
                }

                $tabla = "usuarios";

                if ($_POST['editarPassword'] != "") {
                    
                    if (preg_match('/^[a-z-A-Z0-9]+$/', $_POST['editarPassword'])) {

                        $encriptar = crypt($_POST['editarPassword'], '$2y$10$ksehXt7dOXtSYhTVrHikuO/4XqGYg9wVBwe5KF4IAUUsrFC14JI52');

                    }else{

                        echo '<script>

                            swal.fire({

                                type: "error",
                                title: "¡La contraseña no puede ir vacío o llevar caracteres especiales!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"

                            }).then(function(result){

                                if(result.value){
                                
                                    window.location = "usuarios";

                                }

                            })
                        

                        </script>';
                    }
                }else{

                    $encriptar = $_POST['passwordActual'];
                
                }

                $datos = array(
                    "nombre"   => $_POST['editarNombre'],
                    "usuario"  => $_POST['editarUsuario'],
                    "password" => $encriptar,
                    "perfil"   => $_POST['editarPerfil'],
                    "foto"     => $ruta);
   

                $respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script>

					swal.fire({

						type: "success",
						title: "¡El usuario ha sido editado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "usuarios";

						}

					});
				

                    </script>';
                }
            }else{

                echo '<script>

                            swal.fire({

                                type: "error",
                                title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"

                            }).then(function(result){

                                if(result.value){
                                
                                    window.location = "usuarios";

                                }

                            })
                        

                </script>';
            }
        }
    }
}
