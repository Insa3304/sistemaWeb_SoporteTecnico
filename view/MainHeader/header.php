<header class="site-header">
    <div class="container-fluid">


        <a href="#" class="site-logo">
            <img class="hidden-md-down" src="../../public/img/logo_ugel.jpg" alt="">
            <img class="hidden-lg-up" src="../../public/img/logo_ugel.jpg" alt="">
        </a>


        <button id="show-hide-sidebar-toggle" class="show-hide-sidebar">
            <span>toggle menu</span>
        </button>


        <button class="hamburger hamburger--htla">
            <span>toggle menu</span>
        </button>
       
        <div class="site-header-content">
            <div class="site-header-content-in">
                <div class="site-header-shown">
                    <div class="dropdown user-menu">
                        <button class="dropdown-toggle" id="dd-user-menu" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="../../public/img/avatar-1-256.png" alt="">
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd-user-menu">
                            <a class="dropdown-item" href="../Perfil/"><span class="font-icon glyphicon glyphicon-user"></span>Perfil</a>
                            <a class="dropdown-item" href="#"><span class="font-icon glyphicon glyphicon-question-sign"></span>Ayuda</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../Logout/logout.php"><span class="font-icon glyphicon glyphicon-log-out"></span>Cerrar Sesion</a>
                        </div>
                    </div>
                </div>


                <div class="mobile-menu-right-overlay"></div>
                 <input type="hidden" id="user_id" value="<?php echo $_SESSION["id_usuario"] ?>"><!-- ID del Usuario-->
                <input type="hidden" id="rol_id" value="<?php echo $_SESSION["rol_id"] ?>">


               <div class="dropdown dropdown-typical">
                    <a href="#" class="dropdown-toggle no-arr">
                        <span class="font-icon font-icon-user"></span>
                        <span class="lblcontactonomx"><?php echo $_SESSION["usuario_nombre"] ?> <?php echo $_SESSION["usuario_apellido"] ?></span>
                        <!-- jalamos el nombre para que aparezca -->
                    </a>
                </div>




            </div>
        </div>
    </div>
</header>

