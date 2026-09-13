$(document).ready(function(){

    //Carga dato para eliminar
    $("#tableTcRemDestBody tr").on("click",".btnEliminarRemDest",function(e){
        e.preventDefault();
        var row = $(this).parents('tr');
        var id = row.data('idremdest');
        var nombre = row.data('nombre');
        var apellidop = row.data('apellidop');
        var apellidom = row.data('apellidom');

        var message="Se eliminara el cliente "+nombre+' '+apellidop+' '+apellidom+".  Estas Seguro?";
        var title="Atencion";
        showMessageDelete(message,title);

        var action = $("#urldeleteremdest").attr("href");
        var method = 'DELETE';
        var url = action+"/"+id;

        $("#modalDeleteYes").on("click", function(){
            $.ajax({
                type:method,
                url:url,
                // data:{
                //     id:id
                // },
                success:function(data){
                    if(data.success=="true"){
                        var message=data.message;
                        var title="Success!!!";
                        var error ='';
                        var reload = true;
                        var windows="informacion";
                        showMessage(message,error,title,reload,windows);
                    }
                    else{
                        var message = data.message;
                        var title="Error!!!";
                        var error ='';
                        var reload = false
                        var win="error"
                        showMessage(message,error,title,reload,win);
                    }
                }
            });
        });
    });
})
