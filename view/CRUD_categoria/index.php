
<?php
  require_once("../../config/conexion.php"); #validacion para evitar que ingrese cualquiera
  if(isset($_SESSION["id_usuario"])){
?>


<!DOCTYPE html>
<html>
    <?php require_once("../MainHead/head.php");#llamar al header
    ?>

    <title>Lista de categorias</title>
</head>
<body class="with-side-menu">

	 <?php require_once("../MainHeader/header.php");
    ?>

	<div class="mobile-menu-left-overlay"></div>
	<?php require_once("../MainNav/nav.php");
    ?>

	<!-- Aqui empieza el contenido de la pagina -->
	<!-- Contenido -->
    <div class="page-content">
        <div class="container-fluid">


            <header class="section-header">
                <div class="tbl">
                    <div class="tbl-row">
                        <div class="tbl-cell">
                            <h3>Lista de categorias</h3>
                            <ol class="breadcrumb breadcrumb-simple">
                                <li><a href="#">Inicio</a></li>
                                <li class="active">Lista de categorias</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </header>


            <div class="box-typical box-typical-padding">
                <button type="button" id="btn_nuevacategoria" class = "btn btn-inline btn-primary">Registrar nueva categoria</button>
                <table id="categoria_info" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>
                            <th style="width: 5%;">Nombre</th>
                            <th class="text-center" style="width: 5%;">Editar</th>
                            <th class="text-center" style="width: 5%;">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>


                    </tbody>
                </table>
            </div>


        </div>
    </div>
    <!-- Contenido -->


    
	<?php require_once("registro_categoria.php"); ?>
	<?php require_once("../MainJavaScript/javascript.php"); ?>
	<script type="text/javascript" src="crud_categoria.js"></script>


</body>
</html>
<?php
  } else {
    header("Location:".Conectar::ruta()."index.php"); #si no nos manda a la ruta del index
  }
?>

