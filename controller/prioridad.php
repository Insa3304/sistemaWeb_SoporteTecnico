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
    }
?>



