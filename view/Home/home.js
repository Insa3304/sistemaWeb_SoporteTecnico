function init(){


}


$(document).ready(function(){
    var id_usuario =$('#user_id').val();
   
     if ( $('#rol_id').val() == 1){
        $.post("../../controller/usuario.php?op=total", {id_usuario:id_usuario}, function (data) {
             data = JSON.parse(data);
             $('#lbltotal').html(data.TOTAL);
         });
    
         $.post("../../controller/usuario.php?op=totalabierto", {id_usuario:id_usuario}, function (data) {
            data = JSON.parse(data);
            
            $('#lbltotalabierto').html(data.TOTAL);
           
        });

         $.post("../../controller/usuario.php?op=totalcerrado", {id_usuario:id_usuario}, function (data) {
            data = JSON.parse(data);
            
            $('#lbltotalcerrado').html(data.TOTAL);
           
        });

           $.post("../../controller/usuario.php?op=grafico", {id_usuario:id_usuario},function (data) {
           data = JSON.parse(data);
           console.log(data);
           new Morris.Bar({
               element: 'div_grafico',
               data: data,
               xkey: 'nom',
               ykeys: ['total'],
               labels:['Value']
           });
    
       });
    }else{

        
        $.post("../../controller/ticket.php?op=total",  function (data) {
             data = JSON.parse(data);
             $('#lbltotal').html(data.TOTAL);
         });

         $.post("../../controller/ticket.php?op=totalabierto",  function (data) {
            data = JSON.parse(data);
            
            $('#lbltotalabierto').html(data.TOTAL);
           
        });

         $.post("../../controller/ticket.php?op=totalcerrado", function (data) {
            data = JSON.parse(data);
            
            $('#lbltotalcerrado').html(data.TOTAL);
           
        });
        $.post("../../controller/ticket.php?op=grafico", function (data) {
           data = JSON.parse(data);
          
    
           new Morris.Bar({
               element: 'div_grafico',
               data: data,
               xkey: 'nom',
               ykeys: ['total'],
               labels:['Value']
           });
    
       });
    }


        
});


init();




 
