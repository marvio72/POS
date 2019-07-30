<?php

session_start();

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>OverSistemas</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" href="views/img/plantilla/icono-blanco.png">

    <!-- // ────────────────────────────────────────────────────────────────────────
    //   :::::: P L U G I N S   C S S : :  :   :    :     :        :          :
    // ──────────────────────────────────────────────────────────────────────── -->


    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="views/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="views/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="views/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="views/dist/css/AdminLTE.css">
    <!-- AdminLTE Skins. -->
    <link rel="stylesheet" href="views/dist/css/skins/_all-skins.min.css">

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <!-- DataTables-->
    <link rel="stylesheet" href="views/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="views/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="views/plugins/iCheck/all.css">

    <!-- // ──────────────────────────────────────────────────────────────────────
    //   :::::: P L U G I N S   J S : :  :   :    :     :        :          :
    // ────────────────────────────────────────────────────────────────────── -->



    <!-- jQuery 3 -->
    <script src="views/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="views/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <!-- <script src="views/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script> -->
    <!-- FastClick -->
    <script src="views/bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="views/dist/js/adminlte.min.js"></script>
    <!-- DataTables -->
    <script src="views/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="views/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="views/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
    <script src="views/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>
    <!-- Sweetalert 2-->
    <script src="views/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <!-- Optional: include a polyfill for ES6 Promises for IE11 and Android browser -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script> -->
    <script src="https://www.promisejs.org/polyfills/promise-done-7.0.4.min.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="views/plugins/iCheck/icheck.min.js"></script>

</head>


<!-- // ──────────────────────────────────────────────────────────────────────────────────────────
//   :::::: C U E R P O   D E L   D O C U M E N T O : :  :   :    :     :        :          :
// ────────────────────────────────────────────────────────────────────────────────────────── -->

<body class="hold-transition skin-blue sidebar-collapse sidebar-mini login-page">



    <?php
    if (isset($_SESSION['iniciarSesion']) && $_SESSION['iniciarSesion'] == "ok") {


        echo '<div class="wrapper">';

        // ──────────────────────────────────────────────────────────────────
        //   :::::: C A B E Z O T E : :  :   :    :     :        :          :
        // ──────────────────────────────────────────────────────────────────

        include "modulos/cabezote.php";

        // ──────────────────────────────────────────────────────────────────
        //   :::::: M E N U   L A T E R A L : :  :   :    :     :        :          :
        // ──────────────────────────────────────────────────────────────────

        include "modulos/menu.php";


        // ────────────────────────────────────────────────────────────────────
        //   :::::: I N I C I O : :  :   :    :     :        :          :
        // ────────────────────────────────────────────────────────────────────

        if (isset($_GET['ruta'])) {

            if (
                $_GET['ruta'] == 'inicio' ||
                $_GET['ruta'] == 'usuarios' ||
                $_GET['ruta'] == 'categorias' ||
                $_GET['ruta'] == 'productos' ||
                $_GET['ruta'] == 'clientes' ||
                $_GET['ruta'] == 'ventas' ||
                $_GET['ruta'] == 'crear-venta' ||
                $_GET['ruta'] == 'reportes' ||
                $_GET['ruta'] == 'salir' ||
                $_GET['ruta'] == 'login'
            ) {
                include "modulos/" . $_GET['ruta'] . ".php";
            } else {
                include "modulos/404.php";
            }
        } else {
            include "modulos/inicio.php";
        }

        // ──────────────────────────────────────────────────────────────
        //   :::::: F O O T E R : :  :   :    :     :        :          :
        // ──────────────────────────────────────────────────────────────

        include "modulos/footer.php";


        echo '</div>';
    } else {

        include "modulos/login.php";
    }
    ?>



    <script src="views/js/plantilla.js"></script>
    <script src="views/js/usuarios.js"></script>
    <script src="views/js/categorias.js"></script>
    <script src="views/js/productos.js"></script>

</body>

</html>