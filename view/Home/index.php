<?php
  require_once("../../config/conexion.php");
  if(isset($_SESSION["id_usuario"])){
  ?>
  

<!DOCTYPE html>
<html>
    <?php require_once("../MainHead/head.php");?>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    
    <link rel="stylesheet" href="../../public/css/separate/pages/calendar.min.css">
    <title>Resumen Dashboard</title>
</head>
<body class="with-side-menu">


    <?php require_once("../MainHeader/header.php");?>


    <div class="mobile-menu-left-overlay"></div>


    <?php require_once("../MainNav/nav.php");?>


    <!-- Contenido -->
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-sm-4">
                            <article class="statistic-box green">
                                <div>
                                    <div class="number" id="lbltotal"></div>
                                    <div class="caption"><div>Total de Tickets</div></div>
                                </div>
                            </article>
                        </div>
                        <div class="col-sm-4">
                            <article class="statistic-box yellow">
                                <div>
                                    <div class="number" id="lbltotalabierto"></div>
                                    <div class="caption"><div>Total de Tickets Abiertos</div></div>
                                </div>
                            </article>
                        </div>
                        <div class="col-sm-4">
                            <article class="statistic-box red">
                                <div>
                                    <div class="number" id="lbltotalcerrado"></div>
                                    <div class="caption"><div>Total de Tickets Cerrados</div></div>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
                <div id="myfirstchart" style="height: 250px;"></div>
            </div>


            <section class="card">
                <header class="card-header">
                    Grafico de incidencias
                </header>
                <div class="card-block">
                    <div id="div_grafico" style="height: 250px;"></div>
                </div>
            </section>


           

        </div>
    </div>
    <!-- Contenido -->


    <?php require_once("../MainJavaScript/javascript.php");?>


    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>


    <script type="text/javascript" src="../../public/js/lib/moment/moment-with-locales.min.js"></script>
    


    <script type="text/javascript" src="home.js"></script>


    <script type="text/javascript" src="../notificacion.js"></script>


</body>
</html>
<?php
  } else {
    header("Location:".Conectar::ruta()."index.php");
  }
?>


