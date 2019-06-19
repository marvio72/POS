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
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="views/dist/js/demo.js"></script> -->
</head>

<!-- // ──────────────────────────────────────────────────────────────────────────────────────────
//   :::::: C U E R P O   D E L   D O C U M E N T O : :  :   :    :     :        :          :
// ────────────────────────────────────────────────────────────────────────────────────────── -->

<body class="hold-transition skin-blue sidebar-collapse sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

        <?php

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
                $_GET['ruta'] == 'reportes'
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




            ?>

        </div><!-- ./wrapper -->


        <script src="views/js/plantilla.js"></script>
    </body>

    </html>