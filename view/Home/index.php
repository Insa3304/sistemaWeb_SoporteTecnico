
<?php
  require_once("../../config/conexion.php"); #validacion para evitar que ingrese cualquiera
  if(isset($_SESSION["id_usuario"])){
?>


<!DOCTYPE html>
<html>
    <?php require_once("../MainHead/head.php");#llamar al header
    ?>

    <title>Sistema web de asistencia técnica</title>
</head>
<body class="with-side-menu">

	 <?php require_once("../MainHeader/header.php");
    ?>

	<div class="mobile-menu-left-overlay"></div>
	<?php require_once("../MainNav/nav.php");
    ?>

	<!-- Aqui empieza el contenido de la pagina -->
	<div class="page-content">
		<div class="container-fluid">
			En desarrollo....
		</div><!--.container-fluid-->
	</div><!--.page-content-->
	<!-- Aqui termina el contenido -->

	<?php require_once("../MainJavaScript/javascript.php") ?>
	<script type="text/javascript" src="home.js"></script>


</body>
</html>
<?php
  } else {
    header("Location:".Conectar::ruta()."index.php"); #si no nos manda a la ruta del index
  }
?>

