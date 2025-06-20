<?php
    require_once("../config/conexion.php");
    require_once("../models/Prioridad.php");
    $prioridad = new Prioridad();


    switch($_GET["op"]){
        case "combo":
            $datos = $prioridad->get_prioridad();
            $html="";
            $html.="<option lavel='Seleccionar'></option>";
            if(is_array($datos)==true and count($datos)>0){
                
                foreach($datos as $row)
                {
                    $html.= "<option value='".$row['id_prio']."'>".$row['nombre_prioridad']."</option>";
                }
                echo $html;
            }
              break;

        case "guardaryeditar":
          if(empty($_POST["id_prio"])){
             $prioridad->insertar_prioridad($_POST["nombre_prioridad"]);
            
            }else{
             $prioridad->editar_prioridad($_POST["id_prio"],$_POST["nombre_prioridad"]);
             }
             break;       
        case "listar":
         $datos = $prioridad->get_prioridad();
         $data = array();
         foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["nombre_prioridad"];
            $sub_array[] = '<button type="button" onClick="editar(' . $row["id_prio"] . ');" id="' . $row["id_prio"] . '" class="btn btn-inline btn-warning btn-sm ladda-button"><i class="fa fa-edit"></i></button>';
            $sub_array[] = '<button type="button" onClick="eliminar(' . $row["id_prio"] . ');" id="' . $row["id_prio"] . '" class="btn btn-inline btn-danger btn-sm ladda-button"><i class="fa fa-trash"></i></button>';

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

        case "eliminar":
             $prioridad->eliminar_prioridad(
             $_POST["id_prio"]
             );
             break;

       case "mostrar":
        $datos = $prioridad->get_prioridadPor_id($_POST["id_prio"]);
        if (is_array($datos)==true and count($datos) > 0) {
        foreach ($datos as $row) {
            $output["id_prio"] = $row["id_prio"];
            $output["nombre_prioridad"] = $row["nombre_prioridad"];
         
         }
         echo json_encode($output);
         }
         break;

    }
?>



