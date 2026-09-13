$("#btnCancelFactura").on("click", function(e){
    e.preventDefault();

    var nofactura = $("#nofact").html();
    var blhouse = $("#txtblhousefactura").val();
    var message="La factura "+nofactura+", sera cancelada. Estas Seguro?";
    var title="Atencion";
    $("#obsdelete").removeAttr("hidden");
    $("#txtobsdelete").prop("required");

    showMessageDelete(message,title);

    var action = $("#urlfacturadelete").attr("href");
    var method = 'DELETE';
    var url = action+"/"+nofactura;

    $("#modalDeleteYes").on("click", function(){
        var motivo= $("#txtobsdelete").val();

        if($("#txtobsdelete").val().length != 0){
            $.ajax({
                type:method,
                url:url,
                data:{
                    motivo:motivo,
                },
                success:function(data){
                    if(data.success=="true"){
                        $("#msgsession").attr("hidden",true);
                        $("#txtobsdelete").val("");
                        $("#obsdelete").attr("hidden",true);

                        var message=data.message;
                        var title="Success!!!";
                        var error ='';
                        var reload = false
                        var window = "informacion";
                        showMessage(message,error,title,reload,window);

                        $.ajax({
                            type:"POST",
                            url:"tofacturas",
                            data:{
                                identificador:"carganofactura",
                                noblhouse: blhouse
                            },
                            success:function(response){
                                $("#formFactura").trigger("reset");
                                $("#txtctdadfactura").attr("disabled", true);
                                $("#txttelffactura").attr("disabled",true);
                                $("#txtclientefactura").attr("disabled",true);
                                $("#txtdirfactura").attr("disabled",true);
                                $("#txttipopagofactura").attr("disabled",true);
                                $("#resetVtotal").attr("disabled",true);
                                $("#btn-facturara").attr("disabled",true);
                                $("#btnEditFactura").attr("disabled",true);
                                $("#btnCancelFactura").attr("disabled",true);
                                $("#txtblhousefactura").val(blhouse);
                                $("#nofact").html("");
                                $("#festadovalor").html("");
                                $("#festadovalor").removeClass("bg-danger");
                                $("#festadovalor").removeClass("text-white");
                                $("#festadovalor").addClass("bg-secondary");
                                $("#festadovalor").addClass("text-black-50");
                                $("#txtdirfactura").val("");
                                $("#txttelffactura").val("");
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
            });
        }
        else{
            alert("Por favor dejanos saber su motivo de cancelacion");
        }

    });

    $("#modalDeleteNo").on("click", function(){
        $("#txtobsdelete").val("");
        $("#obsdelete").attr("hidden",true);
    });

});
