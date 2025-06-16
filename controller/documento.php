<?php
    require_once("../config/conexion.php");
    require_once("../models/documento.php");
    $documento = new Documento();


    /*TODO: opciones del controlador */
    switch($_GET["op"]){
        /* manejo de json para poder listar en el datatable */
        case "listar":
            $datos=$documento->get_documentoPorTicket($_POST["id_ticket"]);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = '<a href="../../public/document/'.$_POST["id_ticket"].'/'.$row["nombre_documento"].
                '" target="_blank">'.$row["nombre_documento"].'</a>';
                /* TODO: Formato HTML para abrir el documento o descargarlo en una nueva ventana */
                $sub_array[] = '<a type="button" href="../../public/document/'.$_POST["id_ticket"].'/'
                .$row["nombre_documento"].'" target="_blank" class="btn btn-inline btn-primary btn-sm ladda-button"><i class="fa fa-eye"></i></a>';
                $data[] = $sub_array;
            }


            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
        break;
    }
?>




