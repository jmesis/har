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
            txttipocobro:"Este campo es obligatorio",
            txtunidad:"Este campo es obligatorio",
            txttotal:"Este campo es obligatorio",
        }
    });

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#btn-addItemCargos").on("click",function(e){

        var ctdad = $("#txtctdad").val();
        var total = $("#txttotal").val();
        if(ctdad != '' && total != ''){
            e.preventDefault();
            if (validaFormulario.form()){

                var noorden = $("#txtorden_cargos").val();
                var tipocargo = $("#txttipocargo option:selected").val();
                var tipopago = $("#txttipopago option:selected").val();
                var moneda = $("#txtmoneda option:selected").val();
                var importe = $("#txtimporte").val();
                var txttipocobro = $("#txttipocobro option:selected").text();
                // var ctdad = $("#txtctdad").val();
                // var total = $("#txttotal").val();

                var action = $("#formCargos").attr("action");
                var method = $("#formCargos").attr("method");

                $.ajax({
                    type:method,
                    url:action,
                    data:{
                        noorden:noorden,
                        tipocargo: tipocargo,
                        tipopago: tipopago,
                        moneda: moneda,
                        importe: importe,
                        um: txttipocobro,
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
                            var win="informacion"
                            showMessage(message,error,title,reload,win);

                            $("#txttipocargo").prop('selectedIndex',0);
                            $("#txttipopago").prop('selectedIndex',0);
                            $("#txtmoneda").prop('selectedIndex',0);
                            $("#txtimporte").val("");
                            $("#txtumcargos").prop('selectedIndex',0);
                            $("#txtctdad").val("");
                            $("#txttotal").val("");

                            $.ajax({
                                type: "POST",
                                url: "listadoItemCargos",
                                data:{
                                    noblhouse:noorden
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
        }
        else{
            var message="No existen productos en esta orden";
            var title="Atencion";
            var error ='';
            var reload=false;
            var win = "error";
            showMessage(message,error,title,reload,win);
        }

    })
})

