    var tabla;
    var id_usuario = $('#user_id').val();
    var rol_id = $('#rol_id').val();


    function init(){
    $("#ticket_form").on("submit",function(e){
            guardar(e);
        });



    }


    $(document).ready(function(){

        $.post("../../controller/categoria.php?op=combo",function(data,status){
                $('#id_categoria').html(data);
                });


                $.post("../../controller/prioridad.php?op=combo",function(data,status){
                $('#id_prioridad').html(data);
                });


        $.post("../../controller/usuario.php?op=combo", function (data){
            $('#usuario_asignado').html(data);
        })
        
            if(rol_id==1){
                $('#vista_usuario').hide();
            tabla=$('#ticket_info').dataTable({
                "aProcessing": true,
                "aServerSide": true,
                dom: 'Bfrtip',
                "searching": true,
                lengthChange: false,
                colReorder: true,
                buttons: [                
                        'copyHtml5',
                        'excelHtml5',
                        'csvHtml5',
                        'pdfHtml5'
                        ],
                "ajax":{
                    url: '../../controller/ticket.php?op=listaTicket_por_usuario',
                    type : "post",
                    dataType : "json",  
                    data:{ id_usuario : id_usuario },                      
                    error: function(e){
                        console.log(e.responseText);    
                    }
                },
                "bDestroy": true,
                "responsive": true,
                "bInfo":true,
                "iDisplayLength": 10,
                "autoWidth": false,
                "language": {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }    
            }).DataTable();

        }else{

            var titulo_ticket=$('#titulo_ticket').val();
            var id_categoria=$('#id_categoria').val();
            var id_prioridad=$('#id_prioridad').val();

            listar_tickets_filtrados(titulo_ticket, id_categoria, id_prioridad);

            
        
        }
    });

   

    $(document).on("click",".btn-inline",function(){
        const ciphertext = $(this).data("ciphertext");
       window.open('http://localhost/UgelTicketsSoporte/view/DetalleTicket/?ID='+ ciphertext +''); //abre una nueva pestaña
    })

    function asignar(id_ticket){
        $.post("../../controller/ticket.php?op=mostrar", {id_ticket : id_ticket}, function (data){

            data= JSON.parse(data);
            $('#id_ticket').val(data.id_ticket);
            $('#mdltitulo').html('Asignar técnico');
            $("#asignar").modal('show');
            
        });
    }

    function guardar(e){
        e.preventDefault();

        var formData = new FormData($("#ticket_form")[0]);
        $.ajax({
            url: "../../controller/ticket.php?op=asignar_usuario",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(datos){
                $("#asignar").modal('hide');
                $('#ticket_info').DataTable().ajax.reload();
            }
        });
    }

    function Cambiar_estado(id_ticket){
        
        swal({
            title: "Soporte Técnico",
            text: "¿Está seguro que desea reabrir este ticket?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-warning",
            confirmButtonText: "Sí",
            cancelButtonText: "No",
            closeOnConfirm: false
        }, function (isConfirm) {
            if (isConfirm) {
                $.post("../../controller/ticket.php?op=reabrir_ticket", { id_ticket: id_ticket, id_usuario:id_usuario}, function (data) {

                });
                    $('#ticket_info').DataTable().ajax.reload();

                    swal({
                        title: "Atención",
                        text: "Ticket reabierto.",
                        type: "success",
                        confirmButtonClass: "btn-success"
                    });
                
            }
        });

        
    }

    $(document).on("click","#btnfiltrar", function(){
        limpiar_tabla();
        var titulo_ticket=$('#titulo_ticket').val();
            var id_categoria=$('#id_categoria').val();
            var id_prioridad=$('#id_prioridad').val();

    listar_tickets_filtrados(titulo_ticket, id_categoria, id_prioridad);

    });

    $(document).on("click","#btnlimpiar", function(){
    limpiar_tabla();
        $('#titulo_ticket').val('');
        $('#id_categoria').val('');
        $('#id_prioridad').val('');

            listar_tickets_filtrados('', '', '');
    });
    function listar_tickets_filtrados(titulo_ticket, id_categoria, id_prioridad){
        tabla=$('#ticket_info').dataTable({
                "aProcessing": true,
                "aServerSide": true,
                dom: 'Bfrtip',
                "searching": true,
                lengthChange: false,
                colReorder: true,
                buttons: [                
                        'copyHtml5',
                        'excelHtml5',
                        'csvHtml5',
                        'pdfHtml5'
                        ],
                "ajax":{
                    url: '../../controller/ticket.php?op=listar_filtro',
                    data:{ titulo_ticket : titulo_ticket, id_categoria : id_categoria, id_prioridad :id_prioridad },
                    type : "post",
                    dataType : "json",  
                                        
                    error: function(e){
                        console.log(e.responseText);    
                    }
                },
                "bDestroy": true,
                "responsive": true,
                "bInfo":true,
                "iDisplayLength": 10,
                "autoWidth": false,
                "language": {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }    
            }).DataTable();
    }

    function limpiar_tabla(){
        $('#table').html(
            "<table id='ticket_info' class='table table-bordered table-striped table-vcenter js-dataTable-full'>"+
                    " <thead>"+
                            "<tr>"+
                            " <th style='width: 5%;'>N° de Ticket</th>"+
                                "<th style='width: 15%;'>Categoria</th>"+
                            " <th class='d-none d-sm-table-cell' style='width: 20%;'>Titulo</th>"+
                                "<th class='d-none d-sm-table-cell' style='width: 10%;'>Prioridad</th>"+
                            " <th class='d-none d-sm-table-cell' style='width: 5%;'>Estado</th>"+
                            " <th class='d-none d-sm-table-cell' style='width: 10%;'>Fecha Creación</th>"+
                            " <th class='d-none d-sm-table-cell' style='width: 10%;'>Fecha de asignación</th>"+
                                "<th class='d-none d-sm-table-cell' style='width: 10%;'>Fecha de cierre</th>"+
                                "<th class='d-none d-sm-table-cell' style='width: 10%;'>Técnico asignado</th>"+
                                "<th class='text-center' style='width: 5%;'></th>"+
                            "</tr>"+
                        "</thead>"+
                        "<tbody>"+
                        "</tbody>"+
                    "</table>"
        );
            
        
    }




    init();

