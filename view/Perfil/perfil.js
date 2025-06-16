
$(document).on("click","#btnactualizar", function(){
   var contraseña = $("#txtpass").val();
   var nueva_contraseña = $("#txtpassnew").val();


   /* validamos que los campos no esten vacios antes de guardar */
    if (contraseña.length == 0 || nueva_contraseña.length == 0) {
        swal("Error", "Campos Vacios", "error");
    }else{
        /*  validamos que la contraseñas sean iguales */
        if (contraseña==nueva_contraseña){

            var id_usuario = $('#user_id').val();
            $.post("../../controller/usuario.php?op=cambiar_contraseña", {id_usuario:id_usuario,usuario_contraseña:nueva_contraseña}, function (data) {
                swal("Correcto", "Actualizado Correctamente", "success");
            });


        }else{
            /* TODO: Mensaje de alerta en caso de error */
            swal("Error", "Las contraseñas no coinciden", "error");
        }
    }
});


