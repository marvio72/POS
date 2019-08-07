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
                        <tr>
                            <td>1</td>
                            <td>Juan Villegas</td>
                            <td>ViGJ750221GI2</td>
                            <td>juan21@hotmail.com</td>
                            <td>33 9871 2312</td>
                            <td>Eucaliptos 327 Arboledas</td>
                            <td>1975-02-21</td>
                            <td>12</td>
                            <td>2019-08-06 12:03:22</td>
                            <td>2019-08-06 11:34:92</td>

                            <td>
                                <div class="bt-group">
                                    <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                                </div>
                            </td>
                        </tr>
                        
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
                    <h4 class="modal-title">Agregar Categoría</h4>
                </div>
                <!--***************   *** Comentario *** ****************
            /* CUERPO DEL MODAL
            /*****************   *** ********** *** ****************-->

                <div class="modal-body">

                    <div class="box-body">
                        <!--Cliente-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Ingresar nombre" required>

                            </div>

                        </div>
                        <!--RFC-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                                <input type="text" class="form-control input-lg" name="nuevoRfc" placeholder="Ingresar RFC" data-inputmask="'mask':'aaa[a]999999[***]'" data-mask  style="text-transform:uppercase" required>

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