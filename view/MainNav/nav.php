<?php
    if ($_SESSION["rol_id"]==1){
        ?>
            <nav class="side-menu">
                <ul class="side-menu-list">
                    <li class="blue-dirty">
                        <a href="..\Home\">
                            <span class="glyphicon glyphicon-th"></span>
                            <span class="lbl">Inicio</span>
                        </a>
                    </li>
                    <li class="blue-dirty">
                        <a href="..\NuevoTicket\">
                            <span class="glyphicon glyphicon-th"></span>
                            <span class="lbl">Nuevo Ticket</span>
                        </a>
                    </li>


                    <li class="blue-dirty">
                        <a href="..\ConsultarTicket\">
                            <span class="glyphicon glyphicon-th"></span>
                            <span class="lbl">Consultar Ticket</span>
                        </a>
                    </li>
                </ul>
            </nav>
        <?php
    }else{
        ?>
            <nav class="side-menu">
                <ul class="side-menu-list">
                    <li class="blue-dirty">
                        <a href="..\Home\">
                            <span class="glyphicon glyphicon-th"></span>
                            <span class="lbl">Inicio</span>
                        </a>
                    </li>
                    
                    <li class="blue-dirty">
                        <a href="..\creacion_usuarios\">
                            <span class="glyphicon glyphicon-th"></span>
                            <span class="lbl">Usuarios</span>
                        </a>
                    </li>

                    <li class="blue-dirty">
                        <a href="..\prioridad\">
                            <span class="glyphicon glyphicon-th"></span>
                            <span class="lbl">Prioridad</span>
                        </a>
                    </li>

                    <li class="blue-dirty">
                        <a href="..\Categoria\">
                            <span class="glyphicon glyphicon-th"></span>
                            <span class="lbl">Categoria</span>
                        </a>
                    </li>



                    <li class="blue-dirty">
                        <a href="..\ConsultarTicket\">
                            <span class="glyphicon glyphicon-th"></span>
                            <span class="lbl">Consultar Ticket</span>
                        </a>
                    </li>
                </ul>
            </nav>
        <?php
    }
?>








