$(document).ready(function(){

    var validaFormulario = $(".formEmbarque").validate({
        rules:{
            txtorigen:"required",
            txtembarcador:"required",
            txtconsignado:"required",
            txttipoemb:"required"
        },
        messages:{
            txtorigen:"Este campo es obligatorio",
            txtembarcador:"Este campo es obligatorio",
            txtconsignado:"Este campo es obligatorio",
            txttipoemb:"Este campo es obligatorio"
        }
    });

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#btn-guardaembarque").on("click",function(e){

        e.preventDefault();
        if (validaFormulario.form()){

            var origen = $.trim($("#txtorigen option:selected").text());
            var embarcador = $("#txtembarcador").val();
            var consignado = $.trim($("#txtconsignado option:selected").text());
            var tipoemb = $.trim($("#txttipoemb option:selected").text());
            var noembarque = $("#txtdocembarque").val();

            var action = $("#formEmbarque").attr("href");
            var method = $("#formEmbarque").attr("method");

            $.ajax({
                type:method,
                url:action,
                data:{
                    origen:origen,
                    embarcador:embarcador,
                    consignado:consignado,
                    tipoemb:tipoemb,
                    noembarque:noembarque
                },
                success:function(data){
                    if(data.success=="true"){
                        $("#msgsession").attr("hidden",true);
                        var message=data.message;
                        var title="Success!!!";
                        var error ='';
                        var reload = true;
                        var window="informacion"
                        showMessage(message,error,title,reload,window);
                        $(".formEmbarque").trigger("reset");
                        $("#m-embarque").modal('hide');
                        $(".txtmfto").attr("disabled");
                        $(".txtdocembarque").attr("disabled");
                    }
                    else{
                        var sms = data.message;
                        $(".msgsession").attr("hidden",false);
                        $(".msg").html(sms)/*.fadeOut(1000)*/;
                    }
                },
                error:function(){
                    var sms = "Error, por favor contactar su Administrador de sistema";
                    $(".msgsession").attr("hidden",false);
                    $(".msg").html(sms)/*.fadeOut(1000)*/;
                }
            })

        }
    })
})

