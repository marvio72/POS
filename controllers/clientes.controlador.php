<?php 
/*====================Comentario====================
CLASE ControladorClientes
==================================================*/
class ControladorClientes{

    /*====================Comentario====================
    Crear Clientes
    ==================================================*/
    public static function crtCrearCliente(){

        if (isset($_POST['nuevoCliente'])) {
            
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['nuevoCliente']) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST['nuevoRfc']) &&
                preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST['nuevoEmail']) &&
                preg_match('/^[()\-0-9 ]+$/', $_POST['nuevoTelefono']) && 
			    preg_match('/^[#\.\,\-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['nuevaDireccion'])){

                /*====================Comentario====================
                VALIDAR SI EXISTE RFC
                ==================================================*/    

                $tabla = "clientes";
                $item = "rfc";
                $valor = strtoupper($_POST['nuevoRfc']);

                $validar = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor);
                
                if ($validar['rfc'] == $valor) {
                    $datos = [];
                    echo '<script>
                    

					swal.fire({

						type: "error",
						title: "¡El RFC del cliente ya existe en la base de datos!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "clientes";

						}

					});
				    </script>';
                    die();
                }
            
                $rfc = strtoupper($_POST['nuevoRfc']);
                
                $tabla = 'clientes';
                $datos = array('nombre'           => $_POST['nuevoCliente'],
                               'rfc'              => $rfc,
                               'email'            => $_POST['nuevoEmail'],
                               'telefono'         => $_POST['nuevoTelefono'],
                               'direccion'        => $_POST['nuevaDireccion'],
                               'fecha_nacimiento' => $_POST['nuevaFechaNacimiento']);

                $respuesta = ModeloClientes::mdlIngresarCliente($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script>

					swal.fire({
						  type: "success",
						  title: "El cliente ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "clientes";

									}
								})

					</script>';
                   
                }

            }else{
                echo '<script>

					swal.fire({
						  type: "error",
						  title: "¡El cliente no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "clientes";

							}
						})

			  	</script>';
                
            }
        
        }

    }
    /*====================Comentario====================
    MOSTRAR CLIENTES
    ==================================================*/
    public static function crtMostrarClientes($item, $valor){
        
        $tabla = "clientes";

        $respuesta = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor);

        return $respuesta;
    }

    /*====================Comentario====================
    EDITAR CLIENTE
    ==================================================*/
    public static function crtEditarCliente()
    {

        if (isset($_POST['idCliente'])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['editarCliente']) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST['editarRfc']) &&
                preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST['editarEmail']) &&
                preg_match('/^[()\-0-9 ]+$/', $_POST['editarTelefono']) &&
                preg_match('/^[#\.\,\-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['editarDireccion'])){

                $rfc = strtoupper($_POST['editarRfc']);

                $tabla = 'clientes';
                $datos = array(
                    'id'               => $_POST['idCliente'],
                    'nombre'           => $_POST['editarCliente'],
                    'rfc'              => $rfc,
                    'email'            => $_POST['editarEmail'],
                    'telefono'         => $_POST['editarTelefono'],
                    'direccion'        => $_POST['editarDireccion'],
                    'fecha_nacimiento' => $_POST['editarFechaNacimiento']
                );

                $respuesta = ModeloClientes::mdlEditarCliente($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script>

					swal.fire({
						  type: "success",
						  title: "El cliente ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "clientes";

									}
								})

					</script>';
                }
            } else {
                echo '<script>

					swal.fire({
						  type: "error",
						  title: "¡El cliente no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "clientes";

							}
						})

			  	</script>';
            }
        }
    }
    /*====================Comentario====================
    BORRAR CLIENTE
    ==================================================*/
    public static function crtEliminarCliente(){
        if (isset($_GET['idCliente'])) {

            $tabla = "clientes";
            $datos = $_GET['idCliente'];

            $respuesta = ModeloClientes::mdlEliminarCliente($tabla, $datos);

            if ($respuesta == "ok") {

                echo '<script>
                        Swal.fire({
                                type: "success",
                                title: "¡El cliente ha sido borrado correctamente!",
                                showConfirmButton: true,
                                confirButtonText: "Cerrar",
                                closeOnConfirm: false
                                }).then(function(result){
                                    if (result.value) {
                                        window.location = "clientes";
                                    }    
                            })
                    </script>';
            }
        }
    }
    

}