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
}