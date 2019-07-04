<header class="main-header">

    <!-- //
    // ──────────────────────────────────────────────────────────────────
    // :::::: L O G O T I P O : : : : : : : :
    // ──────────────────────────────────────────────────────────────────
    // -->

    <a href="inicio" class="logo">
        <!-- logo mini NOTE modulo config -->
        <span class="logo-mini">
            <img src="views/img/plantilla/icono-blanco.png" class="img-responsive" style="padding:10px">
        </span>

        <!-- logo normal NOTE modulo config -->
        <span class="logo-lg">
            <img src="views/img/plantilla/logo-blanco-lineal.png" class="img-responsive" style="padding:10px 0">
        </span>
    </a>

    <!-- //
    // ──────────────────────────────────────────────────────────────────
    // :::::: BARRA DE NAVEGACION : : : : : : : :
    // ──────────────────────────────────────────────────────────────────
    // -->
    <nav class="navbar navbar-static-top" role="navigation">

        <!-- Boton de navegación -->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <!-- Perfil de usuario -->
        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <li class="dropdown user user-menu">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                        <?php

                        if ($_SESSION['foto'] != "") {
                            
                            echo '<img src="'. $_SESSION['foto'].'" class="user-image">';

                        }else {

                            echo '<img src="views/img/usuarios/default/anonymous.png" class="user-image">';
                        };

                        ?>
                            <!--NOTE modulo config-->
                        <span class="hidden-xs"><?php echo $_SESSION['nombre'] ?></span>
                        </a>
                        <!-- Dropdown-toggle -->
                        <ul class="dropdown-menu">
                            <li class="user-body">
                                <div class="pull-right">
                                    <a href="salir" class="btn btn-default btn-flat">Salir</a>
                                </div>
                            </li>

                        </ul>
                    </li>
                </ul>

            </div> <!-- fin Perfil de usuario -->

        </nav>

    </header>