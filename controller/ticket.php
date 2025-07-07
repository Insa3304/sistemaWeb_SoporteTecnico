<?php
    require_once("../config/conexion.php");
    require_once("../models/Ticket.php");
    $ticket = new Ticket();

    require_once("../models/Usuario.php");
    $usuario = new Usuario();

     require_once("../models/Documento.php");
    $documento = new Documento();
     $key = "mi_key_secret";
    $cipher = "aes-256-cbc";
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($cipher));

    switch ($_GET["op"]) {
    case "insertar":
        $datos=$ticket->insertar_ticket(
            $_POST["id_usuario"],
            $_POST["id_categoria"],
            $_POST["titulo_ticket"],
            $_POST["descripcion_ticket"],
            $_POST["id_prioridad"]
        );
        if (is_array($datos)==true and count($datos)>0){
            foreach($datos as $row){
                $output["id_ticket"]= $row["id_ticket"];

                if(empty($_FILES['files']['name'])){

                }else{
                    $countfiles = count($_FILES['files']['name']);
                    $ruta= "../public/document/".$output["id_ticket"]."/";
                    $files_arr = array();

                    if(!file_exists($ruta)){
                        mkdir($ruta,0777,true);
                    }

                    for($index=0; $index<$countfiles; $index++){
                        $doc1 = $_FILES['files']['tmp_name'][$index];
                        $destino = $ruta.$_FILES['files']['name'][$index];

                        $documento->insert_documento($output["id_ticket"],$_FILES['files']['name'][$index]);

                        move_uploaded_file($doc1,$destino);

                    }
                }
            }
        }
        echo json_encode($datos);
        break;

       case "update":
    // Obtener el ID cifrado desde POST
    $id_ticket_cifrado = $_POST["id_ticket"];

    // Descifrado AES
    $iv_dec = substr(base64_decode($id_ticket_cifrado), 0, openssl_cipher_iv_length($cipher));
    $cifradoSinIV = substr(base64_decode($id_ticket_cifrado), openssl_cipher_iv_length($cipher));
    $decifrado = openssl_decrypt($cifradoSinIV, $cipher, $key, OPENSSL_RAW_DATA, $iv_dec);
    // Verificamos si se descifró correctamente

    // Actualizar el estado del ticket
    $ticket->actualizar_ticket($decifrado);

    // Registrar que el ticket fue cerrado por ese usuario
    $ticket->detalle_ticket_cerrado($decifrado, $_POST["id_usuario"]);
    echo $decifrado;
    break;


         case "reabrir_ticket":
        $ticket->reabrir_ticket($_POST["id_ticket"]);
              $ticket->detalle_ticket_reabrir($_POST["id_ticket"],$_POST["id_usuario"]);
        break;



         case "asignar_usuario":
        
            $ticket->asignacion_Ticket($_POST["id_ticket"],$_POST["usuario_asignado"]);
        break;

    case "listaTicket_por_usuario":
        $datos = $ticket->listarTicket_por_usuario($_POST["id_usuario"]);
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["id_ticket"];
            $sub_array[] = $row["nombre_categoria"];
            $sub_array[] = $row["titulo_ticket"];
            $sub_array[] = $row["nombre_prioridad"];
            
            if ($row["estado_ticket"] == "Abierto") {
                $sub_array[] = '<span class="label label-pill label-success">Abierto</span>';
            } else {
                $sub_array[] = '<a onClick="Cambiar_estado('. $row["id_ticket"]. ')"><span class="label label-pill label-danger">Cerrado</span><a>';
            }
            $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fecha_TicketCreacion"]));

            if($row["fecha_asignacion"]==null){
                  $sub_array[] = '<span class="label label-pill label-danger">Sin asignar</span>';
            }else{
                 $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fecha_asignacion"]));
            }

            if($row["fecha_cierre"]==null){
                  $sub_array[] = '<span class="label label-pill label-danger">Sin cerrar</span>';
            }else{
                 $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fecha_cierre"]));
            }

             if($row["usuario_asignado"]==null){

                 $sub_array[] = '<span class="label label-pill label-warning">Técnico no asignado</span>';
            }else{

                $datos1=$usuario->get_usuarioPor_id($row["usuario_asignado"]);
                foreach($datos1 as $row1){
                     $sub_array[] = '<span class="label label-pill label-success">'.$row1["usuario_nombre"] .'</span>';
                }
            }
            
             $cifrado = openssl_encrypt($row["id_ticket"], $cipher, $key, OPENSSL_RAW_DATA, $iv);
              $textoCifrado = base64_encode($iv . $cifrado);
            $sub_array[] = '<button type="button" data-ciphertext="' . $textoCifrado.'" id="' .  $textoCifrado . '" class="btn btn-inline btn-primary btn-sm ladda-button"><i class="fa fa-eye"></i></button>';

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
            $sub_array[] = $row["nombre_prioridad"];
            if ($row["estado_ticket"] == "Abierto") {
                $sub_array[] = '<span class="label label-pill label-success">Abierto</span>';
            } else {
                $sub_array[] = '<a onClick="Cambiar_estado('. $row["id_ticket"]. ')"><span class="label label-pill label-danger">Cerrado</span><a>';
            }
            $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fecha_TicketCreacion"]));

            if($row["fecha_asignacion"]==null){
                  $sub_array[] = '<span class="label label-pill label-danger">Sin asignar</span>';
            }else{
                 $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fecha_asignacion"]));
            }

            if($row["fecha_cierre"]==null){
                  $sub_array[] = '<span class="label label-pill label-danger">Sin cerrar</span>';
            }else{
                 $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fecha_cierre"]));
            }

             if($row["usuario_asignado"]==null){

                 $sub_array[] = '<a onClick="asignar('.$row["id_ticket"].');"><span class="label label-pill label-warning">Técnico no asignado</span></a>';
            }else{

                $datos1=$usuario->get_usuarioPor_id($row["usuario_asignado"]);
                foreach($datos1 as $row1){
                     $sub_array[] = '<span class="label label-pill label-success">'.$row1["usuario_nombre"] .'</span>';
                }
            }


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


        case "listar_filtro":

        $datos = $ticket->filtrar_ticket($_POST["titulo_ticket"],$_POST["id_categoria"],$_POST["id_prioridad"]);
        $data = array();
        foreach ($datos as $row) {

           
            $sub_array = array();
            $sub_array[] = $row["id_ticket"];
            $sub_array[] = $row["nombre_categoria"];
            $sub_array[] = $row["titulo_ticket"];
            $sub_array[] = $row["nombre_prioridad"];
            if ($row["estado_ticket"] == "Abierto") {
                $sub_array[] = '<span class="label label-pill label-success">Abierto</span>';
            } else {
                $sub_array[] = '<a onClick="Cambiar_estado('. $row["id_ticket"]. ')"><span class="label label-pill label-danger">Cerrado</span><a>';
            }
            $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fecha_TicketCreacion"]));

            if($row["fecha_asignacion"]==null){
                  $sub_array[] = '<span class="label label-pill label-danger">Sin asignar</span>';
            }else{
                 $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fecha_asignacion"]));
            }

            if($row["fecha_cierre"]==null){
                  $sub_array[] = '<span class="label label-pill label-danger">Sin cerrar</span>';
            }else{
                 $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fecha_cierre"]));
            }

             if($row["usuario_asignado"]==null){

                 $sub_array[] = '<a onClick="asignar('.$row["id_ticket"].');"><span class="label label-pill label-warning">Técnico no asignado</span></a>';
            }else{

                $datos1=$usuario->get_usuarioPor_id($row["usuario_asignado"]);
                foreach($datos1 as $row1){
                     $sub_array[] = '<span class="label label-pill label-success">'.$row1["usuario_nombre"] .'</span>';
                }
            }
             $cifrado = openssl_encrypt($row["id_ticket"], $cipher, $key, OPENSSL_RAW_DATA, $iv);
              $textoCifrado = base64_encode($iv . $cifrado);
            $sub_array[] = '<button type="button" data-ciphertext="' . $textoCifrado.'" id="' .  $textoCifrado . '" class="btn btn-inline btn-primary btn-sm ladda-button"><i class="fa fa-eye"></i></button>';
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

                $iv_dec = substr(base64_decode($_POST["id_ticket"]), 0, openssl_cipher_iv_length($cipher));
                $cifradoSinIV = substr(base64_decode($_POST["id_ticket"]), openssl_cipher_iv_length($cipher));
                $decifrado = openssl_decrypt($cifradoSinIV, $cipher, $key, OPENSSL_RAW_DATA, $iv_dec);

        $datos=$ticket-> listar_detalle_ticket($decifrado);
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

    $id_ticket_recibido = $_POST["id_ticket"];

    // Si es numérico, úsalo sin descifrar
    if (ctype_digit($id_ticket_recibido)) {
        $decifrado = $id_ticket_recibido;
    } else {
        // Intentar descifrar
        $decoded_base64 = base64_decode($id_ticket_recibido, true);
        if ($decoded_base64 === false) {
            die("ERROR: El ID no es Base64 y no es numérico.");
        }
        $iv_length = openssl_cipher_iv_length($cipher);
        if (strlen($decoded_base64) < $iv_length) {
            die("ERROR: El Base64 recibido es muy corto.");
        }

        $iv_dec = substr($decoded_base64, 0, $iv_length);
        $cifradoSinIV = substr($decoded_base64, $iv_length);
        $decifrado = openssl_decrypt($cifradoSinIV, $cipher, $key, OPENSSL_RAW_DATA, $iv_dec);
        if ($decifrado === false) {
            die("ERROR: No se pudo descifrar el ID.");
        }
    }

    $datos = $ticket->listar_ticketporID($decifrado);

    if (is_array($datos) && count($datos) > 0) {
        foreach ($datos as $row) {
            $output["id_ticket"] = $row["id_ticket"];
            $output["id_usuario"] = $row["id_usuario"];
            $output["id_categoria"] = $row["id_categoria"];
            $output["titulo_ticket"] = $row["titulo_ticket"];
            $output["descripcion_ticket"] = $row["descripcion_ticket"];
            if ($row["estado_ticket"] == "Abierto") {
                $output["estado_ticket"] = '<span class="label label-pill label-success">Abierto</span>';
            } else {
                $output["estado_ticket"] = '<span class="label label-pill label-danger">Cerrado</span>';
            }

            $output["estado_ticket_texto"] = $row["estado_ticket"];
            $output["fecha_TicketCreacion"] = date("d/m/Y H:i:s", strtotime($row["fecha_TicketCreacion"]));
            $output["fecha_cierre"] = date("d/m/Y H:i:s", strtotime($row["fecha_cierre"]));
            $output["usuario_nombre"] = $row["usuario_nombre"];
            $output["usuario_apellido"] = $row["usuario_apellido"];
            $output["nombre_categoria"] = $row["nombre_categoria"];
            $output["nombre_prioridad"] = $row["nombre_prioridad"];
        }
        echo json_encode($output);
    }
    break;



             case "insertar_detalle":
                $iv_dec = substr(base64_decode($_POST["id_ticket"]), 0, openssl_cipher_iv_length($cipher));
            $cifradoSinIV = substr(base64_decode($_POST["id_ticket"]), openssl_cipher_iv_length($cipher));
            $decifrado = openssl_decrypt($cifradoSinIV, $cipher, $key, OPENSSL_RAW_DATA, $iv_dec);
         
             $datos=$ticket->insertar_ticketdetalle($decifrado,$_POST["id_usuario"],$_POST["detalle_descripcion_ticket"]);

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
