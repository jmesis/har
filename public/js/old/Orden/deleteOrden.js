//Borra registro de la tabla de producto
$(".tablelistadoordenes tbody").on("click", ".btn-cancelarorden", function(e){
    e.preventDefault();
    var row = $(this).parents('tr');

    var message="Se eliminara la orden "+row.data('noorden')+" y se perderan todos los datos de productos agregados, cargos y facturas emitidas y cobradas asociadas a esta orden.  Esta seguro que desea eliminar toda la informacion?";
    var title="Atencion";
    showMessageDelete(message,title);

    var noorden = row.data('noorden');
    var action = $("#urldeleteorden");

    var action = action.attr("href");
    var method = 'DELETE';
    var url = action+"/"+noorden;

    $("#modalDeleteYes").on("click", function(){

        $.ajax({
            type:method,
            url:url,
            success:function(data){
                if(data.success=="true"){
                    row.remove();

                    var message=data.message;
                    var title="Informacion!!!";
                    var error ='';
                    var reload = false;
                    var win = 'informacion';
                    showMessage(message,error,title,reload,win);
                }
                else{
                    var message = data.message;
                    var title="Error!!!";
                    var error ='';
                    var reload = false
                    var win="error"
                    showMessage(message,error,title,reload,win);
                }
            },
            error:function(){
                var message = "Por favor contactar al administrador de Sistemas";
                var title="Error!!!";
                var error ='';
                var reload = false
                var win="error"
                showMessage(message,error,title,reload,win);
            }
        })
    })
})
