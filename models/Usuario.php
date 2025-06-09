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
            
                $sql = "SELECT * FROM usuario WHERE usuario_correo = ? AND usuario_contraseña=? AND rol_id=? AND estado=1";
                $stmt=$conectar->prepare($sql);
                $stmt->bindValue(1,$correo);
                $stmt->bindValue(2,$contraseña);
                $stmt->bindValue(3,$rol);
                $stmt-> execute();
                $resultado = $stmt->fetch();
                if(is_array($resultado) and count($resultado)>0){

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

    public function insertar_usuario($usuario_nombre,$usuario_apellido,$usuario_correo,$usuario_contraseña,$rol_id){

        $conectar= parent::conexion();
          $sql="INSERT INTO usuario (usuario_nombre, usuario_apellido, usuario_correo, usuario_contraseña, rol_id, fecha_creacion, estado)
VALUES (?, ?, ?, ?, ?, now(), '1');";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usuario_nombre);
            $sql->bindValue(2, $usuario_apellido);
            $sql->bindValue(3, $usuario_correo);
            $sql->bindValue(4, $usuario_contraseña);
            $sql->bindValue(5, $rol_id);
           
            $sql->execute();
            return $resultado=$sql->fetchAll();



    }

    
    public function editar_usuario($id_usuario,$usuario_nombre,$usuario_apellido,$usuario_correo,$usuario_contraseña,$rol_id){
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
            $sql->bindValue(4, $usuario_contraseña);
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
            $sql="SELECT*FROM usuario  WHERE estado='1'";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();

    }

    
    public function get_usuarioPor_id($id_usuario){
        $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT*FROM usuario WHERE id_usuario=?";
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
}
    

?>