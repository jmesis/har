$(document).ready(function(){

    var validaFormulario = $(".formmItemCargo").validate({
        rules:{
            txtmcargo:"required",
            txtfiniciocargo:"required"
        },
        messages:{
            txtmcargo:"Este campo es obligatorio",
            txtfiniciocargo:"Este campo es obligatorio"
        }
    });

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#btn-guardaItemCargo").on("click",function(e){

        e.preventDefault();
        if (validaFormulario.form()){

            var cargo = $("#txtmcargo").val();
            var finicio = $("#txtfiniciocargo").val();
            var ffin = $("#txtffincargo").val();


            var action = $("#formmItemCargo").attr("href");
            var method = $("#formmItemCargo").attr("method");

            $.ajax({
                type:method,
                url:action,
                data:{
                    cargo:cargo,
                    finicio:finicio,
                    ffin:ffin
                },
                success:function(data){
                    if(data.success=="true"){
                        $("#msgsession").attr("hidden",true);
                        var message=data.message;
                        var title="Success!!!";
                        var error ='';
                        var reload = true;
                        var window = "informacion";
                        showMessage(message,error,title,reload,window);
                        $(".formmItemCargo").trigger("reset");
                        $("#mItemCargo").modal('hide');
                    }
                    else{
                        var sms = data.message;
                        $(".msgsession").attr("hidden",false);
                        $(".msg").html(sms).fadeOut(8000);
                    }
                },
                error:function(){
                    var sms = "Error, por favor contactar su Administrador de sistema";
                    $(".msgsession").attr("hidden",false);
                    $(".msg").html(sms).fadeOut(8000);
                }
            })

        }
    })
})


