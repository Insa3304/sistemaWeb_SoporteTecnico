<?php



class Usuario extends Conectar{

    
    public function login(){
        $conectar=parent::conexion();
        parent::set_names();
        if(isset($_POST["enviar"])){
            $correo= $_POST["usuario_correo"];
            $contraseña= $_POST["usuario_contraseña"];
            $rol=$_POST["rol_id"];
            if(empty($correo)and empty($contraseña)){
                header("Location: ".Conectar::ruta()."view/index.php?m=2");
                exit();

            } else{
            
                $sql = "SELECT * FROM usuario WHERE usuario_correo = ? AND rol_id=? AND estado=1";
                $stmt=$conectar->prepare($sql);
                $stmt->bindValue(1,$correo);
                $stmt->bindValue(2,$rol);
                $stmt-> execute();
                $resultado = $stmt->fetch();
                if($resultado){
                    $textoCifrado = $resultado["usuario_contraseña"];

                     $key = "mi_key_secret";
                        $cipher = "aes-256-cbc";
                      
                $iv_dec = substr(base64_decode( $textoCifrado), 0, openssl_cipher_iv_length($cipher));
                $cifradoSinIV = substr(base64_decode( $textoCifrado), openssl_cipher_iv_length($cipher));
                $decifrado = openssl_decrypt($cifradoSinIV, $cipher, $key, OPENSSL_RAW_DATA, $iv_dec);

                if($decifrado==$contraseña){
                    
    
                        $_SESSION["id_usuario"]=$resultado["id_usuario"];
                        $_SESSION["usuario_nombre"]=$resultado["usuario_nombre"];
                        $_SESSION["usuario_apellido"]=$resultado["usuario_apellido"];
                         $_SESSION["rol_id"]=$resultado["rol_id"];
    
                        header("Location:".Conectar::ruta()."view/Home/");
                        exit();
                        
                    }else{
                        header("Location:".Conectar::ruta()."view/index.php?m=1");
                        exit();
    
                        
                    }
                    
                }
                }
                
                
            }
            

            
        }
    

    public function insertar_usuario($usuario_nombre,$usuario_apellido,$usuario_correo,$usuario_contraseña,$rol_id){

        $key = "mi_key_secret";
        $cipher = "aes-256-cbc";
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($cipher));
         $cifrado = openssl_encrypt($usuario_contraseña, $cipher, $key, OPENSSL_RAW_DATA, $iv);
          $textoCifrado= base64_encode($iv . $cifrado);

        $conectar= parent::conexion();
          $sql="INSERT INTO usuario (id_usuario,usuario_nombre, usuario_apellido, usuario_correo, usuario_contraseña, rol_id, fecha_creacion,
          fecha_modificacion, fecha_eliminacion, estado)
        VALUES (null,?, ?, ?,?, ?, now(), null, null,'1');";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usuario_nombre);
            $sql->bindValue(2, $usuario_apellido);
            $sql->bindValue(3, $usuario_correo);
            $sql->bindValue(4,  $textoCifrado);
            $sql->bindValue(5, $rol_id);
           
            $sql->execute();
            return $resultado=$sql->fetchAll();



    }

    
    public function editar_usuario($id_usuario,$usuario_nombre,$usuario_apellido,$usuario_correo,$usuario_contraseña,$rol_id){

        $key = "mi_key_secret";
        $cipher = "aes-256-cbc";
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($cipher));
         $cifrado = openssl_encrypt($usuario_contraseña, $cipher, $key, OPENSSL_RAW_DATA, $iv);
          $textoCifrado= base64_encode($iv . $cifrado);

         $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE usuario set usuario_nombre=?,
            usuario_apellido=?,
            usuario_correo=?,
            usuario_contraseña=?,
            rol_id=?
            WHERE
            id_usuario=?"
            ;
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usuario_nombre);
            $sql->bindValue(2, $usuario_apellido);
            $sql->bindValue(3, $usuario_correo);
            $sql->bindValue(4,  $textoCifrado);
            $sql->bindValue(5, $rol_id);
            $sql->bindValue(6, $id_usuario);
            $sql->execute();
            return $resultado=$sql->fetchAll();
    }

    
    public function eliminar_usuario($id_usuario){
             $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE usuario SET estado=0 WHERE id_usuario=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id_usuario);
            $sql->execute();
            return $resultado=$sql->fetchAll();


    }

    
    public function get_usuario(){
        $conectar= parent::conexion();
            parent::set_names();
            $sql="call sp_l_usuario_01()";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();

    }

     public function get_usuarioPorRol(){
        $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * from usuario where estado=1 and rol_id=2";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();

    }

    
    public function get_usuarioPor_id($id_usuario){
        $conectar= parent::conexion();
            parent::set_names();
            $sql="call sp_l_usuario02(?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id_usuario);
            $sql->execute();
            return $resultado=$sql->fetchAll();

    }

     public function get_usuarioTotal_Por_id($id_usuario){
        $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) as TOTAL FROM ticket where id_usuario=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id_usuario);
            $sql->execute();
            return $resultado=$sql->fetchAll();

    }

     public function get_usuarioTotalAbierto_Por_id($id_usuario){
        $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) as TOTAL FROM ticket where id_usuario=? AND estado_ticket='Abierto'";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id_usuario);
            $sql->execute();
            return $resultado=$sql->fetchAll();

    }
    public function get_usuarioTotalCerrado_Por_id($id_usuario){
        $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) as TOTAL FROM ticket where id_usuario=? AND estado_ticket='Cerrado'";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id_usuario);
            $sql->execute();
            return $resultado=$sql->fetchAll();

    }


     public function get_usuarioTotal(){
        $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) as TOTAL FROM ticket";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id_usuario);
            $sql->execute();
            return $resultado=$sql->fetchAll();

    }

     public function get_usuarioTotalAbierto(){
        $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) as TOTAL FROM ticket where id_usuario=? AND estado_ticket='Abierto'";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id_usuario);
            $sql->execute();
            return $resultado=$sql->fetchAll();

    }
    public function get_usuarioTotalCerrado(){
        $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) as TOTAL FROM ticket where id_usuario=? AND estado_ticket='Cerrado'";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id_usuario);
            $sql->execute();
            return $resultado=$sql->fetchAll();

    }

     public function get_ticketUsuario_grafico($id_usuario){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT categoria.nombre_categoria as nom,COUNT(*) AS total
                FROM   ticket  JOIN  
                    categoria ON ticket.id_categoria = categoria.id_categoria  
                WHERE    
                ticket.estado = 1
                and ticket.id_usuario=?
                GROUP BY
                categoria.nombre_categoria
                ORDER BY total DESC";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id_usuario);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }


            public function actualizarClave_usuario($id_usuario,$usuario_contraseña){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE usuario set
                usuario_contraseña = ?
                WHERE
                id_usuario = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usuario_contraseña);
            $sql->bindValue(2, $id_usuario);
            $sql->execute();
            return $resultado=$sql->fetchAll();

     }

    }

     

?>