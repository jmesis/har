$(document).ready(function(){

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // var modified;

    $("#btn-actembarque").on("click", function(e){
        var contenedor = $("#txtcont").val();
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
                idtxtpod:"required"
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
                txtpod:"Este campo es obligatorio"
            }
        });

        if(validaFormulario.form() && cont!=''){

            if(contenedor != ""){
                var cont=contenedor;
            }
            else{
                var cont = "SN";
            }

            var idembarque = $("#txtembarque").val();
            var origen = $.trim($("#txtorigen option:selected").text());
            var embarcador = $("#txtembarcador").val();
            var consignado = $.trim($("#txtconsignado option:selected").text());
            var tipoemb = $.trim($("#txttipoemb option:selected").text());
            var buque = $.trim($("#txtbuque option:selected").text());
            var viaje = $.trim($("#txtviaje option:selected").text());
            var fechaest = $("#txtfechaest").val();
            var idpol = $("#idtxtpol").val();
            var idpod = $("#idtxtpod").val();
            cont = $("#txtcont").val();
            var tipocont = $.trim($("#txttipocont option:selected").text());
            var mfto = $("#txtmfto").val();
            var idnaviera = $.trim($("#txtnaviera option:selected").val());
            var nodoc = $(".txtdocembarque").val();

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
                    idnaviera:idnaviera,
                    nodoc:nodoc
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
                        $(".txtmfto").attr("disabled",true);
                        $(".txtdocembarque").attr("disabled",true);
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
