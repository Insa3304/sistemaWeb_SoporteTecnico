var tabla;


function init(){
   $("#formularioUsuario").on("submit",function(e){
    guardaryeditar(e);
   });
}

function guardaryeditar(e){
    e.preventDefault();
    var formData = new FormData($("#formularioUsuario")[0]);
    $.ajax({
        url: "../../controller/usuario.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos){    
            console.log(datos);
            // Primero ocultamos el modal
            $('#ventanaRegistro').modal('hide');
            // Luego reseteamos el formulario
            $('#formularioUsuario')[0].reset();
            // Recargamos la tabla
            $('#usuario_info').DataTable().ajax.reload();

            // Finalmente mostramos la alerta
        
            swal({
                    title: "Atención",
                    text: "Usuario registrado correctamente.",
                    type: "success",
                    confirmButtonClass: "btn-success"
                });
            
            
        }
    });
}

$(document).ready(function () {
    tabla = $('#usuario_info').dataTable({
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
        "ajax": {
            url: '../../controller/usuario.php?op=listar',
            type: "post",
            dataType: "json",
            error: function (e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo": true,
        "iDisplayLength": 10,
        "autoWidth": false,
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    }).DataTable();
});

function editar(id_usuario) {
   $('#ventanaTitulo').html('Editar Registro'); 

    $.post("../../controller/usuario.php?op=mostrar", { id_usuario: id_usuario }, function (data) {
               data= JSON.parse(data);
                 $('#id_usuario').val(data.id_usuario);
                $('#usuario_nombre').val(data.usuario_nombre);
                $('#usuario_apellido').val(data.usuario_apellido);
                $('#usuario_correo').val(data.usuario_correo);
                $('#usuario_contraseña').val(data.usuario_contraseña);
                $('#rol_id').val(data.rol_id).trigger('change');

              
            });
    $('#ventanaRegistro').modal('show');
}

function eliminar(id_usuario) {
    swal({
        title: "Soporte Técnico",
        text: "¿Está seguro de eliminar este usuario?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Sí",
        cancelButtonText: "No",
        closeOnConfirm: false
    }, function (isConfirm) {
        if (isConfirm) {
            $.post("../../controller/usuario.php?op=eliminar", { id_usuario: id_usuario }, function (data) {

            });
                $('#usuario_info').DataTable().ajax.reload();

                swal({
                    title: "Atención",
                    text: "Usuario eliminado correctamente.",
                    type: "success",
                    confirmButtonClass: "btn-success"
                });
            
        }
    });

    
}
$(document).on ("click","#btn_nuevousuario", function(){
        $('#ventanaTitulo').html('Nuevo Registro');
        $('#formularioUsuario')[0].reset();
        $('#ventanaRegistro').modal('show');

    });
init();
