<?php
  require_once("../../config/conexion.php");
  if(isset($_SESSION["id_usuario"])){
?>
<!DOCTYPE html>
<html>
    <?php require_once("../MainHead/head.php");?>
    <title>Consultar Ticket</title>
</head>
<body class="with-side-menu">

    <?php require_once("../MainHeader/header.php");?>
    <div class="mobile-menu-left-overlay"></div>
    <?php require_once("../MainNav/nav.php");?>

    <!-- Contenido -->
    <div class="page-content">
        <div class="container-fluid">

        <header class="section-header">
          <div class="tbl">
            <div class="tbl-row">
              <div class="tbl-cell">
                <h3 id="numidticket">Detalle Ticket</h3>
                <div id="estado">  </div>
                <span class="label label-pill label-primary" id="nombre_usuario"></span>
                <span class="label label-pill label-default" id="fecha_TicketCreacion"></span>
                <ol class="breadcrumb breadcrumb-simple">
                  <li><a href="#">Inicio</a></li>
                  <li class="active">Detalle Ticket</li>
                </ol>
              </div>
            </div>
          </div>
        </header>

        <div class="box-typical box-typical-padding">
          <div class="row">
            <!-- Título ocupa toda la fila -->
            <div class="col-lg-6">
              <fieldset class="form-group">
                <label class="form-label semibold" for="ticket_titulo">Título</label>
                <input type="text" class="form-control" id="ticket_titulo" name="ticket_titulo" readonly>
              </fieldset>
            </div>

            <!-- Categoría y descripción en columnas separadas -->
            <div class="col-lg-6">
              <fieldset class="form-group">
                <label class="form-label semibold" for="categoria_nombre">Categoría</label>
                <input type="text" class="form-control" id="categoria_nombre" name="categoria_nombre" readonly>
              </fieldset>
            </div>

            <div class="col-lg-6">
              <fieldset class="form-group">
                <label class="form-label semibold" for="categoria_nombre">Prioridad</label>
                <input type="text" class="form-control" id="nombre_prioridad" name="nombre_prioridad" readonly>
              </fieldset>
            </div>


            <div class="col-lg-12">
                <fieldset class="form-group">
                  <label class="form-label semibold" for="ticket_titulo">Documentos Adicionales</label>
                  <table id="documentos_info" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                      <tr>
                        <th style="width: 90%;">Nombre</th>
                        <th class="text-center" style="width: 10%;"></th>
                      </tr>
                    </thead>
                    <tbody>


                    </tbody>
                  </table>
                </fieldset>
              </div>

            <div class="col-lg-12">
              <fieldset class="form-group">
                <label class="form-label semibold" for="detalle_descripcion_ticket_usuario">Descripción</label>
                <div class="summernote-theme-5">
                    <textarea id="detalle_descripcion_ticket_usuario" name="detalle_descripcion_ticket_usuario" class="summernote" name="name"></textarea>
                  </div>
              </fieldset>
            </div>

          </div>
        </div>

        <section class="activity-line" id="detalleDelTicket">
        
        </section>

       
        <div class="box-typical box-typical-padding" id="panel_detalle">
          <h5 class="m-t-lg with-border">Ingresar Información</h5>
          <div class="row">
           
          
              <div class="col-lg-12">
                <fieldset class="form-group">
                  <label class="form-label semibold" for="detalle_descripcion_ticket">Descripción</label>
                  <div class="summernote-theme-5">
                    <textarea id="detalle_descripcion_ticket" name="descripcion_ticket" class="summernote" name="name">Ingresa aqui la descripcion</textarea>
                  </div>
                </fieldset>
              </div>
              <div class="col-lg-12">
                <button type="button"  id="btnenviar" class="btn btn-rounded btn-inline btn-primary">Enviar</button>
                <button type="button"  id="btncerrar" class="btn btn-rounded btn-inline btn-danger">Cerrar Ticket</button>
              </div>
            </form>
          </div>
        </div>


  


        </div>
    </div>
    <!-- Contenido -->

    <?php require_once("../MainJavaScript/javascript.php"); ?>
    <script type="text/javascript" src="detalleticket.js"></script>

    
</body>
</html>
<?php
  } else {
    header("Location:".Conectar::ruta()."index.php");
  }
?>
