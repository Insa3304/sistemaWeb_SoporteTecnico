<?php
    class Categoria extends Conectar{


        public function get_categoria(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM categoria WHERE estado=1;";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

    

        public function insertar_categoria($nombre_categoria) {
            $conectar = parent::conexion();
            $sql = "INSERT INTO categoria (id_categoria,nombre_categoria, estado)
            VALUES (null,?,'1');";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $nombre_categoria);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function editar_categoria($id_categoria, $nombre_categoria) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE categoria set nombre_categoria=?
            WHERE
            id_categoria=?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre_categoria);
        $sql->bindValue(2, $id_categoria);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function eliminar_categoria($id_categoria) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE categoria SET estado=0 WHERE id_categoria=?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $id_categoria);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function get_categoriaPor_id($id_categoria) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM categoria WHERE id_categoria = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $id_categoria);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }


    }
    
?>
