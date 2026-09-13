$(document).ready(function(){

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#btnSaveGoods").on('click',function(e){
        e.preventDefault();

        var validaFormulario = $(".formGoods").validate({
            rules:{
                txtgoodsdescr:"required",
            },
            messages:{
                txtgoodsdescr:"Este campo es obligatorio"
            }
        })

        if(validaFormulario.form()){
            var action = $(".formGoods").attr("action");
            var method = $(".formGoods").attr("method");

            var description = $(".txtgoodsdescr").val();

            $.ajax({
                type:method,
                url:action,
                data:{
                    description:description
                },
                success:function(data){
                    if(data.success=="true"){
                        $("#msgsession").attr("hidden",true);
                        var message=data.message;
                        var title="Success!!!";
                        var error ='';
                        var reload = true
                        showMessage(message,error,title,reload);
                        $(".formGoods").trigger("reset");
                        $("#mGoods").modal('hide');
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

