<?php
    class Ticket extends Conectar{


        public function insertar_ticket($id_usuario,$id_categoria,$titulo_ticket,$descripcion_ticket,$id_prioridad){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO ticket (id_ticket,id_usuario, id_categoria, titulo_ticket, descripcion_ticket,estado_ticket,fecha_TicketCreacion,
            usuario_asignado,fecha_asignacion,id_prioridad ,estado) VALUES (NULL,?, ?, ?, ?,'Abierto',now(),null,null ,?,'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$id_usuario);
            $sql->bindValue(2,$id_categoria);
            $sql->bindValue(3,$titulo_ticket);
            $sql->bindValue(4,$descripcion_ticket);
            $sql->bindValue(5,$id_prioridad);
            $sql->execute();

            $sql1="select last_insert_id() as 'id_ticket';";
            $sql1=$conectar->prepare($sql1);
            $sql1->execute();
            return $resultado=$sql1->fetchAll(PDO::FETCH_ASSOC);
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
                ticket.usuario_asignado,
                ticket.fecha_asignacion,
                ticket.fecha_cierre,
                usuario.usuario_nombre,
                usuario.usuario_apellido,
                categoria.nombre_categoria,
                ticket.id_prioridad,
                prioridad.nombre_prioridad
                FROM
                ticket
                INNER join categoria on ticket.id_categoria = categoria.id_categoria
                INNER join usuario on ticket.id_usuario = usuario.id_usuario
                INNER join prioridad on ticket.id_prioridad = prioridad.id_prio
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
                ticket.fecha_cierre,
                 ticket.usuario_asignado,
                ticket.fecha_asignacion,
                usuario.usuario_nombre,
                usuario.usuario_apellido,
                categoria.nombre_categoria,
                ticket.id_prioridad,
                prioridad.nombre_prioridad
                FROM
                ticket
                INNER join categoria on ticket.id_categoria = categoria.id_categoria
                INNER join usuario on ticket.id_usuario = usuario.id_usuario
                INNER join prioridad on ticket.id_prioridad = prioridad.id_prio
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
                ticket.fecha_cierre,
                usuario.usuario_nombre,
                usuario.usuario_apellido,
                categoria.nombre_categoria,
                ticket.id_prioridad,
                prioridad.nombre_prioridad
               
                FROM
                ticket
                INNER join categoria on ticket.id_categoria = categoria.id_categoria
                INNER join usuario on ticket.id_usuario = usuario.id_usuario
                INNER join prioridad on ticket.id_prioridad = prioridad.id_prio
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
            $sql="update ticket set estado_ticket ='Cerrado',fecha_cierre = now() where id_ticket=?;";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$id_ticket);
            $sql->execute();
            return $resultado=$sql->fetchAll();

        }
         public function asignacion_Ticket($id_ticket,$usuario_asignado){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE ticket set usuario_asignado= ?, fecha_asignacion= now() where id_ticket=?;";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$usuario_asignado);
            $sql->bindValue(2,$id_ticket);
            $sql->execute();
            return $resultado=$sql->fetchAll();

        }

        public function detalle_ticket_cerrado($id_ticket,$id_usuario,){
           $conectar= parent::conexion();
           parent::set_names();
           $sql="call sp_insert_ticketDetalle01(?,?)";

           $sql=$conectar->prepare($sql);
           $sql->bindValue(1, $id_ticket);
           $sql->bindValue(2, $id_usuario);
          
           $sql->execute();

           return $resultado=$sql->fetchAll;
       }


         public function detalle_ticket_reabrir($id_ticket,$id_usuario,){
            $conectar= parent::conexion();
            parent::set_names();
           $sql="INSERT INTO detalle_ticket 
           (key_id_ticket,id_ticket,id_usuario,detalle_descripcion_ticket,fecha_TicketCreacion,estado) 
           VALUES (NULL,?, ?,'Ticket Reabierto',now(),'1');";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id_ticket);
            $sql->bindValue(2, $id_usuario);
           
            $sql->execute();


        
            return $resultado=$sql->fetchAll;
        }

         public function get_ticketTotal(){
        $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) as TOTAL FROM ticket";
            $sql=$conectar->prepare($sql);
            
            $sql->execute();
            return $resultado=$sql->fetchAll();

    }
     public function get_ticketTotalAbierto(){
        $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) as TOTAL FROM ticket where  estado_ticket='Abierto'";
            $sql=$conectar->prepare($sql);
           
            $sql->execute();
            return $resultado=$sql->fetchAll();

    }
    public function get_ticketTotalCerrado(){
        $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) as TOTAL FROM ticket where estado_ticket='Cerrado'";
            $sql=$conectar->prepare($sql);
            
            $sql->execute();
            return $resultado=$sql->fetchAll();

    }
     public function get_ticket_grafico(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT categoria.nombre_categoria as nom,COUNT(*) AS total
                FROM   ticket  JOIN  
                    categoria ON ticket.id_categoria = categoria.id_categoria  
                WHERE    
                ticket.estado = 1
                GROUP BY
                categoria.nombre_categoria
                ORDER BY total DESC";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

    public function reabrir_ticket($id_ticket){
     $conectar= parent::conexion();
            parent::set_names();
            $sql="update ticket set estado_ticket ='Abierto' where id_ticket=?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$id_ticket);
            $sql->execute();
            return $resultado=$sql->fetchAll();

        }
        

        public function filtrar_ticket($titulo_ticket,$id_categoria,$id_prioridad){
             $conectar= parent::conexion();
            parent::set_names();
            $sql="call filtrado_ticket (?,?,?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, "%".$titulo_ticket."%");
            $sql->bindValue(2, $id_categoria);
            $sql->bindValue(3, $id_prioridad);
            $sql->execute();
            return $resultado=$sql->fetchAll();



        }


    }

     
    
?>
