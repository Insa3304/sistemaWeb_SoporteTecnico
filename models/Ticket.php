<?php
    class Ticket extends Conectar{


        public function insertar_ticket($id_usuario,$id_categoria,$titulo_ticket,$descripcion_ticket){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO ticket (id_ticket,id_usuario, id_categoria, titulo_ticket, descripcion_ticket,estado_ticket,fecha_TicketCreacion, estado) VALUES (NULL,?, ?, ?, ?,'Abierto',now() ,'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$id_usuario);
            $sql->bindValue(2,$id_categoria);
            $sql->bindValue(3,$titulo_ticket);
            $sql->bindValue(4,$descripcion_ticket);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function listarTicket_por_usuario($id_usuario){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
                ticket.id_ticket,
                ticket.id_usuario,
                ticket.id_categoria,
                ticket.titulo_ticket,
                ticket.descripcion_ticket,
                ticket.estado_ticket,
                ticket.fecha_TicketCreacion,
                usuario.usuario_nombre,
                usuario.usuario_apellido,
                categoria.nombre_categoria
                FROM
                ticket
                INNER join categoria on ticket.id_categoria = categoria.id_categoria
                INNER join usuario on ticket.id_usuario = usuario.id_usuario
                WHERE
                ticket.estado = 1
                AND usuario.id_usuario=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id_usuario);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function listar_ticket(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
                ticket.id_ticket,
                ticket.id_usuario,
                ticket.id_categoria,
                ticket.titulo_ticket,
                ticket.descripcion_ticket,
                ticket.estado_ticket,
                ticket.fecha_TicketCreacion,
                usuario.usuario_nombre,
                usuario.usuario_apellido,
                categoria.nombre_categoria
                FROM
                ticket
                INNER join categoria on ticket.id_categoria = categoria.id_categoria
                INNER join usuario on ticket.id_usuario = usuario.id_usuario
                WHERE
                ticket.estado = 1
                ";
            $sql=$conectar->prepare($sql);
            
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function listar_detalle_ticket($id_ticket){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
                detalle_ticket.key_id_ticket,
                detalle_ticket.detalle_descripcion_ticket,
                detalle_ticket.fecha_TicketCreacion,
                usuario.usuario_nombre,
                usuario.usuario_apellido,
                usuario.rol_id
                FROM
                detalle_ticket
                INNER join usuario on detalle_ticket.id_usuario = usuario.id_usuario
                WHERE
                id_ticket =?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id_ticket);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
          public function listar_ticketporID($id_ticket){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
                ticket.id_ticket,
                ticket.id_usuario,
                ticket.id_categoria,
                ticket.titulo_ticket,
                ticket.descripcion_ticket,
                ticket.estado_ticket,
                ticket.fecha_TicketCreacion,
                usuario.usuario_nombre,
                usuario.usuario_apellido,
                categoria.nombre_categoria
               
                FROM
                ticket
                INNER join categoria on ticket.id_categoria = categoria.id_categoria
                INNER join usuario on ticket.id_usuario = usuario.id_usuario
                WHERE
                ticket.estado = 1
                AND ticket.id_ticket = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id_ticket);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function insertar_ticketdetalle($id_ticket,$id_usuario,$detalle_descripcion_ticket){
            $conectar= parent::conexion();
            parent::set_names();

            $sql="INSERT INTO detalle_ticket (key_id_ticket,id_ticket,id_usuario,detalle_descripcion_ticket,fecha_TicketCreacion,estado) VALUES (NULL,?,?,?,now(),'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id_ticket);
            $sql->bindValue(2, $id_usuario);
            $sql->bindValue(3, $detalle_descripcion_ticket);
            $sql->execute();


        
            return $resultado=$sql1->fetchAll(pdo::FETCH_ASSOC);
        }

         public function actualizar_ticket($id_ticket){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="update ticket set estado_ticket ='Cerrado' where id_ticket=?;";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$id_ticket);
            $sql->execute();
            return $resultado=$sql->fetchAll();

        }












    }
    
?>
