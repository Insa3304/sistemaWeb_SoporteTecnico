<?php
require_once("../config/conexion.php");
if(isset($_POST["enviar"]) and $_POST["enviar"]=="si"){
    require_once("../models/Usuario.php"); #llamo al modelo usuario
    $usuario = new Usuario();
    $usuario->login();
}
?>


<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Sistema de soporte técnico UGEL</title>

	<link href="img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
	<link href="img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
	<link href="img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
	<link href="img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
	<link href="img/favicon.png" rel="icon" type="image/png">
	<link href="img/favicon.ico" rel="shortcut icon">

	
    <link rel="stylesheet" href="../public/css/separate/pages/login.min.css">
    <link rel="stylesheet" href="../public/css/lib/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="../public/css/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/main.css">
</head>
<body>

    <div class="page-center">
        <div class="page-center-in">
            <div class="container-fluid">
                <form class="sign-box" method="post" action=""  id="login_form">
                    <input type="hidden" id = "rol_id" name="rol_id" value="1">
                    <div class="sign-avatar">
                        <img src="/UgelTicketsSoporte/public/1.png" alt="" id="imagen_rol">
                    </div>
                    <header class="sign-title" id="lbltitulo">Usuario</header>

                    <?php
                        if (isset($_GET["m"])){
                            switch($_GET["m"]){
                                case "1";
                                    ?>

                                        <div class="alert alert-danger alert-icon alert-close alert-dismissible fade in" role="alert">
							            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								        <span aria-hidden="true">×</span>
							            </button>
							            <i class="font-icon font-icon-warning"></i>
                                        El Usuario o contraseña son incorrectos.
						                </div>
                                    <?php
                                break;


                                case "2";
                                    ?>
                                        <div class="alert alert-warning alert-icon alert-close alert-dismissible fade in" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <i class="font-icon font-icon-warning"></i>
                                            Los campos estan vacios.
                                        </div>
                                    <?php
                                break;
                            }
                        }
                    ?>



                    <div class="form-group">
                        <input type="text" id="correo" name="usuario_correo"class="form-control" placeholder="Usuario"/>
                    </div>
                    <div class="form-group">
                        <input type="password" id="usuario_contraseña" name="usuario_contraseña" class="form-control" placeholder="Contraseña"/>
                    </div>
                    <div class="form-group">
                        
                        <div class="float-right reset">
                            <a href="reset-password.html">¿Olvido la contraseña?</a>
                        </div>
                         <div class="float-left reset">
                            <a href="#" id="vista_soporte">Acceso Soporte</a>
                        </div>
                    </div>
                    <input type="hidden" name="enviar" class ="form-control" value ="si"> <!-- valor establecido arriba-->

                    <button type="submit" class="btn btn-rounded">Iniciar sesión</button>
                   
                    <!--<button type="button" class="close">
                        <span aria-hidden="true">&times;</span>
                    </button>-->
                </form>
            </div>
        </div>
    </div><!--.page-center-->


<script src="../public/js/lib/jquery/jquery.min.js"></script>
<script src="../public/js/lib/tether/tether.min.js"></script>
<script src="../public/js/lib/bootstrap/bootstrap.min.js"></script>
<script src="../public/js/plugins.js"></script>
    <script type="text/javascript" src="../public/js/lib/match-height/jquery.matchHeight.min.js"></script>
    <script>
        $(function() {
            $('.page-center').matchHeight({
                target: $('html')
            });

            $(window).resize(function(){
                setTimeout(function(){
                    $('.page-center').matchHeight({ remove: true });
                    $('.page-center').matchHeight({
                        target: $('html')
                    });
                },100);
            });
        });
    </script>
<script src="../public/js/app.js"></script>
<script type="text/javascript" src="index.js"></script>
</body>
</html>