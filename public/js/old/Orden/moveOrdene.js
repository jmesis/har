
$(document).ready(function(){

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#btnTransferOrden").on("click",function(e){

        e.preventDefault();
        var noembarque_old = $.trim($("#txtembarqueconf option:selected").text());
        var noembarque_new = $.trim($("#txtembarquenuevo option:selected").text());

        var method = "POST";
        $.ajax({
            type:method,
            url:"muevesolicitud",
            data:{
                beforeEmbarque:noembarque_old,
                afterEmbarque:noembarque_new
            },
            success:function(data){
                if(data.success=="true"){
                    getOrdenes(noembarque_old);
                    // $("#txtembarquenuevo option:selected");

                    var message = data.message;
                    var title="Informacion!!!";
                    var error ='';
                    var reload = false
                    var win="informacion"
                    showMessage(message,error,title,reload,win);
                }
                else{
                    var message = data.message;
                    var title="Atencion!!!";
                    var error ='';
                    var reload = false
                    var win="error"
                    showMessage(message,error,title,reload,win);
                }
            },
            error:function(){
                var message = "Error, por favor contactar su Administrador de sistema";
                var title="Error!!!";
                var error ='';
                var reload = false
                var win="error"
                showMessage(message,error,title,reload,win);
            }
        });
    });
});

