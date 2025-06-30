<?php
    class Prioridad extends Conectar{


        public function get_prioridad(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM prioridad WHERE estado_prioridad=1;";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function insertar_prioridad($nombre_prioridad) {
            $conectar = parent::conexion();
            $sql = "INSERT INTO prioridad (id_prio,nombre_prioridad, estado_prioridad)
            VALUES (null,?,'1');";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $nombre_prioridad);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function editar_prioridad($id_prio, $nombre_prioridad) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE prioridad set nombre_prioridad=?
            WHERE
            id_prio=?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre_prioridad);
        $sql->bindValue(2, $id_prio);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function eliminar_prioridad($id_prio) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE prioridad SET estado_prioridad=0 WHERE id_prio=?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $id_prio);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function get_prioridadPor_id($id_prio) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM prioridad WHERE id_prio = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $id_prio);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    }
    
?>
