$(document).ready(function(){

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#btnSaveCliente").on('click',function(e){
        e.preventDefault();

        var validaFormulario = $(".formCliente").validate({
            rules:{
                clientename:"required",
                clientedir:"required"
            },
            messages:{
                clientename:"Este campo es obligatorio",
                clientedir:"Este campo es obligatorio"
            }
        });

        if(validaFormulario.form()){
            var action = $(".formCliente").attr("action");
            var method = $(".formCliente").attr("method");

            var clientename = $(".clientename").val();
            var clientedir = $(".clientedir").val();

            $.ajax({
                type:method,
                url:action,
                data:{
                    clientename:clientename,
                    clientedir:clientedir
                },
                success:function(data){
                    if(data.success=="true"){
                        $("#msgsession").attr("hidden",true);
                        var message=data.message;
                        var title="Success!!!";
                        var error ='';
                        var reload = true;
                        var windows = "informacion";
                        showMessage(message,error,title,reload,windows);
                        $(".formCliente").trigger("reset");
                        $("#mCliente").modal('hide');
                    }
                    else{
                        var sms = data.message;
                       // $(".msgsession").attr("hidden",false);
                       // $(".msg").html(sms);
                       console.log(sms);
                    }
                },
                error:function(){
                    var sms = "Error, por favor contactar su Administrador de sistema";
                    $(".msgsession").attr("hidden",false);
                    $(".msg").html(sms);
                }
            })
        }
    })
})

