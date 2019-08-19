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
                            <th>S+</th>
                            <th>S-</th>
                            <th>Precio de compra</th>
                            <th>Precio de venta</th>
                            <th>Agregado</th>
                            <th>Acciones</th>

                        </tr>
                    </thead>

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

                        <!--CATEGORÍA-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                <select class="form-control input-lg" name="nuevaCategoria" id="nuevaCategoria" required>

                                    <option value="">Seleccionar Categoría</option>

                                    <?php

                                    $item = null;
                                    $valor = null;

                                    $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                                    foreach ($categorias as $key => $value) {

                                        echo '<option value="' . $value["id"] . '">' . $value["categoria"] . '</option>';
                                    }

                                    ?>

                                </select>

                            </div>

                        </div>

                        <!--CÓDIGO-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-code"></i></span>

                                <input type="text" class="form-control input-lg" id="nuevoCodigo" name="nuevoCodigo" placeholder="Ingresar Código" readonly required>

                            </div>

                        </div>
                        <!--DESCRIPCION-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>

                                <input type="text" class="form-control input-lg" name="nuevaDescripcion" placeholder="Ingresar Descripción" required>

                            </div>

                        </div>

                        <!--STOCK-->
                        <div class="form-group row">

                            <div class="col-xs-12 col-sm-6">

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-check"></i></span>

                                    <input type="number" class="form-control input-lg" name="nuevoStock" min="0" step="any" placeholder="Stock" required>

                                </div>

                            </div>
                            <!-- STOCK MAX -->
                            <div class="col-xs-12 col-sm-3 maxStock">
                                <!--NOTE se añade clase maxStock para la validacion de stockMax y stockMin-->

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-chevron-up"></i></span>

                                    <input type="number" class="form-control input-lg stockMax" name="nuevoStockMax" id="nuevoStockMax" min="0" step="any" placeholder="S+" required>
                                    <!--NOTE se añade clase stockMax para la validacion de stockMax y stockMin-->

                                </div>

                            </div>
                            <!-- STOCK MIN -->
                            <div class="col-xs-12 col-sm-3">

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-chevron-down"></i></span>

                                    <input type="number" class="form-control input-lg" name="nuevoStockMin" id="nuevoStockMin" min="0" step="any" placeholder="S-" required>

                                </div>

                            </div>

                            <input type="hidden" class="stockError">
                            <!-NOTE Es usado para mostrar el error de stocks--->

                        </div>
                        <!--ROW STOCK-->
                        <!--PRECIO COMPRA-->
                        <div class="form-group row">

                            <div class="col-xs-12 col-sm-6">

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>

                                    <input type="number" class="form-control input-lg" id="nuevoPrecioCompra" name="nuevoPrecioCompra" min="0" step="any" placeholder="Precio de Compra" required>

                                </div>

                            </div>


                            <!--PRECIO VENTA-->

                            <div class="col-xs-12 col-sm-6">

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>

                                    <input type="number" class="form-control input-lg" id="nuevoPrecioVenta" name="nuevoPrecioVenta" min="0" placeholder="Precio de Venta" required>

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

                                        <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="<?php echo GANANCIA ?>" required>
                                        <!--NOTE Porcentaje-->

                                        <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                                    </div>

                                </div>

                            </div>

                        </div>
                        <!--ENTRADA PARA SUBIR FOTO-->
                        <div class="form-group">

                            <div class="panel">SUBIR IMAGEN</div>

                            <input type="file" class="nuevaImagen" name="nuevaImagen">

                            <p class="help-block">Peso máximo de la imagen 2MB</p>

                            <img src="views/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

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

            <?php

            $crearProducto = new ControladorProductos();
            $crearProducto->ctrCrearProducto();

            ?>
        </div>

    </div>
</div>

<!--***************   *** Comentario *** ****************
/* MODAL EDITAR PRODUCTO
/*****************   *** ********** *** ****************-->
<!-- MODAL -->
<div id="modalEditarProducto" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">
                <!--***************   *** Comentario *** ****************
            /* CABEZA DEL MODAL
            /*****************   *** ********** *** ****************-->

                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Editar Producto</h4>
                </div>
                <!--***************   *** Comentario *** ****************
            /* CUERPO DEL MODAL
            /*****************   *** ********** *** ****************-->

                <div class="modal-body">
                    <div class="box-body">

                        <!--CATEGORÍA-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                <select class="form-control input-lg" name="editarCategoria" readonly required>

                                    <option id="editarCategoria"></option>

                                </select>

                            </div>

                        </div>

                        <!--CÓDIGO-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-code"></i></span>

                                <input type="text" class="form-control input-lg" id="editarCodigo" name="editarCodigo" readonly required>

                            </div>

                        </div>
                        <!--DESCRIPCION-->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>

                                <input type="text" class="form-control input-lg" name="editarDescripcion" id="editarDescripcion" required>

                            </div>

                        </div>

                        <!--STOCK-->
                        <div class="form-group row">

                            <div class="col-xs-12 col-sm-6">

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-check"></i></span>

                                    <input type="number" class="form-control input-lg" name="editarStock" id="editarStock" min="0" required>

                                </div>

                            </div>
                            <!-- STOCK MAX  -->
                            <div class="col-xs-12 col-sm-3 maxStock">
                                <!--NOTE Se agrega id maxStock para realizar validación de stockmax y min-->

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-chevron-up"></i></span>

                                    <input type="number" class="form-control input-lg stockMax" name="editarStockMax" id="editarStockMax" min="0" required>

                                </div>

                            </div>
                            <!-- STOCK MIN -->
                            <div class="col-xs-12 col-sm-3">

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-chevron-down"></i></span>

                                    <input type="number" class="form-control input-lg" name="editarStockMin" id="editarStockMin" min="0" required>

                                </div>

                            </div>
                            <input type="hidden" class="stockError">
                            <!-NOTE Es usado para mostrar el error de stocks--->
                        </div>
                        <!--ROW-->
                        <!--PRECIO COMPRA-->
                        <div class="form-group row">

                            <div class="col-xs-12 col-sm-6">

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>

                                    <input type="number" class="form-control input-lg" id="editarPrecioCompra" name="editarPrecioCompra" min="0" step="any" required>

                                </div>

                            </div>


                            <!--PRECIO VENTA-->

                            <div class="col-xs-12 col-sm-6">

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>

                                    <input type="number" class="form-control input-lg" id="editarPrecioVenta" name="editarPrecioVenta" min="0" step="any" readonly required>

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

                                        <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="<?php echo GANANCIA; ?>" required>
                                        <!--NOTE Porcentaje-->

                                        <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                                    </div>

                                </div>

                            </div>

                        </div>
                        <!--EDITAR PARA SUBIR FOTO-->
                        <div class="form-group">

                            <div class="panel">SUBIR IMAGEN</div>

                            <input type="file" class="nuevaImagen" name="editarImagen">

                            <p class="help-block">Peso máximo de la imagen 2MB</p>

                            <img src="views/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

                            <input type="hidden" name="imagenActual" id="imagenActual">

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

            <?php

            $editarProducto = new ControladorProductos();
            $editarProducto->ctrEditarProducto();

            ?>
        </div>

    </div>
</div>

<?php

$eliminarProducto = new ControladorProductos();
$eliminarProducto->ctrEliminarProducto();

?>