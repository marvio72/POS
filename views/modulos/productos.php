<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Administrar Productos

        </h1>

        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <!-- <li><a href="#">Examples</a></li> -->
            <li class="active">Administrar Productos </li>
        </ol>

    </section>
    <!--Fin .content-header-->

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">

                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto">
                    Agregar producto
                </button>


            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped dt-responsive tablaProductos" width="100%">
                    <thead>
                        <tr>
                            <th style="width:10px">#</th>
                            <th>Imagen</th>
                            <th>Código</th>
                            <th>Descripción</th>
                            <th>Categoría</th>
                            <th>Stock</th>
                            <th>Precio de compra</th>
                            <th>Precio de venta</th>
                            <th>Agregado</th>
                            <th>Acciones</th>

                        </tr>
                    </thead>
                    <!-- <tbody>

                    <?php

                    // $item = null;
                    // $valor = null;

                    // $productos = ControladorProductos::ctrMostrarProductos($item, $valor);

                    // foreach ($productos as $key => $value) {

                    //     echo '<tr>
                    //                     <td>' . ($key + 1) . '</td>
                    //                     <td><img src="views/img/Productos/default/anonymous.png" class="img-thumbnail" width="40px"></td>
                    //                     <td>' . $value["codigo"] . '</td>
                    //                     <td>' . $value["descripcion"] . '</td>';

                    //     $item = "id";
                    //     $valor = $value["id_categoria"];

                    //     $categoria = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                    //     echo '<td>' . $categoria["categoria"] . '</td>
                    //                     <td>' . $value["stock"] . '</td>
                    //                     <td>' . $value["precio_compra"] . '</td>
                    //                     <td>' . $value["precio_venta"] . '</td>
                    //                     <td>' . $value["fecha"] . '</td>
                    //                     <td>
                    //                         <div class="bt-group">
                    //                             <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                    //                             <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                    //                         </div>
                    //                     </td>
                    //                 </tr>';
                    // }

                    ?>
                       

                    </tbody> -->
                </table>
            </div>
            <!-- /.box-body -->

        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>

<!--***************   *** Comentario *** ****************
/* MODAL AGREGAR PRODUCTO
/*****************   *** ********** *** ****************-->
<!-- MODAL -->
<div id="modalAgregarProducto" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">
                <!--***************   *** Comentario *** ****************
            /* CABEZA DEL MODAL
            /*****************   *** ********** *** ****************-->

                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Agregar Producto</h4>
                </div>
                <!--***************   *** Comentario *** ****************
            /* CUERPO DEL MODAL
            /*****************   *** ********** *** ****************-->

                <div class="modal-body">
                    <div class="box-body">
                        <!--CÓDIGO-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-code"></i></span>

                                <input type="text" class="form-control input-lg" name="nuevoCodigo" placeholder="Ingresar Código" required>

                            </div>

                        </div>
                        <!--DESCRIPCION-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>

                                <input type="text" class="form-control input-lg" name="nuevoDescripcion" placeholder="Ingresar Descripción" required>

                            </div>

                        </div>

                        <!--CATEGORÍA-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                <select class="form-control input-lg" name="nuevaCategoria">

                                    <option value="">Seleccionar Categoría</option>

                                    <option value="Taladros">Taladros</option>

                                    <option value="Andamios">Andamios</option>

                                    <option value="Equipos para la construcción">Equipos para la construcción</option>

                                </select>

                            </div>

                        </div>

                        <!--STOCK-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-check"></i></span>

                                <input type="number" class="form-control input-lg" name="nuevoStock" min="0" placeholder="Stock" required>

                            </div>

                        </div>
                        <!--PRECIO COMPRA-->
                        <div class="form-group row">

                            <div class="col-xs-6">

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>

                                    <input type="number" class="form-control input-lg" name="nuevoPrecioCompra" min="0" placeholder="Precio de Compra" required>

                                </div>

                            </div>


                            <!--PRECIO VENTA-->

                            <div class="col-xs-6">

                                <div class="input-group col-6">

                                    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>

                                    <input type="number" class="form-control input-lg" name="nuevoPrecioVenta" min="0" placeholder="Precio de Venta" required>

                                </div>

                                <br>
                                <!-- CHECKBOX PARA PORCENTAJE -->

                                <div class="col-xs-6">

                                    <div class="form-group">

                                        <label>

                                            <input type="checkbox" name="porcentaje" id="porcentaje" class="minimal porcentaje" checked>
                                            Utilizar porcentaje

                                        </label>

                                    </div>

                                </div>

                                <!-- CAMPO PARA CAPTURAR EL PORCENTAJE -->

                                <div class="col-xs-6" style="padding:0">

                                    <div class="input-group">

                                        <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>

                                        <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                                    </div>

                                </div>

                            </div>

                        </div>
                        <!--ENTRADA PARA SUBIR FOTO-->
                        <div class="form-group">

                            <div class="panel">SUBIR IMAGEN</div>

                            <input type="file" name="nuevaImagen" id="nuevaImagen">

                            <p class="help-block">Peso máximo de la imagen 2MB</p>

                            <img src="views/img/productos/default/anonymous.png" class="img-thumbnail" width="100px">

                        </div>

                    </div>
                </div>
                <!--***************   *** Comentario *** ****************
            /* PIE DEL MODAL
            /*****************   *** ********** *** ****************-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                    <button type="submit" class="btn btn-primary">Guardar productos</button>

                </div>
            </form>
        </div>

    </div>
</div>