<?php
    require_once("../config/conexion.php");
    require_once("../models/Categoria.php");
    $categoria = new Categoria();


    switch($_GET["op"]){
        case "combo":
            $datos = $categoria->get_categoria();
            $html="";
            $html.="<option lavel='Seleccionar'></option>";
            if(is_array($datos)==true and count($datos)>0){
                
                foreach($datos as $row)
                {
                    $html.= "<option value='".$row['id_categoria']."'>".$row['nombre_categoria']."</option>";
                }
                echo $html;
            }
        break;

        case "guardaryeditar":
          if(empty($_POST["id_categoria"])){
             $categoria->insertar_categoria($_POST["nombre_categoria"]);
            
            }else{
             $categoria->editar_categoria($_POST["id_categoria"],$_POST["nombre_categoria"]);
             }
             break;       
        case "listar":
         $datos = $categoria->get_categoria();
         $data = array();
         foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["nombre_categoria"];
            $sub_array[] = '<button type="button" onClick="editar(' . $row["id_categoria"] . ');" id="' . $row["id_categoria"] . '" class="btn btn-inline btn-warning btn-sm ladda-button"><i class="fa fa-edit"></i></button>';
            $sub_array[] = '<button type="button" onClick="eliminar(' . $row["id_categoria"] . ');" id="' . $row["id_categoria"] . '" class="btn btn-inline btn-danger btn-sm ladda-button"><i class="fa fa-trash"></i></button>';

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
             $categoria->eliminar_categoria(
             $_POST["id_categoria"]
             );
             break;

       case "mostrar":
        $datos = $categoria->get_categoriaPor_id($_POST["id_categoria"]);
        if (is_array($datos)==true and count($datos) > 0) {
        foreach ($datos as $row) {
            $output["id_categoria"] = $row["id_categoria"];
            $output["nombre_categoria"] = $row["nombre_categoria"];
         
         }
         echo json_encode($output);
         }
         break;
    }
?>



