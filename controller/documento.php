<?php
    require_once("../config/conexion.php");
    require_once("../models/documento.php");
    $documento = new Documento();


    /*TODO: opciones del controlador */
    switch($_GET["op"]){
        /* manejo de json para poder listar en el datatable */
      case "listar":
    $cipher = "aes-256-cbc";
    $key = "mi_key_secret"; // Usa la misma clave que usaste al cifrar

    // Validar si se recibió algo
    if (!isset($_POST["id_ticket"]) || empty($_POST["id_ticket"])) {
        die(json_encode(["error" => "ID Ticket no recibido."]));
    }

    $textoCifrado = $_POST["id_ticket"];
    $decoded = base64_decode($textoCifrado);

    if ($decoded === false || strlen($decoded) < openssl_cipher_iv_length($cipher)) {
        die(json_encode(["error" => "ID cifrado inválido."]));
    }

    $iv_length = openssl_cipher_iv_length($cipher);
    $iv = substr($decoded, 0, $iv_length);
    $cifrado = substr($decoded, $iv_length);

    $id_ticket = openssl_decrypt($cifrado, $cipher, $key, OPENSSL_RAW_DATA, $iv);

    if (!$id_ticket || !is_numeric($id_ticket)) {
        die(json_encode(["error" => "No se pudo descifrar el ID correctamente."]));
    }

    // Obtener los documentos
    $datos = $documento->get_documentoPorTicket($id_ticket);
    $data = [];

    foreach ($datos as $row) {
        $sub_array = [];
        $sub_array[] = '<a href="../../public/document/'.$id_ticket.'/'.$row["nombre_documento"].'" target="_blank">'.$row["nombre_documento"].'</a>';
        $sub_array[] = '<a type="button" href="../../public/document/'.$id_ticket.'/'.$row["nombre_documento"].'" target="_blank" class="btn btn-inline btn-primary btn-sm ladda-button"><i class="fa fa-eye"></i></a>';
        $data[] = $sub_array;
    }

    $results = [
        "sEcho" => 1,
        "iTotalRecords" => count($data),
        "iTotalDisplayRecords" => count($data),
        "aaData" => $data
    ];

    echo json_encode($results);
    break;
    }
?>




