<?php
    require_once("../config/conexion.php");
    require_once("../models/Ticket.php");
    $ticket = new Ticket();


    switch ($_GET["op"]) {
    case "insertar":
        $ticket->insertar_ticket(
            $_POST["id_usuario"],
            $_POST["id_categoria"],
            $_POST["titulo_ticket"],
            $_POST["descripcion_ticket"]
        );
        break;

        case "update":
        $ticket->actualizar_ticket(
            $_POST["id_ticket"]
        );

        $ticket->detalle_ticket_cerrado(
            $_POST["id_ticket"],$_POST["id_usuario"]
        );
        break;

    case "listaTicket_por_usuario":
        $datos = $ticket->listarTicket_por_usuario($_POST["id_usuario"]);
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["id_ticket"];
            $sub_array[] = $row["nombre_categoria"];
            $sub_array[] = $row["titulo_ticket"];
            if ($row["estado_ticket"] == "Abierto") {
                $sub_array[] = '<span class="label label-pill label-success">Abierto</span>';
            } else {
                $sub_array[] = '<span class="label label-pill label-danger">Cerrado</span>';
            }
            $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fecha_TicketCreacion"]));
            $sub_array[] = '<button type="button" onClick="ver(' . $row["id_ticket"] . ');" id="' . $row["id_ticket"] . '" class="btn btn-inline btn-primary btn-sm ladda-button"><i class="fa fa-eye"></i></button>';
            $data[] = $sub_array;
        }

        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($results);
        break;

        case "listar":

        $datos = $ticket->listar_ticket();
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["id_ticket"];
            $sub_array[] = $row["nombre_categoria"];
            $sub_array[] = $row["titulo_ticket"];
            if ($row["estado_ticket"] == "Abierto") {
                $sub_array[] = '<span class="label label-pill label-success">Abierto</span>';
            } else {
                $sub_array[] = '<span class="label label-pill label-danger">Cerrado</span>';
            }
            $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fecha_TicketCreacion"]));
            $sub_array[] = '<button type="button" onClick="ver(' . $row["id_ticket"] . ');" id="' . $row["id_ticket"] . '" class="btn btn-inline btn-primary btn-sm ladda-button"><i class="fa fa-eye"></i></button>';
            $data[] = $sub_array;
        }

        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($results);
        break;


        case "listardetalle":
        $datos=$ticket-> listar_detalle_ticket($_POST["id_ticket"]);
        ?>
        <?php
        foreach($datos as $row){

            ?>
           	<article class="activity-line-item box-typical">
					<div class="activity-line-date">
						<?php echo date("d/m/Y H:i:s", strtotime($row["fecha_TicketCreacion"]));?>
					</div>
					<header class="activity-line-item-header">
						<div class="activity-line-item-user">
							<div class="activity-line-item-user-photo">
								<a href="#">
									<img src="../../public/<?php echo $row['rol_id']?>.png" alt="">
								</a>
							</div>
							<div class="activity-line-item-user-name"><?php echo $row['usuario_nombre'].' '.$row['usuario_apellido'];?></div>
							<div class="activity-line-item-user-status">
                                <?php
                                if($row['rol_id']==1){
                                    echo 'Usuario';
                                }else{
                                    echo 'Soporte';

                                    }
                                    ?>
                                    </div>
						</div>
					</header>
					<div class="activity-line-action-list">
						<section class="activity-line-action">
							<div class="time"><?php echo date("H:i:s", strtotime($row["fecha_TicketCreacion"]));?></div>
							<div class="cont">
								<div class="cont-in">
									<p><?php echo ($row["detalle_descripcion_ticket"]);?></p>
								</div>
							</div>
						</section>
					
						
					</div>
				</article>
            <?php
            
            
        }
        ?>
        <?php

        break;
         case "mostrar":

          
            $datos=$ticket->listar_ticketporID($_POST["id_ticket"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["id_ticket"] = $row["id_ticket"];
                    $output["id_usuario"] = $row["id_usuario"];
                    $output["id_categoria"] = $row["id_categoria"];
                    $output["titulo_ticket"] = $row["titulo_ticket"];
                    $output["descripcion_ticket"] = $row["descripcion_ticket"];
                    if ($row["estado_ticket"]=="Abierto"){
                        $output["estado_ticket"] = '<span class="label label-pill label-success">Abierto</span>';
                    }else{
                        $output["estado_ticket"] = '<span class="label label-pill label-danger">Cerrado</span>';
                    }
                  

                     $output["estado_ticket_texto"] = $row["estado_ticket"];
                    $output["fecha_TicketCreacion"] = date("d/m/Y H:i:s", strtotime($row["fecha_TicketCreacion"]));
                  
                    $output["usuario_nombre"] = $row["usuario_nombre"];
                    $output["usuario_apellido"] = $row["usuario_apellido"];
                    $output["nombre_categoria"] = $row["nombre_categoria"];
                    
                  
                }
                echo json_encode($output);
            }
            break;


             case "insertar_detalle":
        $ticket->insertar_ticketdetalle(
            $_POST["id_ticket"],
            $_POST["id_usuario"],
            $_POST["detalle_descripcion_ticket"],
            
        );
        break;

         case "total":
    $datos = $ticket->get_ticketTotal();
    if (is_array($datos)==true and count($datos) > 0) {
        foreach ($datos as $row) {
            $output["TOTAL"] = $row["TOTAL"];
           
        }
        echo json_encode($output);
    }
        break;

         case "totalabierto":
    $datos = $ticket->get_ticketTotalAbierto();
    if (is_array($datos)==true and count($datos) > 0) {
        foreach ($datos as $row) {
            $output["TOTAL"] = $row["TOTAL"];
           
        }
        echo json_encode($output);
        break;
    }

    case "totalcerrado":
        $datos = $ticket->get_ticketTotalCerrado();
    if (is_array($datos)==true and count($datos) > 0) {
        foreach ($datos as $row) {
            $output["TOTAL"] = $row["TOTAL"];
           
        }
        echo json_encode($output);
        break;

    }

    case "grafico";
    $datos=$ticket-> get_ticket_grafico();
    echo json_encode($datos);
    break;




        
}


?>
