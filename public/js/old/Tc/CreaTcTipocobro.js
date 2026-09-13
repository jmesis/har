$(document).ready(function(){

    var idcobro;
    $("#tableTcTipocobro tbody").on("click",".btnAgregarTcobro",function(){

        var row = $(this).parents('tr');
        idcobro = (row.data("idtipocobro"));
        var um = (row.data("tipocobro"));
        var finicio = (row.data("finicio"));
        var now = moment().format('YYYY-MM-DD');

        $("#mTipocobro").modal({backdrop: 'static'});

        $("#title-mTipocbro").html("Crear registro");
        $("#btnUpdateTipocobro").attr("hidden",true);
        $("#btnCreaTipocobro").attr("hidden",false);
        $(".txtffintipocobro").attr("disabled",true);

        $(".txtipocobro").val(um);
        $(".txtfiniciotipocobro").val(moment(finicio).format('YYYY-MM-DD'));
        $(".txtffintipocobro").val(now);

        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#btnCreaTipocobro").on("click", function(e){
            e.preventDefault();

            var validaFormulario = $(".formTipocobro").validate({
                rules:{
                    txtipocobro:"required",
                    txtipocobroimporte:"required",
                    txtfiniciotipocobro:"required",
                    txtffintipocobro:"required"
                },
                messages:{
                    txtipocobro:"Este campo es obligatorio",
                    txtipocobroimporte:"Este campo es obligatorio",
                    txtfiniciotipocobro:"Este campo es obligatorio",
                    txtffintipocobro:"Este campo es obligatorio"
                }
            });

            if(validaFormulario.form()){
                idcobro = idcobro;
                var tipocobro = $("#txtipocobro").val();
                var importe = $("#txtipocobroimporte").val();
                var finicio = $("#txtfiniciotipocobro").val();
                var ffin = $("#txtffintipocobro").val();

                var url = $("#formTipocobro").attr("action");
                var method ="POST";

                $.ajax({
                    type:method,
                    url:url,
                    data:{
                        idcobro:idcobro,
                        tipocobro:tipocobro,
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
                });
            }
        });
    });
})
