function init(){

}
$(document).ready(function() {
    var id_ticket = getUrlParameter('ID');
    $.post("../../controller/ticket.php?op=listardetalle", {id_ticket : id_ticket},function (data){
        
        $('#detalleDelTicket').html(data);
    });
     $.post("../../controller/ticket.php?op=mostrar", {id_ticket : id_ticket},function (data){
        data = JSON.parse(data)
        $('#estado').html(data.estado_ticket);
        $('#nombre_usuario').html(data.usuario_nombre + ' ' +data.usuario_apellido);
        $('#fecha_TicketCreacion').html(data.fecha_TicketCreacion);
        $('#numidticket').html("Detalle Ticket - " + data.id_ticket);
        $('#ticket_titulo').val(data.titulo_ticket);
        $('#categoria_nombre').val(data.nombre_categoria);
        $('#detalle_descripcion_ticket_usuario').summernote('code', data.descripcion_ticket);
     });

  $('#detalle_descripcion_ticket').summernote({
				height: 150,
        lang: "es-ES",
        callbacks: {
            onImageUpload: function(image) {
                console.log("Image detect...");
                myimagetreat(image[0]);
            },
            onPaste: function (e) {
                console.log("Text detect...");
            }
        },
		});

         $('#detalle_descripcion_ticket_usuario').summernote({
				height: 150,
        lang: "es-ES",
        
		});
    });
    
     
var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

init();



