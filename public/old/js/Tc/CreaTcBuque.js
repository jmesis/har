$(document).ready(function(){

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#btnSaveBuque").on('click',function(e){
        e.preventDefault();

        var validaFormulario = $(".formAV").validate({
            rules:{
                txttcbuque:"required",
                txttcbuqueimo:"required"
            },
            messages:{
                txttcbuque:"Este campo es obligatorio",
                txttcbuqueimo:"Este campo es obligatorio"
            }
        })



        if(validaFormulario.form()){
            var action = $(".formAV").attr("action");
            var method = $(".formAV").attr("method");

            var tcbuque = $(".txttcbuque").val();
            var tcbuqueimo = $(".txttcbuqueimo").val();

            $.ajax({
                type:method,
                url:action,
                data:{
                    buque:tcbuque,
                    buqueimo:tcbuqueimo
                },
                success:function(data){
                    if(data.success=="true"){
                        $("#msgsession").attr("hidden",true);
                        var message=data.message;
                        var title="Success!!!";
                        var error ='';
                        var reload = true
                        showMessage(message,error,title,reload);
                        $(".formAV").trigger("reset");
                        $("#mBuque").modal('hide');
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

