<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Administrar Usuarios

        </h1>

        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <!-- <li><a href="#">Examples</a></li> -->
            <li class="active">Administrar Usuarios</li>
        </ol>

    </section>
    <!--Fin .content-header-->

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">

                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">
                    Agregar usuario
                </button>


            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped dt-responsive tablas">
                    <thead>
                        <tr>
                            <th style="width:10px">#</th>
                            <th>Nombre</th>
                            <th>Usuario</th>
                            <th>Foto</th>
                            <th>Perfil</th>
                            <th>Estado</th>
                            <th>Último login</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                            $item = null;
                            $valor = null;

                            $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

                            foreach ($usuarios as $key => $value) {
                                // var_dump($value['nombre']);
                                echo '<tr>
                                        <td>' . $value['id'] . '</td>
                                        <td>' . $value['nombre'] . '</td>
                                        <td>' . $value['usuario'] . '</td>';

                                if ($value['foto'] != "") {
                                    echo '<td><img src="' . $value['foto'] . '" class="img-thumbnail" width="40px"></td>';
                                } else {
                                    echo '<td><img src="views/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px"></td>';
                                }

                                echo '<td>' . $value['perfil'] . '</td>
                                        <td><button class="btn btn-success btn-xs">Activado</button></td>
                                        <td>' . $value['ultimo_login'] . '</td>
                                        <td>
                                        <div class="bt-group">

                                            <button class="btn btn-warning btnEditarUsuario" idUsuario="' . $value['id'] . '" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fa fa-pencil"></i></button>

                                            <button class="btn btn-danger"><i class="fa fa-times"></i></button>

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
/* MODAL AGREGAR USUARIO
/*****************   *** ********** *** ****************-->
<!-- MODAL -->
<div id="modalAgregarUsuario" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">
                <!--***************   *** Comentario *** ****************
            /* CABEZA DEL MODAL
            /*****************   *** ********** *** ****************-->

                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Agregar Usuario</h4>
                </div>
                <!--***************   *** Comentario *** ****************
            /* CUERPO DEL MODAL
            /*****************   *** ********** *** ****************-->

                <div class="modal-body">
                    <div class="box-body">
                        <!--NOMBRE-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Nombre">

                            </div>

                        </div>
                        <!--USUARIO-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                                <input type="text" class="form-control input-lg" name="nuevoUsuario" placeholder="Ingresar Usuario">

                            </div>

                        </div>
                        <!--CONTRASEÑA-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                                <input type="password" class="form-control input-lg" name="nuevoPassword" placeholder="Ingresar Contraseña">

                            </div>

                        </div>
                        <!--PERFIL-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-users"></i></span>

                                <select class="form-control input-lg" name="nuevoPerfil">

                                    <option value="">Seleccionar Perfil</option>

                                    <option value="Administrador">Administrador</option>

                                    <option value="Especial">Especial</option>

                                    <option value="Vendedor">Vendedor</option>

                                </select>

                            </div>

                        </div>
                        <!--ENTRADA PARA SUBIR FOTO-->
                        <div class="form-group">

                            <div class="panel">SUBIR FOTO</div>

                            <input type="file" name="nuevaFoto" class="nuevaFoto">

                            <p class="help-block">Peso máximo de la foto 2 MB</p>

                            <img src="views/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

                        </div>

                    </div>
                </div>
                <!--***************   *** Comentario *** ****************
            /* PIE DEL MODAL
            /*****************   *** ********** *** ****************-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                    <button type="submit" class="btn btn-primary">Guardar usuario</button>

                </div>
                <?php

                $crearUsuario = new ControladorUsuarios();
                $crearUsuario->ctrCrearUsuario();

                ?>
            </form>
        </div>

    </div>
</div>

<!--***************   *** Comentario *** ****************
/* MODAL EDITAR USUARIO
/*****************   *** ********** *** ****************-->
<!-- MODAL -->
<div id="modalEditarUsuario" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">
                <!--***************   *** Comentario *** ****************
            /* CABEZA DEL MODAL
            /*****************   *** ********** *** ****************-->

                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Editar Usuario</h4>
                </div>
                <!--***************   *** Comentario *** ****************
            /* CUERPO DEL MODAL
            /*****************   *** ********** *** ****************-->

                <div class="modal-body">
                    <div class="box-body">
                        <!--NOMBRE-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="">

                            </div>

                        </div>
                        <!--USUARIO-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                                <input type="text" class="form-control input-lg"  id="editarUsuario" name="editarUsuario" value="" readonly>

                            </div>

                        </div>
                        <!--CONTRASEÑA-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                                <input type="password" class="form-control input-lg" id="editarPassword" name="editarPassword" placeholder="Escriba la nueva contraseña">

                                <input type="hidden" id="passwordActual" name="passwordActual">

                            </div>

                        </div>
                        <!--PERFIL-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-users"></i></span>

                                <select class="form-control input-lg" name="editarPerfil">

                                    <option value="" id="editarPerfil"></option>

                                    <option value="Administrador">Administrador</option>

                                    <option value="Especial">Especial</option>

                                    <option value="Vendedor">Vendedor</option>

                                </select>

                            </div>

                        </div>
                        <!--ENTRADA PARA SUBIR FOTO-->
                        <div class="form-group">

                            <div class="panel">SUBIR FOTO</div>

                            <input type="file" name="editarFoto" class="nuevaFoto">

                            <p class="help-block">Peso máximo de la foto 2 MB</p>

                            <img src="views/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

                            <input type="hidden" name="fotoActual" id="fotoActual">

                        </div>

                    </div>
                </div>
                <!--***************   *** Comentario *** ****************
                /* PIE DEL MODAL
                /*****************   *** ********** *** ****************-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                    <button type="submit" class="btn btn-primary">Modificar usuario</button>

                </div>

                <?php

                        $editarUsuario = new ControladorUsuarios();
                        $editarUsuario -> ctrEditarUsuario();

                ?>

            </form>
        </div>

    </div>
</div>