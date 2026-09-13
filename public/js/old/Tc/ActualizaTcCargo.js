$(document).ready(function(){

    var idcargo;
    //carga el modal de embarque para modificar informacion
    $("#tableItemCargo tbody").on("click",".btn-EditarItemCargo",function(){

        var row = $(this).parents('tr');
        idcargo = (row.data("id_tipocargo"));
        var cargo = (row.data("tipo_cargo"));
        var finicio = (row.data("finicio"));
        var ffin = (row.data("ffin"));
        
        $("#mItemCargo").modal({backdrop: 'static'});
        $("#title-mitemcargo").html("Actualizar Cargo");
        $("#btnUpdateItemCargo").attr("hidden",false);
        $("#btn-guardaItemCargo").attr("hidden",true);

        $(".txtmcargo").val(cargo);
        $(".txtfiniciocargo").val(moment(finicio).format('Y-MM-D'));
        $(".txtffincargo").val(moment(ffin).format('Y-MM-D'));

        //Actualizamos el cargo
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#btnUpdateItemCargo").on("click", function(e){
            e.preventDefault();

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

            if(validaFormulario.form()){

                idcargo = idcargo;
                var cargo = $("#txtmcargo").val();
                var finicio = $("#txtfiniciocargo").val();
                var ffin = $("#txtffincargo").val();

                var action = $("#urlitemcargoupdate").attr("href");
                var method = 'PATCH';
                var url = action+"/"+idcargo;

                $.ajax({
                    type:method,
                    url:url,
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
                            var window="informacion";
                            showMessage(message,error,title,reload,window);
                            $(".formmItemCargo").trigger("reset");
                            $("#mItemCargo").modal('hide');
                            $("#title-mitemcargo").html("Nuevo Cargo");
                            $("#btnUpdateItemCargo").attr("hidden",true);
                            $("#btn-guardaItemCargo").removeAttr("hidden");
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
