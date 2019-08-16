<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Crear venta

    </h1>

    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <!-- <li><a href="#">Examples</a></li> -->
      <li class="active">Crear venta</li>
    </ol>

  </section>
  <!--Fin .content-header-->

  <!-- Main content -->
  <section class="content">

    <div class="row">

      <!--***************   *** Comentario *** ****************
      EL FORMULARIO
      /*****************   *** ********** *** ****************-->

      <div class="col-lg-5 col-xs-12">

        <div class="box box-success">

          <div class="box-header with-border"></div>

          <form role="form" method="post" class="formularioVenta">

            <div class="box-body">

              <div class="box">

                <!--***************   *** Comentario *** ****************
              ENTRADA VENDEDOR
              /*****************   *** ********** *** ****************-->
                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control" id="nuevoVendedor" name="nuevoVendedor" value="<?php echo $_SESSION['nombre'] ?>" readonly="readonly">

                    <input type="hidden" name="idVendedor" value="<?php echo $_SESSION['id'] ?>">

                  </div>

                </div>

              <!--***************   *** Comentario *** ****************
              ENTRADA VENTA
              /*****************   *** ********** *** ****************-->
                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                    <?php
                    
                      $item = null;
                      $valor = null;

                      $ventas = ControladorVentas::ctrMostrarVentas($item,$valor);

                      if (!$ventas) {

                        echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="'.FOLIO.'" readonly="readonly">'; //NOTE Parametro para que funcione desde una Constante

                      }else{

                        foreach ($ventas as $key => $value){

                        }
                        $codigo = $value["codigo"]+1;

                          echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="'.$codigo.'" readonly="readonly">';
                      }
                    
                    ?>
                    

                  </div>

                </div>

                <!--***************   *** Comentario *** ****************
              ENTRADA CLIENTE
              /*****************   *** ********** *** ****************-->
                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-users"></i></span>

                    <select name="seleccionarCliente" id="seleccionarCliente" class="form-control" required="required">

                      <option value="">Seleccionar cliente</option>

                      <?php
                      
                        $item = null;
                        $valor = null;

                        $cliente = ControladorClientes::crtMostrarClientes($item, $valor);

                          foreach ($cliente as $key => $value) {
                            
                            echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                          }
                      
                      ?>
                    </select>

                    <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar cliente</button></span>


                  </div>

                </div>

                <!--***************   *** Comentario *** ****************
                ENTRADA PARA AGREGAR PRODUCTO
                /*****************   *** ********** *** ****************-->

                <div class="form-group row nuevoProducto">

                  <!-- Descripción del producto

                  <div class="col-xs-6" style="padding-right:0px">

                    <div class="input-group">

                      <span class="input-group-addon"><button class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button></span>

                      <input type="text" class="form-control" id="agregarProducto" name="agregarProducto" placeholder="Descripción del producto" required="required">

                    </div>

                  </div>

                  Cantidad del Producto 

                  <div class="col-xs-3">

                    <input type="number" class="form-control" id="nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" placeholder="0" required="required">

                  </div>

                  Precio del producto 

                  <div class="col-xs-3" style="padding-left:0px">

                    <div class="input-group">

                      <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                      <input type="number" min="1" class="form-control btn-numerico" id="nuevoPrecioProducto" name="nuevoPrecioProducto" placeholder="000000" readonly required>

                    </div>

                  </div> -->

                </div>

                <!--***************   *** Comentario *** ****************
                BOTON PARA AGREGAR PRODUCTO
                /*****************   *** ********** *** ****************-->

                <button type="button" class="btn btn-primary hidden-lg btnAgregarProducto">Agregar producto</button>

                <hr>

                <!--***************   *** Comentario *** ****************
                ENTRADA IMPUESTO Y TOTAL
                /*****************   *** ********** *** ****************-->

                <div class="row">

                  <div class="col-xs-8 pull-right">

                    <table class="table">

                      <thead>

                        <tr>
                          <th>Impuesto</th>
                          <th>Total</th>
                        </tr>

                      </thead>

                      <tbody>

                        <tr>

                          <td style="width: 50%">

                            <div class="input-group">

                              <input type="number" class="form-control input-lg" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta"  value=<?php echo IMPUESTO; ?> required="required">

                              <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" required="required">

                              <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" required="required">

                              <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                            </div>

                          </td>

                          <td style="width: 50%">

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-usd"></i></span>

                              <input type="number" class="form-control input-lg" min="0" id="nuevoTotalVenta" name="nuevoTotalVenta" placeholder="000000" total readonly required="required">

                            </div>

                          </td>

                        </tr>

                      </tbody>

                    </table>

                  </div>

                </div>

                <hr>

                <!--***************   *** Comentario *** ****************
                METODO DE PAGO
                /*****************   *** ********** *** ****************-->

                <div class="form-group row">

                  <div class="col-xs-6" style="padding-right:0px">

                    <div class="input-group">

                      <select name="nuevoMetodoPago" id="nuevoMetodoPago" class="form-control" required="required">
                        <option value="">Selectione método de pago</option>
                        <option value="efectivo">Efectivo</option>
                        <option value="tarjetaCredito">Tarjeta Crédito</option>
                        <option value="tarjetaDebito">Tarjeta Débito</option>
                        <option value="transferenciaElectronica">Transferencia Electrónica</option>
                      </select>

                    </div>

                  </div>

                  <div class="col-xs-6" style="2padding-left:0px">

                    <div class="input-group">

                      <input type="text" class="form-control" id="nuevoCodigoTransaccion" name="nuevoCodigoTransaccion" placeholder="Código transacción" required="required">

                      <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                    </div>

                  </div>

                </div>

                <br>

              </div>

            </div>


            <div class="box-footer">

              <button type="submit" class="btn btn-primary pull-right">Guardar venta</button>

            </div>

          </form>

        </div>

      </div>

      <!--***************   *** Comentario *** ****************
      LA TABALA DE PRODUCTOS
      /*****************   *** ********** *** ****************-->

      <div class="col-lg-7 hidden-md hidden-sm hidden-s">

        <div class="box box-warning">

          <div class="box-header with-border"></div>

          <div class="box-body">

            <table class="table table-bordered table-striped dt-responsive tablaVentas">

              <thead>

                <tr>
                  <th style="width: 10px">#</th>
                  <th>Imagen</th>
                  <th>Código</th>
                  <th>Descripción</th>
                  <th>Stock</th>
                  <th>Acciones</th>
                </tr>
                
              </thead>

            </table>

          </div>

        </div>

      </div>



    </div>

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