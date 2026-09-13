$(document).ready(function(){

    var idcobro;
    //carga el modal de embarque para modificar informacion
    $("#tableTcTipocobro tbody").on("click",".btnEditarTcobro",function(){

        var row = $(this).parents('tr');
        idcobro = (row.data("idtipocobro"));
        var um = (row.data("tipocobro"));
        var importe = (row.data("importe"));
        var finicio = (row.data("finicio"));
        var ffin = (row.data("ffin"));

        $("#mTipocobro").modal({backdrop: 'static'});

        $(".txtipocobro").val(um);
        $(".txtipocobroimporte").val(importe);
        $(".txtfiniciotipocobro").val(moment(finicio).format('YYYY-MM-DD'));
        $(".txtffintipocobro").val(moment(ffin).format('YYYY-MM-DD'));

        //Actualizamos el cargo
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#btnUpdateTipocobro").on("click", function(e){
            e.preventDefault();

            var validaFormulario = $(".formTipocobro").validate({
                rules:{
                    txtipocobro:"required",
                    txtipocobroimporte:"required",
                    txtfiniciotipocobro:"required"
                },
                messages:{
                    txtipocobro:"Este campo es obligatorio",
                    txtipocobroimporte:"Este campo es obligatorio",
                    txtfiniciotipocobro:"Este campo es obligatorio"
                }
            });

            if(validaFormulario.form()){

                idcobro = idcobro;
                var importe = $("#txtipocobroimporte").val();
                var finicio = $("#txtfiniciotipocobro").val();
                var ffin = $("#txtffintipocobro").val();

                var action = $("#urltipocobroupdate").attr("href");
                var method = 'PATCH';
                var url = action+"/"+idcobro;

                $.ajax({
                    type:method,
                    url:url,
                    data:{
                        importe:importe,
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
                            var window="informacion";
                            showMessage(message,error,title,reload,window);
                            $(".formTipocobro").trigger("reset");
                            $("#mTipocobro").modal('hide');
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
})
