
<?php
  require_once("../../config/conexion.php"); #validacion para evitar que ingrese cualquiera
  if(isset($_SESSION["id_usuario"])){
?>


<!DOCTYPE html>
<html>
    <?php require_once("../MainHead/head.php");#llamar al header
    ?>

    <title>Consultar tickets</title>
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
                            <h3>Consultar Ticket</h3>
                            <ol class="breadcrumb breadcrumb-simple">
                                <li><a href="#">Inicio</a></li>
                                <li class="active">Consultar Ticket</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </header>


            <div class="box-typical box-typical-padding">
                <div class="row" id="vista_usuario">
                    <div class="col-lg-3">
                        <fieldset class="form-group">
                            <label class="form-label" for="titulo_ticket">Titulo</label>
                            <input type="text" class="form-control" id="titulo_ticket" name="titulo_ticket" placeholder="Ingrese Titulo" required>
                        </fieldset>
                    </div>

                    <div class="col-lg-3">
                        <fieldset class="form-group">
                            <label class="form-label" for="id_categoria">Categoria</label>
                            <select class="select2" id="id_categoria" name="id_categoria" data-placeholder="Seleccionar">
                                <option label="Seleccionar"></option>
                            </select>
                        </fieldset>
                    </div>

                    <div class="col-lg-2">
                        <fieldset class="form-group">
                            <label class="form-label" for="id_prioridad">Prioridad</label>
                            <select class="select2" id="id_prioridad" name="id_prioridad" data-placeholder="Seleccionar">
                                <option label="Seleccionar"></option>
                            </select>
                        </fieldset>
                    </div>
                    <div class="col-lg-2">
                        <fieldset class="form-group">
                            <label class="form-label" for="btnfiltrar">&nbsp;</label>
                            <button type="submit" class="btn btn-rounded btn-primary btn-block" id="btnfiltrar">Filtrar</button>
                        </fieldset>
                    </div>

                    <div class="col-lg-2">
                        <fieldset class="form-group">
                            <label class="form-label" for="btnlimpiar">&nbsp;</label>
                            <button type="submit" class="btn btn-rounded btn-primary btn-block" id="btnlimpiar">Limpiar</button>
                        </fieldset>
                    </div>
  </div>



                 <div class="box-typical box-typical-padding" id="table"> 
                <table id="ticket_info" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>
                            <th style="width: 5%;">N° de Ticket</th>
                            <th style="width: 15%;">Categoria</th>
                            <th class="d-none d-sm-table-cell" style="width: 20%;">Titulo</th>
                            <th class="d-none d-sm-table-cell" style="width: 10%;">Prioridad</th>
                            <th class="d-none d-sm-table-cell" style="width: 5%;">Estado</th>
                            <th class="d-none d-sm-table-cell" style="width: 10%;">Fecha Creación</th>
                            <th class="d-none d-sm-table-cell" style="width: 10%;">Fecha de asignación</th>
                            <th class="d-none d-sm-table-cell" style="width: 10%;">Fecha de cierre</th>
                            <th class="d-none d-sm-table-cell" style="width: 10%;">Técnico asignado</th>
                            <th class="text-center" style="width: 5%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>


        </div>
    </div>
    <!-- Contenido -->

    <?php require_once("asignarticket.php") ?>

	<?php require_once("../MainJavaScript/javascript.php") ?>
	<script type="text/javascript" src="consultarticket.js"></script>


</body>
</html>
<?php
  } else {
    header("Location:".Conectar::ruta()."index.php"); #si no nos manda a la ruta del index
  }
?>

