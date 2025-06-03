function init(){
	$("#ticket_form").on("submit",function(e){
		guardar_editar(e);
	});
}

$(document).ready(function() {
			$('#ticket_descripcion').summernote({
				
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
			$.post("../../controller/categoria.php?op=combo",function(data,status){
			$('#id_categoria').html(data);
			});
		});

function guardar_editar(e){
	 
        e.preventDefault(); 
	var formData = new FormData($("#ticket_form")[0]);
	if ($('#ticket_descripcion').summernote('isEmpty') || $('#titulo_ticket').val()=='') {
        swal("Atencion", "Campos Vacios", "warning");
    }else{
	$.ajax({
		url:"../../controller/ticket.php?op=insertar",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,
		success: function(datos){
			$('#titulo_ticket').val('');
			$('#ticket_descripcion').summernote('reset');
			swal("Correcto","Registrado correctamente","success");
        }


	
		});
	}
}

init();