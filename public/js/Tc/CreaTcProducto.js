$(document).ready(function(){

    var validaFormulario = $(".formmItemProd").validate({
        rules:{
            txtmproducto:"required",
            txtmcapitulo:"required",
            txtmarticulo:"required",
            txtfinicio:"required"
        },
        messages:{
            txtmproducto:"Este campo es obligatorio",
            txtmcapitulo:"Este campo es obligatorio",
            txtmarticulo:"Este campo es obligatorio",
            txtfinicio:"Este campo es obligatorio"
        }
    });

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#btn-guardaItemProd").on("click",function(e){

        e.preventDefault();
        if (validaFormulario.form()){

            var producto = $("#txtmproducto").val();
            var idcapitulo = $("#txtmarticulo option:selected").val();
            var capitulo = $("#txtmcapitulo option:selected").text();
            var articulo = $("#txtmarticulo option:selected").text();
            var finicio = $("#txtfinicio").val();
            var ffin = $("#txtffin").val();


            var action = $("#formmItemProd").attr("href");
            var method = $("#formmItemProd").attr("method");

            $.ajax({
                type:method,
                url:action,
                data:{
                    producto:producto,
                    idcapitulo:idcapitulo,
                    capitulo:capitulo,
                    articulo:articulo,
                    finicio:finicio,
                    ffin:ffin
                },
                success:function(data){
                    if(data.success=="true"){
                        $("#msgsession").attr("hidden",true);
                        var message=data.message;
                        var title="Informacion";
                        var error ='';
                        var reload = false;
                        var win = "informacion";
                        showMessage(message,error,title,reload,win);
                        $(".formmItemProd").trigger("reset");
                        $("#mItemProd").modal('hide');
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

