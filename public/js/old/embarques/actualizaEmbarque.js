$(document).ready(function(){

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // var modified;

    $("#btn-actembarque").on("click", function(e){
        var cont = $("#txtcont").val();
        e.preventDefault();

        var validaFormulario = $(".formEmbarque").validate({
            rules:{
                txtembarque:"required",
                txtorigen:"required",
                txtembarcador:"required",
                txtconsignado:"required",
                txttipoemb:"required",
                txtbuque:"required",
                txtviaje:"required",
                txtpol:"required",
                txtpod:"required",
                idtxtpol:"required",
                idtxtpod:"required",
                txttipocont:"required",
            },
            messages:{
                txtembarque:"Este campo es obligatorio",
                txtorigen:"Este campo es obligatorio",
                txtembarcador:"Este campo es obligatorio",
                txtconsignado:"Este campo es obligatorio",
                txttipoemb:"Este campo es obligatorio",
                txtbuque:"Este campo es obligatorio",
                txtviaje:"Este campo es obligatorio",
                txtpol:"Este campo es obligatorio",
                txtpod:"Este campo es obligatorio",
                txttipocont:"Este campo es obligatorio",
            }
        });

        if(validaFormulario.form() && cont!=''){

            var idembarque = $("#txtembarque").val();
            var origen = $("#txtorigen option:selected").text();
            var embarcador = $("#txtembarcador option:selected").text();
            var consignado = $("#txtconsignado option:selected").text();
            var tipoemb = $("#txttipoemb option:selected").text();
            var buque = $("#txtbuque option:selected").text();
            var viaje = $("#txtviaje option:selected").text();
            var fechaest = $("#txtfechaest").val();
            var idpol = $("#idtxtpol").val();
            var idpod = $("#idtxtpod").val();
            var cont = $("#txtcont").val();
            var tipocont = $("#txttipocont option:selected").text();
            var mfto = $("#txtmfto").val();
            var idnaviera = $("#txtnaviera option:selected").val();

            var action = $("#urlembarqueupdate").attr("href");
            var method = 'PATCH';
            var url = action+"/"+idembarque;

            $.ajax({
                type:method,
                url:url,
                data:{
                    idembarque:idembarque,
                    origen:origen,
                    mfto:mfto,
                    embarcador:embarcador,
                    consignado:consignado,
                    tipoemb:tipoemb,
                    buque:buque,
                    viaje:viaje,
                    fechaest:fechaest,
                    idpol:idpol,
                    idpod:idpod,
                    cont:cont,
                    tipocont:tipocont,
                    idnaviera:idnaviera
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
                        $("#title-membarque").html("Nuevo Embarque");
                    }
                    else{
                        var sms = data.message;
                        $(".msgsession").attr("hidden",false);
                        $(".msg").html(sms).fadeOut(1000);
                    }
                },
                error:function(){
                    var sms = "Error, por favor contactar su Administrador de sistema";
                    $(".msgsession").attr("hidden",false);
                    $(".msg").html(sms).fadeOut(1000);
                }
            });
        }
    });
})
