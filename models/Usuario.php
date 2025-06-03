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
}
    

?>