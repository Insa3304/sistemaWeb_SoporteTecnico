function init(){
}


$(document).ready(function() {


});


$(document).on("click", "#vista_soporte", function () {
    if ($('#rol_id').val()==1){
        $('#lbltitulo').html("Acceso Soporte");
        $('#vista_soporte').html("Acceso Usuario");
        $('#rol_id').val(2);
        $("#imagen_rol").attr("src","../public/2.png");
    }else{
        $('#lbltitulo').html("Acceso Usuario");
        $('#btnsoporte').html("Acceso Soporte");
        $('#rol_id').val(1);
        $("#imagen_rol").attr("src","../public/1.png");
    }
});


init();

