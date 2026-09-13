$(document).ready(function(){

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#btnSaveViaje").on('click',function(e){
        e.preventDefault();

        var validaFormulario = $(".formViaje").validate({
            rules:{
                buque:"required",
                viaje:"required"
            },
            messages:{
                buque:"Este campo es obligatorio",
                viaje:"Este campo es obligatorio"
            }
        })

        if(validaFormulario.form()){
            var action = $(".formViaje").attr("action");
            var method = $(".formViaje").attr("method");

            var buque = $("#buque option:selected").val();
            var viaje = $("#viaje").val();

            $.ajax({
                type:method,
                url:action,
                data:{
                    buque:buque,
                    viaje:viaje
                },
                success:function(data){
                    if(data.success=="true"){
                        $("#msgsession").attr("hidden",true);
                        var message=data.message;
                        var title="Success!!!";
                        var error ='';
                        var reload = true
                        showMessage(message,error,title,reload);
                        $(".formViaje").trigger("reset");
                        $("#mViaje").modal('hide');
                    }
                    else{
                        var sms = data.message;
                        $(".msgsession").attr("hidden",false);
                        $(".msg").html(sms);
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

