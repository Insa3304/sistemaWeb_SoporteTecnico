<?php
    require_once("../config/conexion.php");
    require_once("../models/Usuario.php");
    $usuario = new Usuario();


    switch($_GET["op"]){
        case "guardaryeditar":
           if(empty($_POST["id_usuario"])){
           
                $usuario->insertar_usuario($_POST["usuario_nombre"],$_POST["usuario_apellido"],$_POST["usuario_correo"],$_POST["usuario_contraseña"],$_POST["rol_id"]);
            
           }else{
            $usuario->editar_usuario($_POST["id_usuario"],$_POST["usuario_nombre"],$_POST["usuario_apellido"],$_POST["usuario_correo"],$_POST["usuario_contraseña"],$_POST["rol_id"]);
           }
        break;
        
        
        case "listar":
         $datos = $usuario->get_usuario();
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["usuario_nombre"];
            $sub_array[] = $row["usuario_apellido"];
            $sub_array[] = $row["usuario_correo"];
            $sub_array[] = $row["usuario_contraseña"];

            if ($row["rol_id"] == "1") {
                $sub_array[] = '<span class="label label-pill label-primary">Usuario</span>';
            } else {
                $sub_array[] = '<span class="label label-pill label-info">Soporte</span>';
            }
           
           
            $sub_array[] = '<button type="button" onClick="editar(' . $row["id_usuario"] . ');" id="' . $row["id_usuario"] . '" class="btn btn-inline btn-warning btn-sm ladda-button"><i class="fa fa-edit"></i></button>';
            $sub_array[] = '<button type="button" onClick="eliminar(' . $row["id_usuario"] . ');" id="' . $row["id_usuario"] . '" class="btn btn-inline btn-danger btn-sm ladda-button"><i class="fa fa-trash"></i></button>';

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
             $usuario->eliminar_usuario(
            $_POST["id_usuario"]
        );
        break;

       case "mostrar":
    $datos = $usuario->get_usuarioPor_id($_POST["id_usuario"]);
    if (is_array($datos)==true and count($datos) > 0) {
        foreach ($datos as $row) {
            $output["id_usuario"] = $row["id_usuario"];
            $output["usuario_nombre"] = $row["usuario_nombre"];
            $output["usuario_apellido"] = $row["usuario_apellido"];
            $output["usuario_correo"] = $row["usuario_correo"];
            $output["usuario_contraseña"] = $row["usuario_contraseña"];
            $output["rol_id"] = $row["rol_id"];
        }
        echo json_encode($output);
    }
    break;

    
     case "total":
    $datos = $usuario->get_usuarioTotal_Por_id($_POST["id_usuario"]);
    if (is_array($datos)==true and count($datos) > 0) {
        foreach ($datos as $row) {
            $output["TOTAL"] = $row["TOTAL"];
           
        }
        echo json_encode($output);
    }
        break;

         case "totalabierto":
    $datos = $usuario->get_usuarioTotalabierto_Por_id($_POST["id_usuario"]);
    if (is_array($datos)==true and count($datos) > 0) {
        foreach ($datos as $row) {
            $output["TOTAL"] = $row["TOTAL"];
           
        }
        echo json_encode($output);
        break;
    }

     case "totalcerrado":
    $datos = $usuario->get_usuarioTotalcerrado_Por_id($_POST["id_usuario"]);
    if (is_array($datos)==true and count($datos) > 0) {
        foreach ($datos as $row) {
            $output["TOTAL"] = $row["TOTAL"];
           
        }
        echo json_encode($output);
        break;

    }

      case "grafico";
    $datos=$usuario-> get_ticketUsuario_grafico($_POST["id_usuario"]);
    echo json_encode($datos);
    break;


  
    }

?>



