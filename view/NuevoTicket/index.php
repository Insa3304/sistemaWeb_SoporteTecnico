
<?php
  require_once("../../config/conexion.php"); #validacion para evitar que ingrese cualquiera
  if(isset($_SESSION["id_usuario"])){
?>


<!DOCTYPE html>
<html>
    <?php require_once("../MainHead/head.php");#llamar al header
    ?>

    <title>Nuevo ticket</title>
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
			<header class="section-header">
                <div class="tbl">
                    <div class="tbl-row">
                        <div class="tbl-cell">
                            <h3>Nuevo Ticket</h3>
                            <ol class="breadcrumb breadcrumb-simple">
                                <li><a href="#">Inicio</a></li>
                                <li class="active">Nuevo Ticket</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </header>


            <div class="box-typical box-typical-padding">
                <p>
                    Por favor ingrese los detalles del ticket.
                </p>


                <h5 class="m-t-lg with-border">Ingresar Información</h5>


                <div class="row">
                    <form method="post" id="ticket_form">


                        <input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo $_SESSION["id_usuario"] ?>">


                         <div class="col-lg-12">
                            <fieldset class="form-group">
                                <label class="form-label semibold" for="titulo_ticket">Titulo</label>
                                <input type="text" class="form-control" id="titulo_ticket" name="titulo_ticket" placeholder="Ingrese Titulo">
                            </fieldset>
                        </div>


                        <div class="col-lg-6">
                            <fieldset class="form-group">
                                <label class="form-label semibold" for="exampleInput">Categoria</label>
                                <select id="id_categoria" name="id_categoria" class="form-control">
                                    
                                   
                                </select>
                            </fieldset>
                        </div>

                         <div class="col-lg-6">
                            <fieldset class="form-group">
                                <label class="form-label semibold" for="exampleInput">Documentos adicionales</label>
                                <input type="file" name="fileElem" id="fileElem" class="form-control" multiple>
                                    
                                   
                                </select>
                            </fieldset>
                        </div>

                        <div class="col-lg-6">
                            <fieldset class="form-group">
                                <label class="form-label semibold" for="exampleInput">Prioridad</label>
                                <select id="id_prioridad" name="id_prioridad" class="form-control">
                                    
                                   
                                </select>
                            </fieldset>
                        </div>
                       
                        <div class="col-lg-12"> 
                            <fieldset class="form-group">
                                <label class="form-label semibold" for="ticket_descripcion">Descripción</label>
                               <div class="summernote-theme-5">
					            <textarea id="ticket_descripcion" name="descripcion_ticket" class="summernote" name="name">Ingresa aqui la descripcion</textarea>
				                 </div>


                            </fieldset>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" name="action" value="add" class="btn btn-rounded btn-inline btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>


	<!-- Aqui termina el contenido -->

	<?php require_once("../MainJavaScript/javascript.php") ?>
	<script type="text/javascript" src="nuevoticket.js"></script>


</body>
</html>
<?php
  } else {
    header("Location:".Conectar::ruta()."index.php"); #si no nos manda a la ruta del index
  }
?>

