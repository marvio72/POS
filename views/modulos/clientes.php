<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Administrar Clientes

        </h1>

        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <!-- <li><a href="#">Examples</a></li> -->
            <li class="active">Administrar Clientes</li>
        </ol>

    </section>
    <!--Fin .content-header-->

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">

                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCliente">
                    Agregar cliente
                </button>


            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped dt-responsive tablas" style="width: 100%">
                    <thead>
                        <tr>
                            <th style="width:10px">#</th>
                            <th>Nombre</th>
                            <th>RFC</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Dirección</th>
                            <th>Fecha nacimiento</th>
                            <th>Total compras</th>
                            <th>Última compra</th>
                            <th>Ingreso al sistema</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $item     = null;
                        $valor    = null;

                        $clientes = ControladorClientes::crtMostrarClientes($item, $valor);

                        foreach ($clientes as $key => $value) {
                            echo '<tr>
                                        <td>' . ($key + 1) . '</td>
                                        <td>' . $value['nombre'] . '</td>
                                        <td>' . $value['rfc'] . '</td>
                                        <td>' . $value['email'] . '</td>
                                        <td>' . $value['telefono'] . '</td>
                                        <td>' . $value['direccion'] . '</td>
                                        <td>' . $value['fecha_nacimiento'] . '</td>
                                        <td>' . $value['compras'] . '</td>
                                        <td>0000-00-00 00:00:00</td>
                                        <td>' . $value['fecha'] . '</td>
                                        

                                        <td>
                                            <div class="bt-group">
                                                <button class="btn btn-warning btnEditarCliente" data-toggle="modal" data-target="#modalEditarCliente" idCliente="' . $value['id'] . '"><i class="fa fa-pencil"></i></button>
                                                <button class="btn btn-danger btnEliminarCliente" idCliente="' . $value['id'] . '"><i class="fa fa-times"></i></button>
                                            </div>
                                        </td>
                                    </tr>';
                        }



                        ?>


                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->

        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>

<!--***************   *** Comentario *** ****************
/* MODAL AGREGAR CLIENTES
/*****************   *** ********** *** ****************-->
<!-- MODAL -->
<div id="modalAgregarCliente" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <form role="form" method="post">
                <!--***************   *** Comentario *** ****************
            /* CABEZA DEL MODAL
            /*****************   *** ********** *** ****************-->

                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Agregar Cliente</h4>
                </div>
                <!--***************   *** Comentario *** ****************
            /* CUERPO DEL MODAL
            /*****************   *** ********** *** ****************-->

                <div class="modal-body">

                    <div class="box-body">
                        <!--RFC-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                                <input type="text" class="form-control input-lg" name="nuevoRfc" id="nuevoRfc" placeholder="Ingresar RFC" data-inputmask="'mask':'aaa[a]999999[***]'" data-mask style="text-transform:uppercase" required>

                            </div>

                        </div>
                        <!--Cliente-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Ingresar nombre" required>

                            </div>

                        </div>
                        <!--EMAIL-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                                <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresar email" required>

                            </div>

                        </div>
                        <!--Teléfono-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar teléfono" data-inputmask="'mask':'(99) 9999 9999'" data-mask required>

                            </div>

                        </div>
                        <!--Dirección-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                                <input type="text" class="form-control input-lg" name="nuevaDireccion" placeholder="Ingresar dirección" required>

                            </div>

                        </div>
                        <!--Fecha Nacimiento-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                                <input type="text" class="form-control input-lg" name="nuevaFechaNacimiento" placeholder="Ingresar Fecha Nacimiento" data-inputmask="'alias':'yyyy/mm/dd'" data-mask required>

                            </div>

                        </div>

                    </div>

                </div>
            <!--***************   *** Comentario *** ****************
            /* PIE DEL MODAL
            /*****************   *** ********** *** ****************-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                    <button type="submit" class="btn btn-primary">Guardar cliente</button>

                </div>
            </form>
            <?php

            $crearCliente = new ControladorClientes();
            $crearCliente->crtCrearCliente();

            ?>
        </div>

    </div>
</div>

<!--***************   *** Comentario *** ****************
/* MODAL EDITAR CLIENTES
/*****************   *** ********** *** ****************-->
<!-- MODAL -->
<div id="modalEditarCliente" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <form role="form" method="post">
                <!--***************   *** Comentario *** ****************
            /* CABEZA DEL MODAL
            /*****************   *** ********** *** ****************-->

                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Editar Cliente</h4>
                </div>
                <!--***************   *** Comentario *** ****************
            /* CUERPO DEL MODAL
            /*****************   *** ********** *** ****************-->

                <div class="modal-body">

                    <div class="box-body">
                        <!--RFC-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                                <input type="text" class="form-control input-lg" name="editarRfc" id="editarRfc" data-inputmask="'mask':'aaa[a]999999[***]'" data-mask style="text-transform:uppercase"  readonly required>

                            </div>

                        </div>
                        <!--Cliente-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                <input type="text" class="form-control input-lg" name="editarCliente" id="editarCliente" required>

                                <input type="hidden" name="idCliente" id="idCliente">

                            </div>

                        </div>
                        <!--EMAIL-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                                <input type="email" class="form-control input-lg" name="editarEmail" id="editarEmail" required>

                            </div>

                        </div>
                        <!--Teléfono-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                                <input type="text" class="form-control input-lg" name="editarTelefono" id="editarTelefono" data-inputmask="'mask':'(99) 9999 9999'" data-mask required>

                            </div>

                        </div>
                        <!--Dirección-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                                <input type="text" class="form-control input-lg" name="editarDireccion" id="editarDireccion" required>

                            </div>

                        </div>
                        <!--Fecha Nacimiento-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                                <input type="text" class="form-control input-lg" name="editarFechaNacimiento" id="editarFechaNacimiento" data-inputmask="'alias':'yyyy/mm/dd'" data-mask required>

                            </div>

                        </div>

                    </div>

                </div>
                <!--***************   *** Comentario *** ****************
            /* PIE DEL MODAL
            /*****************   *** ********** *** ****************-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                    <button type="submit" class="btn btn-primary">Guardar cambios</button>

                </div>
            </form>
            <?php

            $editarCliente = new ControladorClientes();
            $editarCliente->crtEditarCliente();

            ?>
        </div>

    </div>
</div>

<?php

$borrarCliente = new ControladorClientes();
$borrarCliente->crtEliminarCliente();

?>