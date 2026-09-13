$(document).ready(function(){

    var validaFormulario = $("#formCargos").validate({
        rules:{
            txttipocargo:"required",
            txttipopago:"required",
            txtmoneda:"required",
            txtimporte:{
                required:true,
                number:true
            },
            txttipocobro:"required",
            txtunidad:"required",
            txttotal:"required",
        },
        messages:{
            txttipocargo:"Este campo es obligatorio",
            txttipopago:"Este campo es obligatorio",
            txtmoneda:"Este campo es obligatorio",
            txtimporte:{
                required:"Este campo es obligatorio",
                number:"Este campo solo permite numeros"
            },
            txttipocobro:"required",
            txtunidad:"Este campo es obligatorio",
            txttotal:"Este campo es obligatorio",
        }
    });

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#btn-updItemCargos").on("click",function(e){
        e.preventDefault();
        if (validaFormulario.form()){

            var noorden = $("#txtorden_cargos").val();
            var tipocargo = $("#txttipocargo option:selected").val();
            var tipopago = $("#txttipopago option:selected").val();
            var moneda = $("#txtmoneda option:selected").val();
            var importe = $("#txtimporte").val();
            var um = $("#txttipocobro option:selected").text();
            var ctdad = $("#txtctdad").val();
            var total = $("#txttotal").val();
            var idcargo = $("#txtidcargo").val();

            var action = $("#urlcargoupdate").attr("href");
            var method = 'PATCH';
            var url = action+"/"+idcargo;

            $.ajax({
                type:method,
                url:url,
                data:{
                    noorden:noorden,
                    tipocargo: tipocargo,
                    tipopago: tipopago,
                    moneda: moneda,
                    importe: importe,
                    um: um,
                    ctdad: ctdad,
                    total: total
                },
                success:function(data){
                    if(data.success=="true"){
                        $("#msgsession").attr("hidden",true);
                        var message=data.message;
                        var title="Success!!!";
                        var error ='';
                        var reload = false
                        showMessage(message,error,title,reload);

                        $("#txttipocargo").prop('selectedIndex',0);
                        $("#txttipopago").prop('selectedIndex',0);
                        $("#txtmoneda").prop('selectedIndex',0);
                        $("#txtimporte").val("");
                        $("#txttipocobro").prop('selectedIndex',0);
                        $("#txtctdad").val("");
                        $("#txttotal").val("");

                        $("#btn-updItemCargos").attr("hidden",true);
                        $("#btn-addItemCargos").removeAttr("hidden");

                        $.ajax({
                            method:"POST",
                            url:"listadoItemCargos",
                            data:{
                                noblhouse: noorden
                            },
                            success: function(response){

                                $(".table_listaitemcargosBody tr").remove();
                                var jsonResults = JSON.parse(response);
                                $.each(jsonResults.data, function( index, response ){
                                    agregarFilaCargos(response.no_orden,response.tipo_cargo,response.tipo_pago,response.moneda,response.importe,response.um,response.ctdad,response.total,response.idtipocargo,response.idpago,response.idmoneda,response.idcargo);
                                });
                            }
                        });
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
    });
})
